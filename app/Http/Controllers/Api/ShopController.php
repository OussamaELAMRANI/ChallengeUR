<?php

namespace App\Http\Controllers\Api;

use App\Services\ShopService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shop;

    /**
     * Inject ShopService on AuthController
     *
     * ShopController constructor.
     * @param ShopService $shopService
     */
    public function __construct(ShopService $shopService)
    {
        $this->shop = $shopService;
    }

    /**
     * Like a Shop
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Request $request)
    {
        $request->validate([
            'isLiked' => 'required|between:0,1',
            'shopId' => 'required',
        ]);
        return $this->shop->rateShop();
    }

    /**
     * Add shop to Favorite List
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function favorite()
    {
        return $this->shop->getFavoriteShops();
    }

    /**
     * Get All Nearby shops
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function nearby()
    {
        return $this->shop->getNearbyStore();
    }

    /**
     * Remove shop from Preferred List
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachShop()
    {
        return $this->shop->deletePreferredShop();
    }

}
