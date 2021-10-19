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

        $this->get($book->pathToEdit())
            ->assertOk()
            ->assertViewIs('books.edit');
    }

    public function test_edit_page_contain_the_book_title()
    {
        $book = Book::factory()->create();

        $res = $this->get($book->pathToEdit());

        $this->assertDomHasInput($res, 'text', 'title', [
            'value' => $book->title,
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }
}
