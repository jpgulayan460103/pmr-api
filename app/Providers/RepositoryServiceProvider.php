<?php

namespace App\Providers;

use App\Repositories\Interfaces\PurchaseRequestRepositoryInterface;
use App\Repositories\PurchaseRequestRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {
        $this->app->bind(
            PurchaseRequestRepositoryInterface::class,
            PurchaseRequestRepository::class,
        );
    }
}