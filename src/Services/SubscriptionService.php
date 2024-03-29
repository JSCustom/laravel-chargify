<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Models\{
  Customer,
  Subscription
};
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class SubscriptionService
{
  /**
   * Create Subscription
   * Reference: https://developers.maxio.com/docs/api-docs/d571659cf0f24-create-subscription
   */
  public function createSubscription(Request $request)
  {
    try {
      $request->validate([
        'product_handle' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'full_number' => 'required',
        'zip' => 'required',
        'state' => 'required',
        'country' => 'required',
        'city' => 'required',
        'address' => 'required',
        'expiration_month' => 'required',
        'expiration_year' => 'required',
        'billing_zip' => 'required',
        'billing_state' => 'required',
        'billing_country' => 'required',
        'billing_city' => 'required',
        'billing_address' => 'required'
      ]);
      $data = [
        "subscription" => [
          "product_handle" => $request->product_handle,
          "customer_attributes" => [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "zip" => $request->zip,
            "state" => $request->state,
            "reference" => $request->reference,
            "phone" => $request->phone,
            "organization" => $request->organization,
            "country" => $request->country,
            "city" => $request->city,
            "address" => $request->address,
            "address_2" => $request->address_2
          ],
          "credit_card_attributes" => [
            "last_name" => $request->last_name,
            "first_name" => $request->first_name,
            "full_number" => $request->full_number,
            "expiration_year" => $request->expiration_year,
            "expiration_month" => $request->expiration_month,
            "card_type" => $request->card_type,
            "billing_zip" => $request->billing_zip,
            "billing_state" => $request->billing_state,
            "billing_country" => $request->billing_country,
            "billing_city" => $request->billing_city,
            "billing_address" => $request->billing_address,
            "billing_address_2" => $request->billing_address_2
          ]
        ]
      ];
      $subscription = ChargifyHelper::post("/" . Urls::SUBSCRIPTIONS . ".json", $data);
      $subscription = json_decode($subscription);
      if (isset($subscription->errors)) {
        throw new Exception(implode(' ', $subscription->errors));
      }
      if (isset($subscription->error)) {
        throw new Exception($subscription->error);
      }
      Customer::updateOrCreate(
        [
          'customer_id' => $subscription->subscription->customer->id
        ],
        [
          'customer_id' => $subscription->subscription->customer->id,
          'first_name' => $subscription->subscription->customer->first_name,
          'last_name' => $subscription->subscription->customer->last_name,
          'organization' => $subscription->subscription->customer->organization,
          'email' => $subscription->subscription->customer->email,
          'address' => $subscription->subscription->customer->address,
          'address_2' => $subscription->subscription->customer->address_2,
          'city' => $subscription->subscription->customer->city,
          'state' => $subscription->subscription->customer->state,
          'zip' => $subscription->subscription->customer->zip,
          'country' => $subscription->subscription->customer->country,
          'phone' => $subscription->subscription->customer->phone
        ]
      );
      Subscription::updateOrCreate(
        [
          'subscription_id' => $subscription->subscription->id
        ],
        [
          'subscription_id' => $subscription->subscription->id,
          'customer_id' => $subscription->subscription->customer->id,
          'product_id' => $subscription->subscription->product->id
        ]
      );
      return (object)[
        'status' => true,
        'code' => HttpServiceProvider::CREATED,
        'message' => 'Subscription created.',
        'result' => $subscription->subscription
      ];
    } catch (Exception $e) {
      return (object)[
        'status' => false,
        'code' => HttpServiceProvider::BAD_REQUEST,
        'message' => $e->getMessage()
      ];
    }
  }
  /**
   * List Subscription
   * Reference: https://developers.maxio.com/docs/api-docs/51c68dd4dcb2b-list-subscriptions
   */
  public function listSubscription(Request $request)
  {
    try {
      $params = http_build_query($request->all(), '', '&');
      $subscription = ChargifyHelper::get("/" . Urls::SUBSCRIPTIONS . ".json?$params");
      $subscription = json_decode($subscription);
      if (isset($subscription->errors)) {
        throw new Exception(implode(' ', $subscription->errors));
      }
      $subscription = collect((object)$subscription)->pluck('subscription');
      return (object)[
        'status' => true,
        'code' => HttpServiceProvider::OK,
        'message' => 'Subscription list.',
        'result' => $subscription
      ];
    } catch (Exception $e) {
      return (object)[
        'status' => false,
        'code' => HttpServiceProvider::BAD_REQUEST,
        'message' => $e->getMessage()
      ];
    }
  }
  /**
   * Update Subscription
   * Reference: https://developers.maxio.com/docs/api-docs/28190f4cf4d11-update-subscription
   */
  public function updateSubscription(Request $request, int $subscriptionID)
  {
    try {
      $request->validate([
        'full_number' => 'required',
        'expiration_month' => 'required',
        'expiration_year' => 'required'
      ]);
      $data = [
        "subscription" => [
          "credit_card_attributes" => [
            "full_number" => $request->full_number,
            "expiration_month" => $request->expiration_month,
            "expiration_year" => $request->expiration_year
          ]
        ]
      ];
      $subscription = ChargifyHelper::put("/" . Urls::SUBSCRIPTIONS . "/$subscriptionID.json", $data);
      $subscription = json_decode($subscription);
      if (!$subscription) {
        throw new Exception('Something went wrong. Please try again.');
      }
      if (isset($subscription->errors)) {
        throw new Exception(implode(' ', $subscription->errors));
      }
      $subscription = collect((object)$subscription);
      return (object)[
        'status' => true,
        'code' => HttpServiceProvider::OK,
        'message' => 'Subscription updated.',
        'result' => $subscription['subscription']
      ];
    } catch (Exception $e) {
      return (object)[
        'status' => false,
        'code' => HttpServiceProvider::BAD_REQUEST,
        'message' => $e->getMessage()
      ];
    }
  }
  /**
   * Read Subscription
   * Reference: https://developers.maxio.com/docs/api-docs/8cff5c3170d4b-read-subscription
   */
  public function readSubscription(int $subscriptionID)
  {
    try {
      $subscription = ChargifyHelper::get("/" . Urls::SUBSCRIPTIONS . "/$subscriptionID.json");
      $subscription = json_decode($subscription);
      if (isset($subscription->errors)) {
        throw new Exception(implode(' ', $subscription->errors));
      }
      $subscription = collect((object)$subscription);
      return (object)[
        'status' => true,
        'code' => HttpServiceProvider::OK,
        'message' => 'Subscription details.',
        'result' => $subscription['subscription']
      ];
    } catch (Exception $e) {
      return (object)[
        'status' => false,
        'code' => HttpServiceProvider::BAD_REQUEST,
        'message' => $e->getMessage()
      ];
    }
  }
}
