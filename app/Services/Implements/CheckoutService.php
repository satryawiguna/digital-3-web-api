<?php
namespace App\Services\Implement;


use App\Events\SendEmailEvent;
use App\Http\Requests\Checkout\SendOrderRequest;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Event;
use App\Services\Contract\ICheckoutService;
use Exception;
use Illuminate\Support\Facades\Validator;

class CheckoutService extends BaseService implements ICheckoutService
{
    /**
     * CheckoutService constructor.
     */
    public function __construct()
    {

    }

    public function sendOrder(SendOrderRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->sendEmailOrder($request);
                $this->_baseResponse->addSuccessMessage("Send order success");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param SendOrderRequest $request
     * @internal param $data
     */
    private function sendEmailOrder(SendOrderRequest $request)
    {
        $template = 'checkout.emails.order';
        $data = [
            'to' => 'admin@digital3.com',
            'from_address' => $request->getEmail(),
            'from_name' => $request->getName(),
            'subject' => 'Purchase order Inv: #' . strtotime('now'),
            'request' => $request
        ];

        Event::fire(new SendEmailEvent($template, $data));
    }

}