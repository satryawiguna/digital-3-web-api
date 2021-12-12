<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'blog_categories';

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
        return $this->belongsTo('App\Models\BlogCategory', 'parent_id');
    }

    //Has many
    public function children()
    {
        return $this->hasMany('App\Models\BlogCategory', 'parent_id');
    }

    //Belongs to many
    public function blog()
    {
        return $this->belongsToMany('App\Models\Blog', 'blog_blog_categories', 'blog_category_id', 'blog_id');
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
