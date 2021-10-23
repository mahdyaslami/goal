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

        $steps = $this->prepareSteps(
            $book->page_count,
            $request->step_count
        );

        $book->steps()->createMany($steps);

        return redirect('/books');
    }

    public function prepareSteps($pageCount, $stepCount)
    {
        $result = [];
        $step = ceil($pageCount / $stepCount);

        for ($i = 0; $i < $stepCount; $i++) {
            $stepGoal = $i * $step;

            array_push($result, [
                'description' => "To page {$stepGoal}."
            ]);
        }

        return $result;
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
