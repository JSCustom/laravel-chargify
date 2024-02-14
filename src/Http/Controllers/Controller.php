<?php

namespace JSCustom\Chargify\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use JSCustom\Chargify\Services\{
    CustomService,
    CustomerService,
    SubscriptionService,
    ProductFamilyService,
    ProductService,
    SyncService
};

class Controller extends BaseController
{
    public $_subscriptionService;
    public $_customService;
    public $_customerService;
    public $_productFamilyService;
    public $_productService;
    public $_syncService;
    public function __construct(
        CustomService $customService,
        CustomerService $customerService,
        SubscriptionService $subscriptionService,
        ProductFamilyService $productFamilyService,
        ProductService $productService,
        SyncService $syncService
    ) {
        $this->_customService = $customService;
        $this->_customerService = $customerService;
        $this->_subscriptionService = $subscriptionService;
        $this->_productFamilyService = $productFamilyService;
        $this->_productService = $productService;
        $this->_syncService = $syncService;
    }
}
