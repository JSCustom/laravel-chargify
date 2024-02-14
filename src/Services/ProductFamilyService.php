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
    public function createOrUpdateProductFamily(Request $request, int $id = NULL)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $data = [
                "product_family" => [
                    "name" => $request->name,
                    "description" => $request->description,
                    "handle" => $request->handle ?? null,
                    "accounting_code" => $request->accounting_code ?? null
                ]
            ];
            $productFamily = !$id ? ChargifyHelper::post("/" . Urls::PRODUCT_FAMILIES . ".json", $data) : ChargifyHelper::put("/".Urls::PRODUCT_FAMILIES."/$id.json", $data);
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            if (isset($productFamily->error)) {
                throw new Exception($productFamily->error);
            }
            ProductFamily::updateOrCreate([
                'product_family_id' => $productFamily->product_family->id
            ], [
                'product_family_id' => $productFamily->product_family->id,
                'name' => $productFamily->product_family->name,
                'description' => $productFamily->product_family->description,
                'handle' => $productFamily->product_family->handle,
                'accounting_code' => $productFamily->product_family->accounting_code
            ]);
            return (object)[
                'status' => true,
                'code' => !$id ? HttpServiceProvider::CREATED : HttpServiceProvider::OK,
                'message' => !$id ? 'Product family created.' : 'Product family updated.',
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
    public function deleteProductFamily(int $id)
    {
        try {
            $productFamily = ChargifyHelper::delete("/".Urls::PRODUCT_FAMILIES."/$id.json");
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            if (isset($productFamily->error)) {
                throw new Exception($productFamily->error);
            }
            ProductFamily::where([
                'product_family_id' => $id
            ])->delete();
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family deleted.',
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
    public function listProductsForProductFamily(Request $request, int $id)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $productFamily = ChargifyHelper::get("/".Urls::PRODUCT_FAMILIES."/$id/products.json?$params");
            $productFamily = json_decode($productFamily);
            if (isset($productFamily->errors)) {
                throw new Exception(implode(' ', $productFamily->errors));
            }
            $productFamily = collect((object)$productFamily)->pluck('product');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Product family product list.',
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
