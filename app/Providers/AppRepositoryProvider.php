<?php
namespace App\Providers;


use App\Repositories\Contract\IAuthRepository;
use App\Repositories\Contract\IBlogCategoryRepository;
use App\Repositories\Contract\IBlogCommentRepository;
use App\Repositories\Contract\IBlogRepository;
use App\Repositories\Contract\IBlogTagRepository;
use App\Repositories\Contract\IProductCommentRepository;
use App\Repositories\Contract\IProductGenreRepository;
use App\Repositories\Contract\IProductRepository;
use App\Repositories\Contract\IProductTagRepository;
use App\Repositories\Contract\IProductTypeRepository;
use App\Repositories\Contract\IRoleRepository;
use App\Repositories\Contract\IUserRepository;
use App\Repositories\Implement\AuthRepository;
use App\Repositories\Implement\BlogCategoryRepository;
use App\Repositories\Implement\BlogCommentRepository;
use App\Repositories\Implement\BlogRepository;
use App\Repositories\Implement\BlogTagRepository;
use App\Repositories\Implement\ProductCommentRepository;
use App\Repositories\Implement\ProductGenreRepository;
use App\Repositories\Implement\ProductRepository;
use App\Repositories\Implement\ProductTagRepository;
use App\Repositories\Implement\ProductTypeRepository;
use App\Repositories\Implement\RoleRepository;
use App\Repositories\Implement\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);

        $this->app->bind(IBlogRepository::class, BlogRepository::class);
        $this->app->bind(IBlogCategoryRepository::class, BlogCategoryRepository::class);
        $this->app->bind(IBlogTagRepository::class, BlogTagRepository::class);
        $this->app->bind(IBlogCommentRepository::class, BlogCommentRepository::class);

        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IProductGenreRepository::class, ProductGenreRepository::class);
        $this->app->bind(IProductTypeRepository::class, ProductTypeRepository::class);
        $this->app->bind(IProductTagRepository::class, ProductTagRepository::class);
        $this->app->bind(IProductCommentRepository::class, ProductCommentRepository::class);

    }
}