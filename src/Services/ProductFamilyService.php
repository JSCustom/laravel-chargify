<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Models\{
    ProductFamily
};
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class ProductFamilyService
{
    public function createProductFamily(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $data = [
                "product_family" => [
                    "name" => $request->name,
                    "description" => $request->description
                ]
            ];
            $productFamily = ChargifyHelper::post("/" . Urls::PRODUCT_FAMILIES . ".json", $data);
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            if (isset($productFamily->error)) {
                throw new Exception($productFamily->error);
            }
            ProductFamily::create([
                'product_family_id' => $productFamily->product_family->id,
                'name' => $productFamily->product_family->name,
                'description' => $productFamily->product_family->description,
                'handle' => $productFamily->product_family->handle,
                'accounting_code' => $productFamily->product_family->accounting_code
            ]);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family created.',
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
    public function readProductFamily(int $id)
    {
        try {
            $productFamily = ChargifyHelper::get("/" . Urls::PRODUCT_FAMILIES . "/$id.json");
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            if (isset($productFamily->error)) {
                throw new Exception($productFamily->error);
            }
            $productFamily = collect((object)$productFamily);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family details.',
                'result' => $productFamily['product_family']
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function updateProductFamily(Request $request, int $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $data = [
                "product_family" => [
                    "name" => $request->name,
                    "description" => $request->description
                ]
            ];
            $productFamily = ChargifyHelper::put("/".Urls::PRODUCT_FAMILIES."/$id.json", $data);
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            if (isset($productFamily->error)) {
                throw new Exception($productFamily->error);
            }
            ProductFamily::where([
                'product_family_id' => $id
            ])->update([
                'name' => $productFamily->product_family->name,
                'description' => $productFamily->product_family->description,
                'handle' => $productFamily->product_family->handle,
                'accounting_code' => $productFamily->product_family->accounting_code
            ]);
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family updated.',
                'result' => $productFamily->product_family
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function listProductFamily(Request $request)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $productFamily = ChargifyHelper::get("/".Urls::PRODUCT_FAMILIES.".json?$params");
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            $productFamily = collect((object)$productFamily)->pluck('product_family');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family list.',
                'result' => $productFamily
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
