<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use SoftDeletes;

    protected $table = 'blog_comments';

    protected $fillable = [
        'blog_id',
        'user_id',
        'comment',
        'ip_address',
        'browser'
    ];

    protected $dates = [
        'deleted_at'
    ];

    //Belongs to
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
