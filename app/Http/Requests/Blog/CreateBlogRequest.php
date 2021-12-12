<?php
namespace App\Http\Requests\Blog;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateBlogRequest extends Request
{
    // Default Property

    public $user_id;

    public $publish;

    public $title;

    public $slug;

    public $contents;

    public $featured_image_url;

    public $status;

    // Custom Property

    public $blog_category;

    public $blog_tag;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param mixed $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImageUrl()
    {
        return $this->featured_image_url;
    }

    /**
     * @param mixed $featured_image_url
     */
    public function setFeaturedImageUrl($featured_image_url)
    {
        $this->featured_image_url = $featured_image_url;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getBlogCategory()
    {
        return $this->blog_category;
    }

    /**
     * @param mixed $blog_category
     */
    public function setBlogCategory($blog_category)
    {
        $this->blog_category = $blog_category;
    }

    /**
     * @return mixed
     */
    public function getBlogTag()
    {
        return $this->blog_tag;
    }

    /**
     * @param mixed $blog_tag
     */
    public function setBlogTag($blog_tag)
    {
        $this->blog_tag = $blog_tag;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param null $guard
     * @return bool
     */
    public function authorize($guard = null)
    {
        if (Auth::guard($guard)->guest() && !Auth::user()->hasAnyRole('admin')) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'publish' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'contents' => '',
            'featured_image_url' => '',
            'status' => ''
        ];
    }
}
