<?php

namespace App\Providers;

use App\PlacesSearch\ApiService;
use App\PlacesSearch\ApiServiceInterface;
use App\PlacesSearch\CalculateDistance;
use App\PlacesSearch\CalculateDistanceInterface;
use App\PlacesSearch\FilterOutput;
use App\PlacesSearch\FilterOutputInterface;
use App\PlacesSearch\PlacesSearch;
use App\PlacesSearch\PlacesSearchInterface;
use App\PlacesSearch\SortOutput;
use App\PlacesSearch\SortOutputInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GuzzleClientInterface::class, GuzzleClient::class);
        $this->app->bind(ApiServiceInterface::class, ApiService::class);

        $this->app->bind(CalculateDistanceInterface::class, CalculateDistance::class);
        $this->app->bind(SortOutputInterface::class, SortOutput::class);
        $this->app->bind(FilterOutputInterface::class, FilterOutput::class);

        $this->app->bind(PlacesSearchInterface::class, PlacesSearch::class);
    }

    public function boot(): void
    {

    }
}
