<?php


namespace App\Services;


use App\Shop;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopService
{
    private $req;

    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    /**
     * All Preferred Stores
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavoriteShops()
    {
        $user = $this->req->user();
        return response()->json($user->shops()->where('like', 1)->get(), 200);
    }

    /**
     * All Nearby Shops with [0] like, and  with dislike but next 2h after rating
     *
     * @return mixed
     */
    private function getAvailableShops()
    {
        $ids = DB::table('likes')
            ->where('user_id', '=', $this->req->user()->id)
            ->distinct()->get();

        return Shop::whereNotIn('id', $this->filterAvailableShops($ids))->get();
    }

    /**
     * Filtering Shops which have [like || dislike {updated_at} after 2h ]
     *
     * @param $rates
     * @return mixed
     */
    private function filterAvailableShops($rates)
    {
        $allRated = collect($rates)
            ->reject(function ($likes) {
                if (Carbon::now()->diffInHours($likes->updated_at) >= 2)
                    return $likes;
            });

        return $allRated->pluck('shop_id')->all();
    }

    /**
     * Send All NearBy Shops to de Client
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getNearbyStore()
    {
        $stores = $this->getAvailableShops();
        $origin = $this->req->user()->address;
        $dist = $stores->pluck('address')->all();

        $distances = $this->getDistances($origin, implode('|', $dist));

        $distancesValue = $this->filterDistances($distances);

        $sortDistances = $this->sortByDistance($distancesValue, $stores->toArray());


        return response($sortDistances, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Based on Google Api [GeoCoding] We handle data to get [Pure Distance Value] {M}
     *
     * @param $distances
     * @return mixed
     */
    private function filterDistances($distances)
    {
        $arrDistances = json_decode($distances, true);
        $elements = $arrDistances['rows'][0]['elements'];
        $distancesValue = collect($elements)->pluck('distance')->pluck('value')->all();

        return $distancesValue;
    }

    /**
     * Associative Array for each Distance  [10 => [{...},{...}], 100 => [] ]
     *
     * @param $dist
     * @param $stores
     * @return array
     */
    private function sortByDistance($dist, $stores)
    {
        $data = [];
        for ($i = 0; $i < count($dist); $i++) {
            if (!is_null($dist[$i])) {
                $data[$dist[$i]] = $stores[$i];
            }
        }
        ksort($data);
        return array_filter($data);
    }

    /**
     * Internal API to Google GeoCoding API
     *
     * @param $origin
     * @param $dist
     * @return \Psr\Http\Message\StreamInterface
     */
    private function getDistances($origin, $dist)
    {
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json',
            [
                'query' => [
                    'units' => 'metric',
                    'origins' => $origin,
                    'destinations' => $dist,
                    'key' => 'AIzaSyAwxwtsCJeDoDcUYswGy3aX6hqdLSPhSVI',
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]
        );
        return $response->getBody();
    }

    /**
     * Rating Shops by {isLiked} input request,  [1 => like || 0 => dislike]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function rateShop()
    {
        $shopId = $this->req->input('shopId');
        $isLiked = ['like' => $this->req->input('isLiked')];

        $shop = Shop::findOrFail($shopId);
        $shop->users()->attach($this->req->user()->id, $isLiked);

        return response()->json(`Is are liked`, 201);

    }

    /**
     * [As Client]
     * Remove a Shops from my Favorite List
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePreferredShop()
    {
        $shopId = $this->req->input('shopId');
        $shop = Shop::find($shopId);
        $shop->users()->detach($this->req->user()->id);
        $shop->users()->sync([]);

        return $this->response(['message' => 'ok'], 200);
    }


    /**
     *
     * @param array $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($message, int $status)
    {
        return response()->json($message, $status);
    }
}
