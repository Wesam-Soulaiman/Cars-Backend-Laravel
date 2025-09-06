<?php

use App\Actions\Admin\FAQ\FAQIndexAction;
use App\Actions\Admin\Governorate\GetGovernorateAction;
use App\Actions\Admin\LegalDocument\LegalDocumentDownloadAction;
use App\Actions\Admin\LegalDocument\LegalDocumentDownloadAllAction;
use App\Actions\Admin\Store\GetFilterStoreAction;
use App\Actions\Admin\StoreType\GetStoreTypeAction;
use App\Actions\Website\CarParts\CarPartSearchAction;
use App\Actions\Website\CarParts\CarPartShowAction;
use App\Actions\Website\CarParts\GetCarPartFiltersAction;
use App\Actions\Website\HomePageAction;
use App\Actions\Website\Offer\OfferIndexAction;
use App\Actions\Website\SearchProduct\GetFiltersAction;
use App\Actions\Website\SearchProduct\ProductSearchAction;
use App\Actions\Website\SearchProduct\ProductShowAction;
use App\Actions\Website\SearchStore\StoreCarPartAction;
use App\Actions\Website\SearchStore\StoreSearchAction;
use App\Actions\Website\SearchStore\StoreShowAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// homepage
Route::group([], function () {
    Route::get('/homepage', HomePageAction::class);
});
//  products
Route::group([], function () {
    Route::get('/getFilter', GetFiltersAction::class);
    Route::get('/searchProduct', \App\Actions\Admin\Products\ProductIndexAction::class);
    Route::get('products/{id}', ProductShowAction::class);

});

Route::group([], function () {
    Route::get('/searchCarPart', CarPartSearchAction::class);
    Route::get('carParts/{id}', CarPartShowAction::class);
    Route::get('/getFilterCarPart', GetCarPartFiltersAction::class);

});

//  stores
Route::group([], function () {
    Route::get('/getFilterStore', GetFilterStoreAction::class);
    Route::get('/searchStores', StoreSearchAction::class);
    Route::get('store/{store:id}', StoreShowAction::class);
    Route::get('product/store/{store:id}', \App\Actions\Website\SearchStore\StoreProductAction::class);
    Route::get('car-part/store/{store:id}', StoreCarPartAction::class);
});

//  stores
Route::group([], function () {
    Route::get('/getGovernorate', GetGovernorateAction::class);
    Route::get('/getStoreType', GetStoreTypeAction::class);
    Route::get('/getLegalDocuments', LegalDocumentDownloadAllAction::class);
    Route::get('/legal-documents/{legalDocument}/download', [LegalDocumentDownloadAction::class, '__invoke'])->name('legal-documents.download');
});

// offer
Route::group([], function () {
    Route::get('/offer', OfferIndexAction::class);
});
// FQA
Route::get('/FQA', FAQIndexAction::class);
