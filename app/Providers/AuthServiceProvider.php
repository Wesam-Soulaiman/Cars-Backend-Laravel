<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\CarPart;
use App\Models\Product;
use App\Policies\CarPartPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductPolicy1;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        Product::class => ProductPolicy1::class,
        Product::class => ProductPolicy::class,
        CarPart::class => CarPartPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
