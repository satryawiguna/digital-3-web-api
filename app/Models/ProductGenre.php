<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGenre extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'product_genres';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to
    public function parent()
    {
        return $this->belongsTo('App\Models\ProductGenre', 'parent_id');
    }

    //Has many
    public function children()
    {
        return $this->hasMany('App\Models\ProductGenre', 'parent_id');
    }

    //Belongs to many
    public function blog()
    {
        return $this->belongsToMany('App\Models\Product', 'product_product_genres', 'product_genre_id', 'product_id');
    }

    //Sluggable
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
