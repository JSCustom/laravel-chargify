<?php
use Illuminate\Support\Facades\Route;
use JSCustom\Chargify\Http\Controllers\{
    Customers\CustomerController,
    ProductPricePoint\ProductPricePointController,
    Subscriptions\SubscriptionController,
    Sync\SyncController
};

Route::group(['prefix' => 'chargify'], function() {
    Route::group(['prefix' => 'sync'], function() {
        Route::get('import', [SyncController::class, 'syncImport']);
        Route::get('export', [SyncController::class, 'syncExport']);
    });
    Route::group(['prefix' => 'customer'], function() {
        Route::post('', [CustomerController::class, 'createCustomer']);
        Route::get('', [CustomerController::class, 'listCustomer']);
        Route::put('{id}', [CustomerController::class, 'updateCustomer']);
        Route::get('lookup', [CustomerController::class, 'readCustomerByReference']);
        Route::get('{id}', [CustomerController::class, 'readCustomer']);
        Route::delete('{id}', [CustomerController::class, 'deleteCustomer']);
        Route::get('{id}/subscriptions', [CustomerController::class, 'listCustomerSubscription']);
    });
    Route::group(['prefix' => 'subscription'], function() {
        Route::post('', [SubscriptionController::class, 'createSubscription']);
        Route::get('', [SubscriptionController::class, 'listSubscription']);
        Route::put('{subscriptionID}', [SubscriptionController::class, 'updateSubscription']);
        Route::get('{subscriptionID}', [SubscriptionController::class, 'readSubscription']);
    });
});
?>