<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Models\{
    Product
};
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class ProductService
{
    public function createProduct(Request $request, int $productFamilyID)
    {
        try {
            $request->validate([
                'name' => 'required',
                'handle' => 'required',
                'description' => 'required',
                'accounting_code' => 'required',
                'require_credit_card' => 'required',
                'price_in_cents' => 'required',
                'interval' => 'required',
                'interval_unit' => 'required',
                'auto_create_signup_page' => 'required',
                'tax_code' => 'required'
            ]);
            $data = [
                "product" => [
                    "name" => $request->name,
                    "handle" => $request->handle,
                    "description" => $request->description,
                    "accounting_code" => $request->accounting_code,
                    "require_credit_card" => $request->require_credit_card,
                    "price_in_cents" => $request->price_in_cents,
                    "interval" => $request->interval,
                    "interval_unit" => $request->interval_unit,
                    "auto_create_signup_page" => $request->auto_create_signup_page,
                    "tax_code" => $request->tax_code
                ]
            ];
            $product = ChargifyHelper::post("/" . Urls::PRODUCT_FAMILIES . "/$productFamilyID/" . Urls::PRODUCTS . ".json", $data);
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            if (isset($product->error)) {
                throw new Exception($product->error);
            }
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product created.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function readProduct(int $productID)
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product details.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function updateProduct(Request $request, int $productID)
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product updated.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function archiveProduct(int $productID)
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product archived.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function readProductByHandle(String $handle)
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product details by handle.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function listProduct(Request $request)
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product list.',
                'result' => null
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