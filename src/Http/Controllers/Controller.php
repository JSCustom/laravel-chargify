<?php

namespace JSCustom\Chargify\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use JSCustom\Chargify\Services\{
    CustomerService,
    SubscriptionService,
    SyncService
};

class Controller extends BaseController
{
    public $_subscriptionService;
    public $_customerService;
    public $_syncService;
    public function __construct(CustomerService $customerService, SubscriptionService $subscriptionService, SyncService $syncService)
    {
        $this->_customerService = $customerService;
        $this->_subscriptionService = $subscriptionService;
        $this->_syncService = $syncService;
    }
}