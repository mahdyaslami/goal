<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_edit_book_page()
    {
        $book = Book::factory()->create();

        $response = $this->get($book->pathToEdit())
            ->assertOk()
            ->assertViewIs('books.edit');

        return [
            'book' => $book,
            'res' => $response
        ];
    }

    /** @depends test_show_edit_book_page */
    public function test_it_contain_the_book_form($args)
    {
        extract($args);

        $this->assertDomHasTag($res, 'form', [
            'action' => $book->pathToUpdate(),
            'method' => 'POST'
        ]);

        $this->assertDomHasInput($res, 'hidden', '_method', [
            'value' => 'PUT'
        ]);
    }

    /** @depends test_show_edit_book_page */
    public function test_it_contain_the_book_title($args)
    {
        extract($args);

        $this->assertDomHasInput($res, 'text', 'title', [
            'value' => $book->title,
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }

    /** @depends test_show_edit_book_page */
    public function test_it_contain_the_book_page_count($args)
    {
        extract($args);

        $this->assertDomHasInput($res, 'number', 'page_count', [
            'value' => $book->page_count,
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }
}
