<?php
use Illuminate\Support\Facades\Route;
use JSCustom\Chargify\Http\Controllers\Subscriptions\ChargifySubscriptionController;

Route::group(['prefix' => 'chargify'], function() {
    Route::group(['prefix' => 'subscription'], function() {
        Route::post('', [ChargifySubscriptionController::class, 'createSubscription']);
        Route::get('', [ChargifySubscriptionController::class, 'listSubscription']);
        Route::put('{subscriptionID}', [ChargifySubscriptionController::class, 'updateSubscription']);
        Route::get('{subscriptionID}', [ChargifySubscriptionController::class, 'readSubscription']);
    });
});
?>