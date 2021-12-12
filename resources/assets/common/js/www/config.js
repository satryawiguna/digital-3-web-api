app.config(function ($locationProvider, $routeProvider, $httpProvider, USER_ROLES) {
    $httpProvider.interceptors.push([
        '$injector',
        function ($injector) {
            return $injector.get('InterceptorAuthentication');
        }
    ]);

    $routeProvider.when('/', {
        redirectTo: '/dashboard',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.otherwise({
        redirectTo: '/404',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/dashboard', {
        templateUrl: 'views/admin/dashboard/index.html',
        controller: 'DashboardController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/login', {
        templateUrl: 'views/admin/auth/login.html',
        controller: 'LoginController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/logoff', {
        templateUrl: 'views/admin/auth/logoff.html',
        controller: 'LogoffController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/password/reset', {
        templateUrl: 'views/admin/auth/passwords/email.html',
        controller: 'EmailController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/401', {
        templateUrl: 'views/admin/errors/401.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/403', {
        templateUrl: 'views/admin/errors/403.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/404', {
        templateUrl: 'views/admin/errors/404.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/440', {
        templateUrl: 'views/admin/errors/440.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/500', {
        templateUrl: 'views/admin/errors/500.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    $routeProvider.when('/503', {
        templateUrl: 'views/admin/errors/503.html',
        controller: 'ErrorController',
        data: {
            authorizedRoles: [USER_ROLES.all]
        }
    });

    // ROLE ROUTE
    $routeProvider.when('/role', {
        templateUrl: 'views/admin/role/index.html',
        controller: 'RoleController',
        data: {
            authorizedRoles: [USER_ROLES.super]
        }
    });

    $routeProvider.when('/role/add', {
        templateUrl: 'views/admin/role/create.html',
        controller: 'RoleController',
        data: {
            authorizedRoles: [USER_ROLES.super]
        }
    });

    $routeProvider.when('/role/edit/:id', {
        templateUrl: 'views/admin/role/edit.html',
        controller: 'RoleController',
        data: {
            authorizedRoles: [USER_ROLES.super]
        }
    });

    // USER ROUTE
    $routeProvider.when('/user', {
        templateUrl: 'views/admin/user/index.html',
        controller: 'UserController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/user/add', {
        templateUrl: 'views/admin/user/create.html',
        controller: 'UserController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/user/edit/:id', {
        templateUrl: 'views/admin/user/edit.html',
        controller: 'UserController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // BLOG TAG ROUTE
    $routeProvider.when('/blogTag', {
        templateUrl: 'views/admin/blog_tag/index.html',
        controller: 'BlogTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blogTag/add', {
        templateUrl: 'views/admin/blog_tag/create.html',
        controller: 'BlogTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blogTag/edit/:id', {
        templateUrl: 'views/admin/blog_tag/edit.html',
        controller: 'BlogTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // BLOG CATEGORY ROUTE
    $routeProvider.when('/blogCategory', {
        templateUrl: 'views/admin/blog_category/index.html',
        controller: 'BlogCategoryController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blogCategory/add', {
        templateUrl: 'views/admin/blog_category/create.html',
        controller: 'BlogCategoryController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blogCategory/edit/:id', {
        templateUrl: 'views/admin/blog_category/edit.html',
        controller: 'BlogCategoryController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // BLOG ROUTE
    $routeProvider.when('/blog', {
        templateUrl: 'views/admin/blog/index.html',
        controller: 'BlogController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blog/add', {
        templateUrl: 'views/admin/blog/create.html',
        controller: 'BlogController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/blog/edit/:id', {
        templateUrl: 'views/admin/blog/edit.html',
        controller: 'BlogController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // PRODUCT TAG ROUTE
    $routeProvider.when('/productTag', {
        templateUrl: 'views/admin/product_tag/index.html',
        controller: 'ProductTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productTag/add', {
        templateUrl: 'views/admin/product_tag/create.html',
        controller: 'ProductTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productTag/edit/:id', {
        templateUrl: 'views/admin/product_tag/edit.html',
        controller: 'ProductTagController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // PRODUCT TYPE ROUTE
    $routeProvider.when('/productType', {
        templateUrl: 'views/admin/product_type/index.html',
        controller: 'ProductTypeController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productType/add', {
        templateUrl: 'views/admin/product_type/create.html',
        controller: 'ProductTypeController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productType/edit/:id', {
        templateUrl: 'views/admin/product_type/edit.html',
        controller: 'ProductTypeController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // PRODUCT GENRE ROUTE
    $routeProvider.when('/productGenre', {
        templateUrl: 'views/admin/product_genre/index.html',
        controller: 'ProductGenreController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productGenre/add', {
        templateUrl: 'views/admin/product_genre/create.html',
        controller: 'ProductGenreController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/productGenre/edit/:id', {
        templateUrl: 'views/admin/product_genre/edit.html',
        controller: 'ProductGenreController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // PRODUCT ROUTE
    $routeProvider.when('/product', {
        templateUrl: 'views/admin/product/index.html',
        controller: 'ProductController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/product/add', {
        templateUrl: 'views/admin/product/create.html',
        controller: 'ProductController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    $routeProvider.when('/product/edit/:id', {
        templateUrl: 'views/admin/product/edit.html',
        controller: 'ProductController',
        data: {
            authorizedRoles: [USER_ROLES.super, USER_ROLES.admin]
        }
    });

    // IMPORT DATA ROUTE
    $routeProvider.when('/importData', {
        templateUrl: 'views/admin/import_data/index.html',
        controller: 'ImportDataController',
        data: {
            authorizedRoles: [USER_ROLES.super]
        }
    });
});