<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductResource;

class OrderTenantController extends ApiController
{
    protected $orderService, $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $tenant = Auth::guard('web')->user()->tenant;

        $date = $request->date ?? date('Y-m-d');
        $status = $request->status ?? 'all';
        $orders = $this->orderService->getOrdersByTenantId($tenant->id, $status, $date);

        return OrderResource::collection($orders);
    }

    public function store(StoreOrder $request)
    {
        $tenant = Auth::guard('web')->user()->tenant;

        try {
             $order = $this->orderService->newOrder($request->all(), $tenant->uuid);
 
             broadcast(new OrderCreated($order)); //Enviar notificação push
 
             return $this->successResponse(new OrderResource($order), null, 201);
         } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
         }
    }    

    public function update(Request $request)
    {
        $order = $this->orderService->updateStatusOrder($request->identify, $request->status);

        return new OrderResource($order);
    }

    public function products(Request $request)
    {
        $tenant = Auth::guard('web')->user()->tenant; //"de123344-da27-4d92-b51e-b4ef74b77131"

        $filter = $request->filter;

        try {
            $products = $this->productService->getProductsFilterByTenantUuid($tenant->uuid, $filter);
            return ProductResource::collection($products);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function product($flag)
    {
        $tenant = Auth::guard('web')->user()->tenant;

        try {
            $product = $this->productService->getProductByFlag($tenant->uuid, $flag);
            return $this->successResponse(new ProductResource($product));
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
    
}
