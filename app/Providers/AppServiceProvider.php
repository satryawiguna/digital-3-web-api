<?php
namespace App\Providers;


use App\Services\Contract\IAuthService;
use App\Services\Contract\IBlogCategoryService;
use App\Services\Contract\IBlogService;
use App\Services\Contract\IBlogTagService;
use App\Services\Contract\ICheckoutService;
use App\Services\Contract\IFileManagerService;
use App\Services\Contract\IImportDataService;
use App\Services\Contract\IProductGenreService;
use App\Services\Contract\IProductService;
use App\Services\Contract\IProductTagService;
use App\Services\Contract\IProductTypeService;
use App\Services\Contract\IRoleService;
use App\Services\Contract\IUserService;
use App\Services\Implement\AuthService;
use App\Services\Implement\BlogCategoryService;
use App\Services\Implement\BlogService;
use App\Services\Implement\BlogTagService;
use App\Services\Implement\CheckoutService;
use App\Services\Implement\FileManagerService;
use App\Services\Implement\ImportDataService;
use App\Services\Implement\ProductGenreService;
use App\Services\Implement\ProductService;
use App\Services\Implement\ProductTagService;
use App\Services\Implement\ProductTypeService;
use App\Services\Implement\RoleService;
use App\Services\Implement\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IFileManagerService::class, FileManagerService::class);
        $this->app->bind(IImportDataService::class, ImportDataService::class);

        $this->app->bind(IBlogService::class, BlogService::class);
        $this->app->bind(IBlogCategoryService::class, BlogCategoryService::class);
        $this->app->bind(IBlogTagService::class, BlogTagService::class);

        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IProductGenreService::class, ProductGenreService::class);
        $this->app->bind(IProductTypeService::class, ProductTypeService::class);
        $this->app->bind(IProductTagService::class, ProductTagService::class);

        $this->app->bind(ICheckoutService::class, CheckoutService::class);
    }
}
