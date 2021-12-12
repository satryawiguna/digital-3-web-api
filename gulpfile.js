var elixir = require('laravel-elixir');
var del = require('del');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.extend('remove', function(path) {
    new elixir.Task('remove', function() {
        del(path);
    });
});

elixir(function(mix) {
    mix.copy('resources/assets/vendors/', 'public/assets/vendors/');
    mix.copy('resources/assets/common/', 'public/assets/common/');
    mix.copy('resources/assets/manual/', 'public/assets/vendors/');
    mix.copy('resources/uploads/', 'public/uploads/');
    mix.copy(['resources/views/admin/', '!resources/views/admin/index.blade.php'] , 'public/views/admin/');
    mix.remove(['public/views/admin/layouts/', 'public/views/admin/shared/' ]);

    mix.browserSync();
});

