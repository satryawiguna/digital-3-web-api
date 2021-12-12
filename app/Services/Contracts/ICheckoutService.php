<?php
namespace App\Services\Contract;


use App\Http\Requests\Checkout\SendOrderRequest;

interface ICheckoutService
{
    /**
     * @param SendOrderRequest $request
     * @return mixed
     */
    public function sendOrder(SendOrderRequest $request);
}