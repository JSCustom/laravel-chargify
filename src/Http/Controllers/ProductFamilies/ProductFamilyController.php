<?php

namespace JSCustom\Chargify\Http\Controllers\ProductFamilies;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductFamilyController extends Controller
{
    public function createProductFamily(Request $request)
    {
        $productFamily = $this->_productFamilyService->createProductFamily($request);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function readProduct(int $id)
    {
        $productFamily = $this->_productFamilyService->readProductFamily($id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function updateProduct(Request $request, int $id)
    {
        $productFamily = $this->_productFamilyService->updateProductFamily($request, $id);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
    public function listProduct(Request $request)
    {
        $productFamily = $this->_productFamilyService->listProductFamily($request);
        return response(['status' => $productFamily->status, 'code' => $productFamily->code, 'message' => $productFamily->message, 'result' => $productFamily->result ?? NULL], $productFamily->code);
    }
}
