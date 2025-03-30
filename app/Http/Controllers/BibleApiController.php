<?php

namespace App\Http\Controllers;

use App\Services\ApiBibleService;
use Illuminate\Http\Request;

class BibleApiController extends Controller
{
    protected ApiBibleService $bibleService;

    public function __construct(ApiBibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    public function getBibles()
    {
        try {
            $bibles = $this->bibleService->getBibles();

            return response()->json([
                'success' => true,
                'data' => $bibles['data'] ?? [],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getBooks($bibleId)
    {
        try {
            $books = $this->bibleService->getBooks($bibleId);

            return response()->json([
                'success' => true,
                'data' => $books['data'] ?? [],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
