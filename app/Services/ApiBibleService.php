<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class ApiBibleService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('bibleapi.base_url');
        $this->apiKey = config('bibleapi.api_key');
    }

    // Fetch all available Bibles
    public function getBibles()
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
        ])->get("{$this->baseUrl}/bibles");

        if ($response->failed()) {
            // Handle error
            return null;
        }

        return $response->json();
    }

    // Fetch all books of a specific Bible
    public function getBooks(string $bibleId)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
        ])->get("{$this->baseUrl}/bibles/{$bibleId}/books");

        if ($response->failed()) {
            // Handle error
            return null;
        }

        return $response->json();
    }

    // Fetch chapters of a specific book
    public function getChapters(string $bibleId, string $bookId)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
        ])->get("{$this->baseUrl}/bibles/{$bibleId}/books/{$bookId}/chapters");

        if ($response->failed()) {
            // Handle error
            return null;
        }

        return $response->json();
    }


}
