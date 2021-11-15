<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;

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
        $book = Book::create($request->validated());

        $book->createSteps($request->step_count);

        return redirect($book->pathToEdit());
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

        return redirect('/books');
    }
}
