<?php
namespace App\Http\Requests\Checkout;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class SendOrderRequest extends Request
{
    // Default Property

    public $name;

    public $email;

    public $place_of_stay;

    public $phone;

    public $payment_method;

    public $delivery_or_pickup;

    public $type_of_device;

    public $advance_note;

    // Custom Property

    public $order;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfStay()
    {
        return $this->place_of_stay;
    }

    /**
     * @param mixed $place_of_stay
     */
    public function setPlaceOfStay($place_of_stay)
    {
        $this->place_of_stay = $place_of_stay;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param mixed $payment_method
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @return mixed
     */
    public function getDeliveryOrPickup()
    {
        return $this->delivery_or_pickup;
    }

    /**
     * @param mixed $delivery_or_pickup
     */
    public function setDeliveryOrPickup($delivery_or_pickup)
    {
        $this->delivery_or_pickup = $delivery_or_pickup;
    }

    /**
     * @return mixed
     */
    public function getTypeOfDevice()
    {
        return $this->type_of_device;
    }

    /**
     * @param mixed $type_of_device
     */
    public function setTypeOfDevice($type_of_device)
    {
        $this->type_of_device = $type_of_device;
    }

    /**
     * @return mixed
     */
    public function getAdvanceNote()
    {
        return $this->advance_note;
    }

    /**
     * @param mixed $advance_note
     */
    public function setAdvanceNote($advance_note)
    {
        $this->advance_note = $advance_note;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param null $guard
     * @return bool
     */
    public function authorize($guard = null)
    {
        if (Auth::guard($guard)->guest() && !Auth::user()->hasAnyRole('admin')) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'place_of_stay' => 'required',
            'phone' => 'required',
            'payment_method' => 'required',
            'delivery_or_pickup' => 'required',
            'type_of_device' => 'required',
            'advance_note' => ''
        ];
    }
}