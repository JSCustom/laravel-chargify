<?php

namespace JSCustom\Chargify\Http\Controllers\ProductFamilies;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductFamilyController extends Controller
{
    public function createProductFamily(Request $request)
    {
        $productFamily = $this->_productFamilyService->createOrUpdateProductFamily($request);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function readProductFamily(int $id)
    {
        $productFamily = $this->_productFamilyService->readProductFamily($id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function updateProductFamily(Request $request, int $id)
    {
        $productFamily = $this->_productFamilyService->createOrUpdateProductFamily($request, $id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function listProductFamily(Request $request)
    {
        $productFamily = $this->_productFamilyService->listProductFamily($request);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function deleteProductFamily(int $id)
    {
        $productFamily = $this->_productFamilyService->deleteProductFamily($id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function listProductsForProductFamily(Request $request, int $id)
    {
        $productFamily = $this->_productFamilyService->listProductsForProductFamily($request, $id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
}
