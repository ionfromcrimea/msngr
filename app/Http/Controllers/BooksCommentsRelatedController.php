<?php

namespace App\Http\Controllers;

use App\Services\JSONAPIService;
use App\Book;
use Illuminate\Http\Request;

class BooksCommentsRelatedController extends Controller
{
    /**
     * @var JSONAPIService
     */
    private $service;

    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }

    public function index(Book $book)
    {
        return $this->service->fetchRelated($book, 'comments');
    }
}
