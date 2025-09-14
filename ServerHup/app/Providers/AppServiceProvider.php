<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Server;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        $locale = session('locale' , Config::get('app.locale'));

        App::setLocale($locale);

        Gate::define('create-server' , function (User $user){
            return str_ends_with($user->email, '@example.com');
        });

        Gate::define('show-server', function (User $user , Server $server){
                return $user->servers->contains($server->id);
        });

        Gate::define('edit-server', function (User $user , Server $server){
                return $server->owner->id === $user->id;
        });

        Gate::define('edit-post', function ($user, Post $post) {
        return $user->id === $post->server->created_by;
        });

        Gate::define('delete-post', function ($user, Post $post) {
            return $user->id === $post->server->created_by;
        });

        Gate::define('update-post', function ($user, Post $post) {
            return $user->id === $post->server->created_by;
        });
    }
}
