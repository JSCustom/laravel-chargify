<?php

namespace JSCustom\Chargify\Http\Controllers\Products;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $product = $this->_productService->createOrUpdateProduct($request);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function readProduct(int $id)
    {
        $product = $this->_productService->readProduct($id);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function updateProduct(Request $request, int $id)
    {
        $product = $this->_productService->createOrUpdateProduct($request, $id);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function archiveProduct(int $id)
    {
        $product = $this->_productService->archiveProduct($id);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function readProductByHandle(String $handle)
    {
        $product = $this->_productService->readProductByHandle($handle);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function listProduct(Request $request)
    {
        $product = $this->_productService->listProduct($request);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
}
