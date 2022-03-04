<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Http\Resources\CouponResource;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\StoreUpdateCoupon;

class CouponApiController extends ApiController
{
    protected $serviceCoupon;

    public function __construct(CouponService $serviceCoupon)
    {
        $this->serviceCoupon = $serviceCoupon;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($flagTenant)
    {
        try {
            $coupons = $this->serviceCoupon->listCoupons($flagTenant);
            return CouponResource::collection($coupons);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCoupon  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCoupon $request, $flagTenant)
    {
        try {
            $coupon = $this->serviceCoupon->storeCoupon($flagTenant, $request->all());
            return new CouponResource($coupon);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($flagTenant, $flagCoupon)
    {
        try {
            $coupon = $this->serviceCoupon->showCoupon($flagTenant, $flagCoupon);
            return new CouponResource($coupon);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCoupon  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCoupon $request, $flagTenant, $flagCoupon)
    {
        try {
            $coupon = $this->serviceCoupon->updateCoupon($request->all(), $flagTenant, $flagCoupon);
            return new CouponResource($coupon);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($flagTenant, $flagCoupon)
    {
        try {
            $coupon = $this->serviceCoupon->deleteCoupon($flagTenant, $flagCoupon);
            return $this->successResponse($coupon);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }  
    }

    public function verify($flagTenant, $coupon)
    {
        try {
            $coupon = $this->serviceCoupon->verifyCoupon($flagTenant, $coupon);
            return $coupon;
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }  
    }
}
