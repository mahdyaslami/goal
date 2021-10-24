<?php

namespace Tests\Feature\Book;

trait HasBookForm
{
    /** @depends test_has_form */
    protected function test_has_input_for_title($args)
    {
        extract($args);

        $this->assertDomHasInput($response, 'text', 'title', [
            'value' => $book ? $book->title : '',
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }

    /** @depends test_has_form */
    protected function test_has_input_for_page_count($args)
    {
        extract($args);

        $this->assertDomHasInput($response, 'number', 'page_count', [
            'value' => $book ? $book->page_count : '',
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }

    /** @depends test_has_form */
    protected function test_has_link_to_books_page()
    {
        extract($args);

        $this->assertDomHasLink($response, '/books');
    }
}
