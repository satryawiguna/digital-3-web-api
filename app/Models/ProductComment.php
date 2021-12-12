<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductComment extends Model
{
    use SoftDeletes;

    protected $table = 'product_comments';

    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'ip_address',
        'browser'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
