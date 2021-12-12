<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'product_type_id',
        'publish',
        'title',
        'slug',
        'description',
        'featured_image_url',
        'year',
        'rating',
        'director',
        'duration',
        'media_type',
        'actors',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product_type()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id');
    }

    //Belongs to many
    public function product_tag()
    {
        return $this->belongsToMany('App\Models\ProductTag', 'product_product_tags', 'product_id', 'product_tag_id');
    }

    public function product_genre()
    {
        return $this->belongsToMany('App\Models\ProductGenre', 'product_product_genres', 'product_id', 'product_genre_id');
    }

    //Sluggable
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }
}
