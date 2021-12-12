<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use SoftDeletes;

    protected $table = 'product_types';

    protected $fillable = [
        'name',
        'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Has many
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'product_type_id');
    }
}
