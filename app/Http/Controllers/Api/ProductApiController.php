<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductResource;

class ProductApiController extends ApiController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(Request $request, $uuidTenant)
    {
        $categories = $request->get('categories') ? explode(',', $request->get('categories')) : null;

        try {
            $products = $this->productService->getProductsByTenantUuid($uuidTenant, $categories);
            return ProductResource::collection($products);
        } catch (\Throwable $e) {
            //throw $th;
            return $this->errorResponse($e->getMessage());
        }
    }

    public function ProductByFlag($uuidTenant, $flag)
    {
        try {
            $product = $this->productService->getProductByFlag($uuidTenant, $flag);
            return $this->successResponse(new ProductResource($product));
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
