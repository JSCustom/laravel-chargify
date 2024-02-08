<?php

namespace JSCustom\Chargify\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use JSCustom\Chargify\Services\SubscriptionService;

class Controller extends BaseController
{
    public $_subscriptionService;
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->_subscriptionService = $subscriptionService;
    }
}