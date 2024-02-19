<?php
use Illuminate\Support\Facades\Route;
use JSCustom\Chargify\Http\Controllers\{
    Customers\CustomerController,
    Invoices\InvoiceController,
    ProductFamilies\ProductFamilyController,
    Products\ProductController,
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
    Route::group(['prefix' => 'invoices'], function() {
        Route::get('', [InvoiceController::class, 'listInvoice']);
    });
    Route::group(['prefix' => 'product-family'], function() {
        Route::post('', [ProductFamilyController::class, 'createProductFamily']);
        Route::get('', [ProductFamilyController::class, 'listProductFamily']);
        Route::put('{id}', [ProductFamilyController::class, 'updateProductFamily']);
        Route::get('{id}', [ProductFamilyController::class, 'readProductFamily']);
        Route::delete('{id}', [ProductFamilyController::class, 'deleteProductFamily']);
        Route::get('{id}/products', [ProductFamilyController::class, 'listProductsForProductFamily']);
    });
    Route::group(['prefix' => 'product'], function() {
        Route::post('', [ProductController::class, 'createProduct']);
        Route::get('', [ProductController::class, 'listProduct']);
        Route::put('{id}', [ProductController::class, 'updateProduct']);
        Route::get('handle/{handle}', [ProductController::class, 'readProductByHandle']);
        Route::get('{id}', [ProductController::class, 'readProduct']);
        Route::delete('{id}', [ProductController::class, 'archiveProduct']);
    });
    Route::group(['prefix' => 'subscription'], function() {
        Route::post('', [SubscriptionController::class, 'createSubscription']);
        Route::get('', [SubscriptionController::class, 'listSubscription']);
        Route::put('{subscriptionID}', [SubscriptionController::class, 'updateSubscription']);
        Route::get('{subscriptionID}', [SubscriptionController::class, 'readSubscription']);
    });
});
?>