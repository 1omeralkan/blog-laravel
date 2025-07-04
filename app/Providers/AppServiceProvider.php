<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use App\Http\Responses\LogoutResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $apiKey = 'f82bd897289d48119127ddf7b4e2568e';
                $url = "https://newsapi.org/v2/top-headlines?country=us&category=technology&apiKey={$apiKey}";
                $response = Http::timeout(3)->get($url);
                $headlines = $response->successful()
                    ? collect($response->json('articles'))->pluck('title')->filter()->values()->all()
                    : [];
                \Log::info('NewsAPI headlines:', $headlines);
            } catch (\Exception $e) {
                $headlines = [];
                \Log::error('NewsAPI error: ' . $e->getMessage());
            }
            $view->with('headlines', $headlines);
        });
    }
}
