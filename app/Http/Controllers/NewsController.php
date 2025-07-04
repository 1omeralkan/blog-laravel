<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function headlines()
    {
        $apiKey = 'f82bd897289d48119127ddf7b4e2568e';
        $country = 'tr';
        $url = "https://newsapi.org/v2/top-headlines?country={$country}&apiKey={$apiKey}";

        $response = Http::get($url);
        if ($response->successful()) {
            $articles = $response->json('articles');
            // Sadece başlıkları al
            $headlines = collect($articles)->pluck('title')->filter()->values();
            return response()->json(['headlines' => $headlines]);
        } else {
            return response()->json(['headlines' => []], 500);
        }
    }
} 