<?php
namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends Request
{
    // Default Property

    public $user_id;

    public $product_type_id;

    public $publish;

    public $title;

    public $slug;

    public $description;

    public $featured_image_url;

    public $year;

    public $rating;

    public $director;

    public $duration;

    public $media_type;

    public $actors;

    public $status;

    // Custom Property

    public $product_genre;

    public $product_tag;

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
    public function getProductTypeId()
    {
        return $this->product_type_id;
    }

    /**
     * @param mixed $product_type_id
     */
    public function setProductTypeId($product_type_id)
    {
        $this->product_type_id = $product_type_id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getMediaType()
    {
        return $this->media_type;
    }

    /**
     * @param mixed $media_type
     */
    public function setMediaType($media_type)
    {
        $this->media_type = $media_type;
    }

    /**
     * @return mixed
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param mixed $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
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
    public function getProductGenre()
    {
        return $this->product_genre;
    }

    /**
     * @param mixed $product_genre
     */
    public function setProductGenre($product_genre)
    {
        $this->product_genre = $product_genre;
    }

    /**
     * @return mixed
     */
    public function getProductTag()
    {
        return $this->product_tag;
    }

    /**
     * @param mixed $product_tag
     */
    public function setProductTag($product_tag)
    {
        $this->product_tag = $product_tag;
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
            'product_type_id' => 'required',
            'publish' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'description' => '',
            'featured_image_url' => '',
            'year' => '',
            'rating' => '',
            'director' => '',
            'duration' => '',
            'media_type' => '',
            'actors' => '',
            'status' => ''
        ];
    }
}
