<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'current_login',
        'current_ip_address',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function hasAnyRole($names)
    {
        if (is_array($names)) {
            foreach ($names as $name) {
                if ($this->hasRole($name)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($names)) {
                return true;
            }
        }

        return false;

    }

    public function hasRole($name)
    {
        if ($this->role()->where('name', $name)->first()) {
            return true;
        }

        return false;
    }

    //Belongs to many
    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles', 'user_id', 'role_id');
    }

    //Has many
    public function blog()
    {
        return $this->hasMany('App\Models\Blog', 'user_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'user_id');
    }

    public function product_comment()
    {
        return $this->hasMany('App\Models\ProductComment', 'user_id');
    }

    public function blog_comment()
    {
        return $this->hasMany('App\Models\BlogComment', 'user_id');
    }
}
