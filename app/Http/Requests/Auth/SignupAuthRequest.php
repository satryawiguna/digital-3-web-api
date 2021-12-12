<?php
namespace App\Http\Requests\Auth;


use App\Http\Requests\Request;

class SignupAuthRequest extends Request
{
    // Default Property

    public $email;

    public $password;

    public $phone_code_id;

    public $phone;

    public $current_ip_address;

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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPhoneCodeId()
    {
        return $this->phone_code_id;
    }

    /**
     * @param mixed $phone_code_id
     */
    public function setPhoneCodeId($phone_code_id)
    {
        $this->phone_code_id = $phone_code_id;
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
    public function getCurrentIpAddress()
    {
        return $this->current_ip_address;
    }

    /**
     * @param mixed $current_ip_address
     */
    public function setCurrentIpAddress($current_ip_address)
    {
        $this->current_ip_address = $current_ip_address;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
