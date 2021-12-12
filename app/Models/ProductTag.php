<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTag extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'product_tags';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to many
    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_product_tags', 'product_tag_id', 'product_id');
    }

    //Sluggable
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }
}
