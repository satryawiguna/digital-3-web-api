<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

	$api->get('/product/getAllProducts', ['as' => 'getAllProducts', 'uses' => 'App\Api\V1\Controllers\ProductController@getAllProducts']);
	$api->get('/product/getDetailProducts', ['as' => 'getDetailProducts', 'uses' => 'App\Api\V1\Controllers\ProductController@getDetailProducts']);

	$api->get('/productType/getAllProductTypes', ['as' => 'getAllProductTypes', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@getAllProductTypes']);

	$api->get('/productGenre/getAllProductGenres/{id}', ['as' => 'getAllProductGenres', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getAllProductGenres']);

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');
	$api->get('auth/getAuthenticatedUser', 'App\Api\V1\Controllers\AuthController@getAuthenticatedUser');

	$api->post('/checkout/sendOrder', ['middleware' => 'api.auth', 'as' => 'sendOrder', 'uses' => 'App\Api\V1\Controllers\CheckoutController@sendOrder']);

	$api->post('/fileManager/getAccessKey', ['middleware' => 'api.auth', 'as' => 'fileManagerGetAccessKey', 'uses' => 'App\Api\V1\Controllers\FileManagerController@getAccessKey']);
	$api->post('/fileManager/folderPath', ['middleware' => 'api.auth', 'as' => 'fileManagerFolderPath', 'uses' => 'App\Api\V1\Controllers\FileManagerController@folderPath']);
	$api->post('/fileManager/subFolderPath', ['middleware' => 'api.auth', 'as' => 'fileManagerSubFolderPath', 'uses' => 'App\Api\V1\Controllers\FileManagerController@subFolderPath']);

	$api->post('/importData/product', ['middleware' => 'api.auth', 'as' => 'importDataProduct', 'uses' => 'App\Api\V1\Controllers\ImportDataController@product']);

	$api->post('/role/getAll', ['middleware' => 'api.auth', 'as' => 'roleGetAll', 'uses' => 'App\Api\V1\Controllers\RoleController@getAll']);
	$api->get('/role/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'roleGetDetail', 'uses' => 'App\Api\V1\Controllers\RoleController@getDetail']);
	$api->post('/role/create', ['middleware' => 'api.auth', 'as' => 'roleCreate', 'uses' => 'App\Api\V1\Controllers\RoleController@create']);
	$api->post('/role/update', ['middleware' => 'api.auth', 'as' => 'roleUpdate', 'uses' => 'App\Api\V1\Controllers\RoleController@update']);
	$api->get('/role/delete/{id}', ['middleware' => 'api.auth', 'as' => 'roleDelete', 'uses' => 'App\Api\V1\Controllers\RoleController@delete']);
	$api->get('/role/getRoleList', ['middleware' => 'api.auth', 'as' => 'roleList', 'uses' => 'App\Api\V1\Controllers\RoleController@getRoleList']);

	$api->get('/user/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'userGetDetail', 'uses' => 'App\Api\V1\Controllers\UserController@getDetail']);
	$api->post('/user/create', ['middleware' => 'api.auth', 'as' => 'userCreate', 'uses' => 'App\Api\V1\Controllers\UserController@create']);
	$api->post('/user/update', ['middleware' => 'api.auth', 'as' => 'userUpdate', 'uses' => 'App\Api\V1\Controllers\UserController@update']);
	$api->get('/user/getUserByEmail', ['middleware' => 'api.auth', 'as' => 'userByEmail', 'uses' => 'App\Api\V1\Controllers\UserController@getUserByEmail']);
	$api->get('/user/activate/{id}', ['as' => 'userActivate', 'uses' => 'App\Api\V1\Controllers\UserController@getUserActivate']);

	$api->post('/blogTag/getAll', ['middleware' => 'api.auth', 'as' => 'blogTagGetAll', 'uses' => 'App\Api\V1\Controllers\BlogTagController@getAll']);
	$api->get('/blogTag/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'blogTagGetDetail', 'uses' => 'App\Api\V1\Controllers\BlogTagController@getDetail']);
	$api->post('/blogTag/create', ['middleware' => 'api.auth', 'as' => 'blogTagCreate', 'uses' => 'App\Api\V1\Controllers\BlogTagController@create']);
	$api->post('/blogTag/update', ['middleware' => 'api.auth', 'as' => 'blogTagUpdate', 'uses' => 'App\Api\V1\Controllers\BlogTagController@update']);
	$api->get('/blogTag/delete/{id}', ['middleware' => 'api.auth', 'as' => 'blogTagDelete', 'uses' => 'App\Api\V1\Controllers\BlogTagController@delete']);
	$api->get('/blogTag/getBlogTagByName', ['middleware' => 'api.auth', 'as' => 'blogTagByName', 'uses' => 'App\Api\V1\Controllers\BlogTagController@getBlogTagByName']);
	$api->get('/blogTag/getBlogTagSlugByName', ['middleware' => 'api.auth', 'as' => 'slugByName', 'uses' => 'App\Api\V1\Controllers\BlogTagController@getBlogTagSlugByName']);

	$api->post('/blogCategory/getAll', ['middleware' => 'api.auth', 'as' => 'blogCategoryGetAll', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getAll']);
	$api->get('/blogCategory/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'blogCategoryGetDetail', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getDetail']);
	$api->post('/blogCategory/create', ['middleware' => 'api.auth', 'as' => 'blogCategoryCreate', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@create']);
	$api->post('/blogCategory/update', ['middleware' => 'api.auth', 'as' => 'blogCategoryUpdate', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@update']);
	$api->get('/blogCategory/delete/{id}', ['middleware' => 'api.auth', 'as' => 'blogCategoryDelete', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@delete']);
	$api->get('/blogCategory/getBlogCategoryByName', ['middleware' => 'api.auth', 'as' => 'blogCategoryByName', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getBlogCategoryByName']);
	$api->get('/blogCategory/getBlogCategoryList', ['middleware' => 'api.auth', 'as' => 'blogCategoryList', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getBlogCategoryList']);
	$api->get('/blogCategory/getBlogCategoryHierarchy', ['middleware' => 'api.auth', 'as' => 'blogCategoryHierarchy', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getBlogCategoryHierarchy']);
	$api->get('/blogCategory/getBlogCategorySlugByName', ['middleware' => 'api.auth', 'as' => 'slugByName', 'uses' => 'App\Api\V1\Controllers\BlogCategoryController@getBlogCategorySlugByName']);

	$api->post('/blog/getAll', ['middleware' => 'api.auth', 'as' => 'blogGetAll', 'uses' => 'App\Api\V1\Controllers\BlogController@getAll']);
	$api->get('/blog/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'blogGetDetail', 'uses' => 'App\Api\V1\Controllers\BlogController@getDetail']);
	$api->post('/blog/create', ['middleware' => 'api.auth', 'as' => 'blogCreate', 'uses' => 'App\Api\V1\Controllers\BlogController@create']);
	$api->post('/blog/update', ['middleware' => 'api.auth', 'as' => 'blogUpdate', 'uses' => 'App\Api\V1\Controllers\BlogController@update']);
	$api->get('/blog/delete/{id}', ['middleware' => 'api.auth', 'as' => 'blogDelete', 'uses' => 'App\Api\V1\Controllers\BlogController@delete']);
	$api->get('/blog/getBlogSlugByTitle', ['middleware' => 'api.auth', 'as' => 'slugByTitle', 'uses' => 'App\Api\V1\Controllers\BlogController@getBlogSlugByTitle']);

	$api->post('/productTag/getAll', ['middleware' => 'api.auth', 'as' => 'productTagGetAll', 'uses' => 'App\Api\V1\Controllers\ProductTagController@getAll']);
	$api->get('/productTag/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'productTagGetDetail', 'uses' => 'App\Api\V1\Controllers\ProductTagController@getDetail']);
	$api->post('/productTag/create', ['middleware' => 'api.auth', 'as' => 'productTagCreate', 'uses' => 'App\Api\V1\Controllers\ProductTagController@create']);
	$api->post('/productTag/update', ['middleware' => 'api.auth', 'as' => 'productTagUpdate', 'uses' => 'App\Api\V1\Controllers\ProductTagController@update']);
	$api->get('/productTag/delete/{id}', ['middleware' => 'api.auth', 'as' => 'productTagDelete', 'uses' => 'App\Api\V1\Controllers\ProductTagController@delete']);
	$api->get('/productTag/getProductTagByName', ['middleware' => 'api.auth', 'as' => 'productTagByName', 'uses' => 'App\Api\V1\Controllers\ProductTagController@getProductTagByName']);
	$api->get('/productTag/getProductTagSlugByName', ['middleware' => 'api.auth', 'as' => 'slugByName', 'uses' => 'App\Api\V1\Controllers\ProductTagController@getProductTagSlugByName']);

	$api->post('/productType/getAll', ['middleware' => 'api.auth', 'as' => 'productTypeGetAll', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@getAll']);
	$api->get('/productType/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'productTypeGetDetail', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@getDetail']);
	$api->post('/productType/create', ['middleware' => 'api.auth', 'as' => 'productTypeCreate', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@create']);
	$api->post('/productType/update', ['middleware' => 'api.auth', 'as' => 'productTypeUpdate', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@update']);
	$api->get('/productType/delete/{id}', ['middleware' => 'api.auth', 'as' => 'productTypeDelete', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@delete']);
	$api->get('/productType/getProductTypeList', ['middleware' => 'api.auth', 'as' => 'productTypeList', 'uses' => 'App\Api\V1\Controllers\ProductTypeController@getProductTypeList']);

	$api->post('/productGenre/getAll', ['middleware' => 'api.auth', 'as' => 'productGenreGetAll', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getAll']);
	$api->get('/productGenre/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'productGenreGetDetail', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getDetail']);
	$api->post('/productGenre/create', ['middleware' => 'api.auth', 'as' => 'productGenreCreate', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@create']);
	$api->post('/productGenre/update', ['middleware' => 'api.auth', 'as' => 'productGenreUpdate', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@update']);
	$api->get('/productGenre/delete/{id}', ['middleware' => 'api.auth', 'as' => 'productGenreDelete', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@delete']);
	$api->get('/productGenre/getProductGenreByName', ['middleware' => 'api.auth', 'as' => 'productGenreByName', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getProductGenreByName']);
	$api->get('/productGenre/getProductGenreList', ['middleware' => 'api.auth', 'as' => 'productGenreList', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getProductGenreList']);
	$api->get('/productGenre/getProductGenreHierarchy', ['middleware' => 'api.auth', 'as' => 'productGenreHierarchy', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getProductGenreHierarchy']);
	$api->get('/productGenre/getProductGenreSlugByName', ['middleware' => 'api.auth', 'as' => 'slugByName', 'uses' => 'App\Api\V1\Controllers\ProductGenreController@getProductGenreSlugByName']);

	$api->post('/product/getAll', ['middleware' => 'api.auth', 'as' => 'productGetAll', 'uses' => 'App\Api\V1\Controllers\ProductController@getAll']);
	$api->get('/product/getDetail/{id}', ['middleware' => 'api.auth', 'as' => 'productGetDetail', 'uses' => 'App\Api\V1\Controllers\ProductController@getDetail']);
	$api->post('/product/create', ['middleware' => 'api.auth', 'as' => 'productCreate', 'uses' => 'App\Api\V1\Controllers\ProductController@create']);
	$api->post('/product/update', ['middleware' => 'api.auth', 'as' => 'productUpdate', 'uses' => 'App\Api\V1\Controllers\ProductController@update']);
	$api->get('/product/delete/{id}', ['middleware' => 'api.auth', 'as' => 'productDelete', 'uses' => 'App\Api\V1\Controllers\ProductController@delete']);
	$api->get('/product/getProductByTitle', ['middleware' => 'api.auth', 'as' => 'productByTitle', 'uses' => 'App\Api\V1\Controllers\ProductController@getProductByTitle']);
	$api->get('/product/getProductSlugByTitle', ['middleware' => 'api.auth', 'as' => 'slugByTitle', 'uses' => 'App\Api\V1\Controllers\ProductController@getProductSlugByTitle']);
});
