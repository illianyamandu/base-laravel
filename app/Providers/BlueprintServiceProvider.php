<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintServiceProvider extends ServiceProvider
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
        Blueprint::macro('createdUpdatedBy', function () {
            /** @var Blueprint $this */
            $this->uuid('created_by')->nullable();
            $this->uuid('updated_by')->nullable();
            $this->foreign('created_by')->references('id')->on('users');
            $this->foreign('updated_by')->references('id')->on('users');
        });
    }
}
