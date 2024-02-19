<?php

namespace JSCustom\Chargify\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use JSCustom\Chargify\Services\{
    CustomerService,
    InvoiceService,
    ProductFamilyService,
    ProductService,
    SubscriptionService,
    SyncService
};

class Controller extends BaseController
{
    public $_customerService;
    public $_invoiceService;
    public $_productFamilyService;
    public $_productService;
    public $_subscriptionService;
    public $_syncService;

    public function __construct(
        CustomerService $customerService,
        InvoiceService $invoiceService,
        ProductFamilyService $productFamilyService,
        ProductService $productService,
        SubscriptionService $subscriptionService,
        SyncService $syncService
    ) {
        $this->_customerService = $customerService;
        $this->_invoiceService = $invoiceService;
        $this->_productFamilyService = $productFamilyService;
        $this->_productService = $productService;
        $this->_subscriptionService = $subscriptionService;
        $this->_syncService = $syncService;
    }
}
