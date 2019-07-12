<?php

// Main Route
Route::get('/', function () {
    return view('index');
});

//  Used for managing the Vue-router
Route::get('/{vue_routes?}', function () {
    return view('index');
})->where('vue_routes', '[\/\w\.-]*')->name('login'); // Login name handle By [Auth Middleware]
