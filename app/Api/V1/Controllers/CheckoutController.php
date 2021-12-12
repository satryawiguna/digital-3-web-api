<?php
namespace App\Api\V1\Controllers;

use App\Http\Requests\Checkout\SendOrderRequest;
use App\Services\Contract\ICheckoutService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    private $_request;

    private $_sendOrderRequest;

    private $_checkoutService;

    /**
     * ProductController constructor.
     * @param Request $request
     * @param ICheckoutService $checkoutService
     */
    public function __construct(Request $request, ICheckoutService $checkoutService)
    {
        $this->_request = $request;

        $this->_checkoutService = $checkoutService;
    }

    public function sendOrder()
    {
        $this->_sendOrderRequest = new SendOrderRequest();

        $this->_sendOrderRequest->name = $this->_request->input('name');
        $this->_sendOrderRequest->email = $this->_request->input('email');
        $this->_sendOrderRequest->place_of_stay = $this->_request->input('place_of_stay');
        $this->_sendOrderRequest->phone = $this->_request->input('phone');
        $this->_sendOrderRequest->payment_method = $this->_request->input('payment_method');
        $this->_sendOrderRequest->delivery_or_pickup = $this->_request->input('delivery_or_pickup');
        $this->_sendOrderRequest->type_of_device = $this->_request->input('type_of_device');
        $this->_sendOrderRequest->advance_note = $this->_request->input('advance_note');
        $this->_sendOrderRequest->order = $this->_request->input('order');

        $result = $this->_checkoutService->sendOrder($this->_sendOrderRequest);

        return response()->json($result);
    }
}
