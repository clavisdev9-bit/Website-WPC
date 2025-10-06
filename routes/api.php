<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MasterApiExternal\Master;
use App\Http\Controllers\Api\LogicApiExternal\Qoutation;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/country', [Master::class, 'countries'])->name('api.country.master');
Route::get('/states/country/{countryId}', [Master::class, 'statesByCountry'])->name('api.country.state.master');
Route::get('/pickup-origins', [Master::class, 'pickupOrigins']);
Route::get('/pickup-destinations', [Master::class, 'pickupDestinations']);


Route::post('/quote/create', [Qoutation::class, 'createQuotation']);
