<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MasterApiExternal\Master;
use App\Http\Controllers\Api\LogicApiExternal\Qoutation;
use App\Http\Controllers\Api\ContactSyncApiExternal\ContactSyncApi;
use App\Http\Controllers\AdminQuotation\Admin_Quotation_system;
use App\Http\Controllers\Api\ApiInternal\NetworkAgentApi;
use App\Http\Controllers\Api\ApiInternal\SendEmail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// api qoutation sistem
Route::get('/country', [Master::class, 'countries'])->name('api.country.master');
Route::get('/states/country/{countryId}', [Master::class, 'statesByCountry'])->name('api.country.state.master');
Route::get('/pickup-origins', [Master::class, 'pickupOrigins']);
Route::get('/pickup-destinations', [Master::class, 'pickupDestinations']);
Route::post('/quote/create', [Qoutation::class, 'createQuotation']);
Route::get('/master/commodities', [Master::class, 'commodity']);
Route::get('/master/uom', [Master::class, 'uom']);


// route for syncron contacts Manual
Route::get('/contacts', [ContactSyncApi::class, 'index'])->name('get.data.contact.fix.');
Route::get('/contacts/sync', [ContactSyncApi::class, 'syncFromApi'])->name('sync.contact.process');

// route for Agents Network
Route::get('/Agents/Network', [NetworkAgentApi::class, 'getNetworkAgent'])->name('api.agents.network');

// route for send email internal system
Route::post('/send-offer-email-pickup', [SendEmail::class, 'sendOfferEmailPickup'])->name('api.send.offer.email.pickup');
Route::post('/send-offer-email-destination', [SendEmail::class, 'sendOfferEmailDestination'])->name('api.send.offer.email.destination');