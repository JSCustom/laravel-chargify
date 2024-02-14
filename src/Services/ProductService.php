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
    public function createOrUpdateProduct(Request $request, int $id = NULL)
    {
        try {
            $request->validate([
                'product_family_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price_in_cents' => 'required',
                'interval' => 'required',
                'interval_unit' => 'required'
            ]);
            $data = [
                "product" => [
                    "name" => $request->name,
                    "handle" => $request->handle,
                    "description" => $request->description,
                    "accounting_code" => $request->accounting_code ?? null,
                    "require_credit_card" => $request->require_credit_card ?? true,
                    "price_in_cents" => $request->price_in_cents,
                    "interval" => $request->interval,
                    "interval_unit" => $request->interval_unit,
                    "auto_create_signup_page" => $request->auto_create_signup_page ?? true,
                    "tax_code" => $request->tax_code ?? null
                ]
            ];
            $product = !$id ? ChargifyHelper::post("/" . Urls::PRODUCT_FAMILIES . "/$request->product_family_id/" . Urls::PRODUCTS . ".json", $data) : ChargifyHelper::put("/".Urls::PRODUCTS."/$id.json", $data);
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            if (isset($product->error)) {
                throw new Exception($product->error);
            }
            Product::updateOrCreate([
                'product_id' => $product->product->id
            ], [
                'product_id' => $product->product->id,
                'product_family_id' => $product->product->product_family->id,
                'name' => $product->product->name,
                'handle' => $product->product->handle,
                'description' => $product->product->description,
                'accounting_code' => $product->product->accounting_code,
                'require_credit_card' => $product->product->require_credit_card,
                'price_in_cents' => $product->product->price_in_cents,
                'interval' => $product->product->interval,
                'interval_unit' => $product->product->interval_unit,
                'auto_create_signup_page' => $request->auto_create_signup_page ?? true,
                'tax_code' => $product->product->tax_code
            ]);
            return (object)[
                'status' => true,
                'code' => !$id ? HttpServiceProvider::CREATED : HttpServiceProvider::OK,
                'message' => !$id ? 'Product created.' : 'Product updated.',
                'result' => $product->product
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function readProduct(int $id)
    {
        try {
            $product = ChargifyHelper::get("/".Urls::PRODUCTS."/$id.json");
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            $product = collect((object)$product);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product details.',
                'result' => $product['product']
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function archiveProduct(int $id)
    {
        try {
            $product = ChargifyHelper::delete("/".Urls::PRODUCTS."/$id.json");
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            if (isset($product->error)) {
                throw new Exception($product->error);
            }
            Product::where([
                'product_id' => $id
            ])->delete();
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product archived.',
                'result' => $product->product
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
            $product = ChargifyHelper::get("/".Urls::PRODUCTS."/handle/$handle.json");
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            if (!$product) throw new Exception("Product with handle: `$handle` does not exist or is archived.");
            $product = collect((object)$product);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product details by handle.',
                'result' => $product['product']
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
            $params = http_build_query($request->all(), '', '&');
            $product = ChargifyHelper::get("/".Urls::PRODUCTS.".json?$params");
            $product = json_decode($product);
            if (isset($product->errors)) {
                throw new Exception(implode(' ', $product->errors));
            }
            $product = collect((object)$product)->pluck('product');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product list.',
                'result' => $product
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
