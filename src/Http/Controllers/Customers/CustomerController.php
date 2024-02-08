<?php

namespace JSCustom\Chargify\Http\Controllers\Customers;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $customer = $this->_customerService->createCustomer($request);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function listCustomer(Request $request)
    {
        $customer = $this->_customerService->listCustomer($request);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function updateCustomer(Request $request, int $id)
    {
        $customer = $this->_customerService->updateCustomer($request, $id);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function readCustomer(int $id)
    {
        $customer = $this->_customerService->readCustomer($id);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function deleteCustomer(int $id)
    {
        $customer = $this->_customerService->deleteCustomer($id);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function readCustomerByReference(Request $request)
    {
        $customer = $this->_customerService->readCustomerByReference($request);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
    public function listCustomerSubscription(int $id)
    {
        $customer = $this->_customerService->listCustomerSubscription($id);
        return response(['status' => $customer->status, 'code' => $customer->code, 'message' => $customer->message, 'result' => $customer->result ?? NULL], $customer->code);
    }
}
