<?php

use App\Actions\Admin\Auth\GetMeAction;
use App\Actions\Admin\Auth\LoginAuthAction;
use App\Actions\Admin\Auth\RefreshTokenAction;
use App\Actions\Admin\Banner\BannerCreateAction;
use App\Actions\Admin\Banner\BannerDestroyAction;
use App\Actions\Admin\Banner\BannerIndexAction;
use App\Actions\Admin\Banner\BannerShowAction;
use App\Actions\Admin\Banner\BannerUpdateAction;
use App\Actions\Admin\Brand\BrandCreateAction;
use App\Actions\Admin\Brand\BrandDestroyAction;
use App\Actions\Admin\Brand\BrandIndexAction;
use App\Actions\Admin\Brand\BrandShowAction;
use App\Actions\Admin\Brand\BrandUpdateAction;
use App\Actions\Admin\Employee\EmployeeCreateAction;
use App\Actions\Admin\Employee\EmployeeDeleteAction;
use App\Actions\Admin\Employee\EmployeeIndexAction;
use App\Actions\Admin\Employee\EmployeeShowAction;
use App\Actions\Admin\Employee\EmployeeUpdateAction;
use App\Actions\Admin\FAQ\FAQCreateAction;
use App\Actions\Admin\FAQ\FAQDestroyAction;
use App\Actions\Admin\FAQ\FAQIndexAction;
use App\Actions\Admin\FAQ\FAQShowAction;
use App\Actions\Admin\FAQ\FAQUpdateAction;
use App\Actions\Admin\Feature\FeatureCreateAction;
use App\Actions\Admin\Feature\FeatureDestroyAction;
use App\Actions\Admin\Feature\FeatureIndexAction;
use App\Actions\Admin\Feature\FeatureShowAction;
use App\Actions\Admin\Feature\FeatureUpdateAction;
use App\Actions\Admin\Model\ModelCreateAction;
use App\Actions\Admin\Model\ModelDestroyAction;
use App\Actions\Admin\Model\ModelIndexAction;
use App\Actions\Admin\Model\ModelShowAction;
use App\Actions\Admin\Model\ModelUpdateAction;
use App\Actions\Admin\Offer\OfferCreateAction;
use App\Actions\Admin\Offer\OfferDeleteAction;
use App\Actions\Admin\Offer\OfferIndexAction;
use App\Actions\Admin\Offer\OfferShowAction;
use App\Actions\Admin\Offer\OfferUpdateAction;
use App\Actions\Admin\Order\OrderCreateAction;
use App\Actions\Admin\Order\OrderDeleteAction;
use App\Actions\Admin\Order\OrderIndexAction;
use App\Actions\Admin\Order\OrderShowAction;
use App\Actions\Admin\Order\OrderUpdateAction;
use App\Actions\Admin\Products\ProductCreateAction;
use App\Actions\Admin\Products\ProductDeleteAction;
use App\Actions\Admin\Products\ProductIndexAction;
use App\Actions\Admin\Products\ProductPhotoDeleteAction;
use App\Actions\Admin\Products\ProductShowAction;
use App\Actions\Admin\Products\ProductUpdateAction;
use App\Actions\Admin\Role\RoleCreateAction;
use App\Actions\Admin\Role\RoleDeleteAction;
use App\Actions\Admin\Role\RoleIndexAction;
use App\Actions\Admin\Role\RolePermissionAction;
use App\Actions\Admin\Role\RoleShowAction;
use App\Actions\Admin\Role\RoleUpdateAction;
use App\Actions\Admin\Services\CategoryServiceAction;
use App\Actions\Admin\Services\ServiceAction;
use App\Actions\Admin\Services\ServiceCreateAction;
use App\Actions\Admin\Services\ServiceDeleteAction;
use App\Actions\Admin\Services\ServiceShowAction;
use App\Actions\Admin\Services\ServiceUpdateAction;
use App\Actions\Admin\Statistics\StatisticsAction;
use App\Actions\Admin\Store\StoreCreateAction;
use App\Actions\Admin\Store\StoreDestroyAction;
use App\Actions\Admin\Store\StoreIndexAction;
use App\Actions\Admin\Store\StoreShowAction;
use App\Actions\Admin\Store\StoreUpdateAction;
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

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', GetMeAction::class);

    // stores
    Route::prefix('stores')->group(function () {
        Route::get('/', StoreIndexAction::class)->middleware('permission:stores.view');
        Route::get('/{store:id}', StoreShowAction::class)->middleware('permission:stores.view');
        Route::post('/', StoreCreateAction::class)->middleware('permission:stores.create');
        Route::post('/{store:id}', StoreUpdateAction::class)->middleware('permission:stores.update');
        Route::delete('/{store:id}', StoreDestroyAction::class)->middleware('permission:stores.delete');
    });
    // banners
    Route::prefix('banners')->group(function () {
        Route::get('/', BannerIndexAction::class)->middleware('permission:banners.view');
        Route::get('/{banner:id}', BannerShowAction::class)->middleware('permission:banners.view');
        Route::post('/', BannerCreateAction::class)->middleware('permission:banners.create');
        Route::post('/{banner:id}', BannerUpdateAction::class)->middleware('permission:banners.update');
        Route::delete('/{banner:id}', BannerDestroyAction::class)->middleware('permission:banners.delete');
    });

    // FAQ
    Route::prefix('FAQ')->group(function () {
        Route::get('/', FAQIndexAction::class)->middleware('permission:FAQ.view');
        Route::get('/{FAQ:id}', FAQShowAction::class)->middleware('permission:FAQ.view');
        Route::post('/', FAQCreateAction::class)->middleware('permission:FAQ.create');
        Route::put('/{FAQ:id}', FAQUpdateAction::class)->middleware('permission:FAQ.update');
        Route::delete('/{FAQ:id}', FAQDestroyAction::class)->middleware('permission:FAQ.delete');
    });
    // Feature
    Route::prefix('Feature')->group(function () {
        Route::get('/', FeatureIndexAction::class)->middleware('permission:feature.view');
        Route::get('/{feature:id}', FeatureShowAction::class)->middleware('permission:feature.view');
        Route::post('/', FeatureCreateAction::class)->middleware('permission:feature.create');
        Route::put('/{feature:id}', FeatureUpdateAction::class)->middleware('permission:feature.update');
        Route::delete('/{feature:id}', FeatureDestroyAction::class)->middleware('permission:feature.delete');
    });

    // brands
    Route::prefix('brands')->group(function () {
        Route::get('/', BrandIndexAction::class)->middleware('permission:brands.view');
        Route::get('/{brand:id}', BrandShowAction::class)->middleware('permission:brands.view');
        Route::post('/', BrandCreateAction::class)->middleware('permission:brands.create');
        Route::post('/{brand:id}', BrandUpdateAction::class)->middleware('permission:brands.update');
        Route::delete('/{brand:id}', BrandDestroyAction::class)->middleware('permission:brands.delete');
    });

    // models
    Route::prefix('models')->group(function () {
        Route::get('/', ModelIndexAction::class)->middleware('permission:models.view');
        Route::get('/{model:id}', ModelShowAction::class)->middleware('permission:models.view');
        Route::post('/', ModelCreateAction::class)->middleware('permission:models.create');
        Route::put('/{model:id}', ModelUpdateAction::class)->middleware('permission:models.update');
        Route::delete('/{model:id}', ModelDestroyAction::class)->middleware('permission:models.delete');
    });
    // products
    Route::prefix('products')->group(function () {
        Route::get('/', ProductIndexAction::class)->middleware('permission:products.view');
        Route::get('/{product:id}', ProductShowAction::class)->middleware('permission:products.view');
        Route::post('/', ProductCreateAction::class)->middleware('permission:products.create');
        Route::post('/{product:id}', ProductUpdateAction::class)->middleware('permission:products.update');
        Route::delete('photo/{productPhoto:id}', ProductPhotoDeleteAction::class)->middleware('permission:products.update');
        Route::delete('/{product:id}', ProductDeleteAction::class)->middleware('permission:products.delete');
    });
    // offers
    Route::prefix('offers')->group(function () {
        Route::get('/', OfferIndexAction::class)->middleware('permission:offers.view');
        Route::get('/{offer:id}', OfferShowAction::class)->middleware('permission:offers.view');
        Route::post('/', OfferCreateAction::class)->middleware('permission:offers.create');
        Route::put('/{offer:id}', OfferUpdateAction::class)->middleware('permission:offers.update');
        Route::delete('/{offer:id}', OfferDeleteAction::class)->middleware('permission:offers.delete');
    });
    // services
    Route::prefix('services')->group(function () {
        Route::get('/', ServiceAction::class)->middleware('permission:services.view');
        Route::get('/categories', CategoryServiceAction::class);
        Route::post('/', ServiceCreateAction::class)->middleware('permission:services.create');
        Route::get('/{service:id}', ServiceShowAction::class)->middleware('permission:services.view');
        Route::put('/{service:id}', ServiceUpdateAction::class)->middleware('permission:services.update');
        Route::delete('/{service:id}', ServiceDeleteAction::class)->middleware('permission:services.delete');
    });
    // orders
    Route::prefix('orders')->group(function () {
        Route::get('/', OrderIndexAction::class)->middleware('permission:orders.view');
        Route::post('/', OrderCreateAction::class)->middleware('permission:orders.create');
        Route::put('/{order:id}', OrderUpdateAction::class)->middleware('permission:orders.update');
        Route::delete('/{order:id}', OrderDeleteAction::class)->middleware('permission:orders.delete');
        Route::get('/{order:id}', OrderShowAction::class)->middleware('permission:orders.view');
    });
    // roles
    Route::prefix('roles')->group(function () {
        Route::get('/', RoleIndexAction::class)->middleware('permission:roles.view');
        Route::get('/{role:id}', RoleShowAction::class)->middleware('permission:roles.view');
        Route::post('/', RoleCreateAction::class)->middleware('permission:roles.create');
        Route::put('/{role:id}', RoleUpdateAction::class)->middleware('permission:roles.update');
        Route::delete('/{role:id}', RoleDeleteAction::class)->middleware('permission:roles.delete');
        Route::put('permissions/{role:id}', RolePermissionAction::class)->middleware('permission:roles.update');

    });
    // employees
    Route::prefix('employees')->group(function () {
        Route::get('/', EmployeeIndexAction::class)->middleware('permission:employees.view');
        Route::get('/{employee:id}', EmployeeShowAction::class)->middleware('permission:employees.view');
        Route::post('/', EmployeeCreateAction::class)->middleware('permission:employees.create');
        Route::put('/{employee:id}', EmployeeUpdateAction::class)->middleware('permission:employees.update');
        Route::delete('/{employee:id}', EmployeeDeleteAction::class)->middleware('permission:employees.delete');

    });
    Route::post('/refreshToken', RefreshTokenAction::class);
    Route::get('/statistics', StatisticsAction::class)->middleware('permission:dashboard.access');

});

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', LoginAuthAction::class);

});
