<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Product;
use App\Models\ProductGenre;
use App\Services\Contract\IUserService;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $_userService;

    private $_request;

    /**
     * HomeController constructor.
     * @param Request $request
     * @param IUserService $userService
     */
    public function __construct(Request $request, IUserService $userService)
    {
        $this->_request = $request;

        $this->_userService = $userService;
    }

    public function index()
    {
        return view('index');
    }

    public function priceList()
    {
        return view('pricelist');
    }

    public function getUserActivate($email)
    {
        $this->_userService->userActivate($email);

        return view('activate');
    }

    public function createGenre()
    {
        $product = new Product();
        $results = $product->get();

        $gcs = new Collection();

        foreach ($results as $result) {
            $genres = explode(',', $result->genre);

            foreach ($genres as $genre) {
                $name = ltrim($genre);

                if (!$gcs->contains('name', $name)) {
                    $gcs->push([
                        'parent_id' => null,
                        'name' => $name,
                        'slug' => strtolower(str_replace(' ', '-', $name)),
                        'description' => null
                    ]);
                }
            }
        }

        ProductGenre::insert($gcs->all());
    }

    public function createProductGenre()
    {
        $product = new Product();
        $rps = $product->get();

        $pgcs = new Collection();

        foreach ($rps as $rp) {
            $genres = explode(',', $rp->genre);
            $id = $rp->id;

            foreach ($genres as $genre) {
                $name = ltrim($genre);

                $pgs = new ProductGenre;
                $rpgs = $pgs->where('name', $name)->get();

                foreach ($rpgs as $rpg) {
                    $pgcs->push([
                        'product_id' => $id,
                        'product_genre_id' => $rpg->id
                    ]);
                }
            }
        }

        $product->product_genre()->sync($pgcs->all());
    }

    public function createProductSlug()
    {
        $product = new Product();
        $rps = $product->get();

        foreach ($rps as $rp) {
            $slug = ltrim($rp->title);

            $x = Product::find($rp->id);
            $x->slug = strtolower(str_replace(' ', '-', preg_replace('/[^\p{L}\p{N}\s]/u', '', $slug)));
            $x->save();
        }
    }
}
