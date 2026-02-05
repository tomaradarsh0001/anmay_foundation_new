<?php

namespace App\Providers;
use App\Models\Cause;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Testimonial;
use App\Models\WebsiteDetail;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
            View::share('globalCauses', Cause::latest()->get());
           View::share('globalTestimonials', Testimonial::latest()->get());
            View::composer('*', function ($view) {
                        $websiteDetails = WebsiteDetail::first(); // singleton
                        $view->with('websiteDetails', $websiteDetails);
                    });

    }
}
