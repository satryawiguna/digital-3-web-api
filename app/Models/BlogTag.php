<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'blog_tags';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to many
    public function blog()
    {
        return $this->belongsToMany('App\Models\Blog', 'blog_blog_tags', 'blog_tag_id', 'blog_id');
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
