<?php

namespace App\Http\Controllers;

use App\Services\ApiBibleService;
use Illuminate\Http\Request;

class BibleController extends Controller
{
    protected ApiBibleService $bibleService;

    public function __construct(ApiBibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    // Display all available Bibles
    public function index()
    {
        $bibles = $this->bibleService->getBibles();

        return view('bibles.index', ['bibles' => $bibles['data']]);
    }

    // Display all books in a specified Bible
    public function books(string $bibleId)
    {
        $books = $this->bibleService->getBooks($bibleId);

        return view('bibles.books', ['books' => $books['data']]);
    }

    // Display chapters of a specific book
    public function chapters(string $bibleId, string $bookId)
    {
        $chapters = $this->bibleService->getChapters($bibleId, $bookId);

        return view('bibles.chapters', ['chapters' => $chapters['data']]);
    }


}
