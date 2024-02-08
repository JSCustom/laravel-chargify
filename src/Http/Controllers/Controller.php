<?php

namespace JSCustom\Chargify\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use JSCustom\Chargify\Services\{
    CustomerService,
    SubscriptionService
};

class Controller extends BaseController
{
    public $_subscriptionService;
    public $_customerService;
    public function __construct(CustomerService $customerService, SubscriptionService $subscriptionService)
    {
        $this->_customerService = $customerService;
        $this->_subscriptionService = $subscriptionService;
    }
}