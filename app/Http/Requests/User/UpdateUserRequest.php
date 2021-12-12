<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends Request
{
    // Default Property

    public $id;

    public $email;

    public $password;

    public $password_confirmastion;

    public $status;

    // Custom Property

    public $role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPasswordConfirmastion()
    {
        return $this->password_confirmastion;
    }

    /**
     * @param mixed $password_confirmastion
     */
    public function setPasswordConfirmastion($password_confirmastion)
    {
        $this->password_confirmastion = $password_confirmastion;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
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
            'id' => 'required',
            'email' => 'required',
            'password' => 'min:5',
            'password_confirmation' => 'same:password',
            'status' => ''
        ];
    }
}
