<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'publish',
        'title',
        'slug',
        'contents',
        'featured_image_url',
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

    //Belongs to many
    public function blog_category()
    {
        return $this->belongsToMany('App\Models\BlogCategory', 'blog_blog_categories', 'blog_id', 'blog_category_id');
    }

    public function blog_tag()
    {
        return $this->belongsToMany('App\Models\BlogTag', 'blog_blog_tags', 'blog_id', 'blog_tag_id');
    }

    //Sluggable
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
