<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Tailwind for pagination
        Paginator::useTailwind();

        // Pass message count to the admin layout
        View::composer('admin.AdminLayout.layout', function ($view) {
            $view->with('messageCount', ContactMessage::count());
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
