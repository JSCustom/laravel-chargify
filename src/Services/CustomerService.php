<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Models\{
    ChargifyCustomer
};
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class CustomerService
{
    /**
     * Create Customer
     * Reference: https://developers.maxio.com/docs/api-docs/18237bcfe5cbb-create-customer
     */
    public function createCustomer(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required'
            ]);
            $data = [
                "customer" => [
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
                ]
            ];
            $customer = ChargifyHelper::post("/".Urls::CUSTOMERS.".json", $data);
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            if (isset($customer->error)) {
                throw new Exception($customer->error);
            }
            ChargifyCustomer::create([
                'customer_id' => $customer->customer->id,
                'first_name' => $customer->customer->first_name,
                'last_name' => $customer->customer->last_name,
                'organization' => $customer->customer->organization,
                'email' => $customer->customer->email,
                'address' => $customer->customer->address,
                'address_2' => $customer->customer->address_2,
                'city' => $customer->customer->city,
                'state' => $customer->customer->state,
                'zip' => $customer->customer->zip,
                'country' => $customer->customer->country,
                'phone' => $customer->customer->phone
            ]);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::CREATED,
                'message' => 'Customer created.',
                'result' => $customer->customer
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
     * List Customer
     * Reference: https://developers.maxio.com/docs/api-docs/3fb9201a18426-list-or-find-customers
     */
    public function listCustomer(Request $request)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $customer = ChargifyHelper::get("/".Urls::CUSTOMERS.".json?$params");
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            $customer = collect((object)$customer)->pluck('customer');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer list.',
                'result' => $customer
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
     * Read Customer
     * Reference: https://developers.maxio.com/docs/api-docs/4803917f59c53-read-customer
     */
    public function readCustomer(int $id)
    {
        try {
            $customer = ChargifyHelper::get("/".Urls::CUSTOMERS."/$id.json");
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            $customer = collect((object)$customer);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer details.',
                'result' => $customer['customer']
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
     * Update Customer
     * Reference: https://developers.maxio.com/docs/api-docs/fbf442cd90401-update-customer
     */
    public function updateCustomer(Request $request, int $id)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required'
            ]);
            $data = [
                "customer" => [
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
                ]
            ];
            $customer = ChargifyHelper::put("/".Urls::CUSTOMERS."/$id.json", $data);
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            if (isset($customer->error)) {
                throw new Exception($customer->error);
            }
            ChargifyCustomer::where([
                'customer_id' => $id
            ])->update([
                'first_name' => $customer->customer->first_name,
                'last_name' => $customer->customer->last_name,
                'organization' => $customer->customer->organization,
                'email' => $customer->customer->email,
                'address' => $customer->customer->address,
                'address_2' => $customer->customer->address_2,
                'city' => $customer->customer->city,
                'state' => $customer->customer->state,
                'zip' => $customer->customer->zip,
                'country' => $customer->customer->country,
                'phone' => $customer->customer->phone
            ]);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer updated.',
                'result' => $customer->customer
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
     * Delete Customer
     * Reference: https://developers.maxio.com/docs/api-docs/c3628b28b65a5-delete-customer
     */
    public function deleteCustomer(int $id)
    {
        try {
            $customer = ChargifyHelper::delete("/".Urls::CUSTOMERS."/$id.json");
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            if (isset($customer->error)) {
                throw new Exception($customer->error);
            }
            ChargifyCustomer::where([
                'customer_id' => $id
            ])->delete();
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer deleted.',
                'result' => $customer
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
     * Read Customer by Reference
     * Reference: https://developers.maxio.com/docs/api-docs/b710d8fbef104-read-customer-by-reference
     */
    public function readCustomerByReference(Request $request)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $customer = ChargifyHelper::get("/".Urls::CUSTOMERS."/lookup.json?$params");
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            $customer = collect((object)$customer);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer details.',
                'result' => $customer['customer']
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
     * List Customer Subscriptions
     * Reference: https://developers.maxio.com/docs/api-docs/6546ed6b6ee19-list-customer-subscriptions
     */
    public function listCustomerSubscription(int $id)
    {
        try {
            $customer = ChargifyHelper::get("/".Urls::CUSTOMERS."/$id/".Urls::SUBSCRIPTIONS.".json");
            $customer = json_decode($customer);
            if (isset($customer->errors)) {
                throw new Exception(implode(' ', $customer->errors));
            }
            $customer = collect((object)$customer)->pluck('subscription');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Customer subscriptions.',
                'result' => $customer
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
