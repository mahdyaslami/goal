<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        return;
    }

    public function store(BookRequest $request)
    {
        return Book::create($request->validated());
    }
}
