<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'books' => Book::all()
        ]);
    }

    public function create(Book $book)
    {
        return view('books.create', ['book' => $book]);
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());

        return redirect('/books');
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update(
            $request->validated()
        );

        return $book;
    }
}
