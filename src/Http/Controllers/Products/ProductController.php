<?php

namespace JSCustom\Chargify\Http\Controllers\Products;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $product = $this->_productService->createProduct($request);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function readProduct(int $productID)
    {
        $product = $this->_productService->readProduct($productID);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function updateProduct(Request $request, int $productID)
    {
        $product = $this->_productService->updateProduct($request, $productID);
        return response(['status' => $product->status, 'code' => $product->code, 'message' => $product->message, 'result' => $product->result ?? NULL], $product->code);
    }
    public function archiveProduct(int $productID)
    {
        $product = $this->_productService->archiveProduct($productID);
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
