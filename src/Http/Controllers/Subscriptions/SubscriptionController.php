<?php

namespace JSCustom\Chargify\Http\Controllers\Subscriptions;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request)
    {
        $subscription = $this->_subscriptionService->createSubscription($request);
        return response(['status' => $subscription->status, 'code' => $subscription->code, 'message' => $subscription->message, 'result' => $subscription->result ?? NULL], $subscription->code);
    }
    public function listSubscription(Request $request)
    {
        $subscription = $this->_subscriptionService->listSubscription($request);
        return response(['status' => $subscription->status, 'code' => $subscription->code, 'message' => $subscription->message, 'result' => $subscription->result ?? NULL], $subscription->code);
    }
    public function updateSubscription(Request $request, int $subscriptionID)
    {
        $subscription = $this->_subscriptionService->updateSubscription($request, $subscriptionID);
        return response(['status' => $subscription->status, 'code' => $subscription->code, 'message' => $subscription->message, 'result' => $subscription->result ?? NULL], $subscription->code);
    }
    public function readSubscription(int $subscriptionID)
    {
        $subscription = $this->_subscriptionService->readSubscription($subscriptionID);
        return response(['status' => $subscription->status, 'code' => $subscription->code, 'message' => $subscription->message, 'result' => $subscription->result ?? NULL], $subscription->code);
    }
}
