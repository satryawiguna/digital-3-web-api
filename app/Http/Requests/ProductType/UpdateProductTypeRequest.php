<?php
namespace App\Http\Requests\ProductType;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UpdateProductTypeRequest extends Request
{
    // Default Property

    public $id;

    public $name;

    public $description;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
            'name' => 'required',
            'description' => ''
        ];
    }
}
