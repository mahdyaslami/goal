<?php

namespace Tests\Feature\Book;

trait HasBookForm
{
    /** @depends test_it_has_form */
    public function test_it_has_input_for_title()
    {
        $this->assertDomHasInput($this->response, 'text', 'title', [
            'value' => $this->book ? $this->book->title : '',
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }

    /** @depends test_it_has_form */
    public function test_it_has_input_for_page_count()
    {
        $this->assertDomHasInput($this->response, 'number', 'page_count', [
            'value' => $this->book ? $this->book->page_count : '',
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }

    /** @depends test_it_has_form */
    public function test_it_has_link_to_books_page()
    {
        $this->assertDomHasLink($this->response, '/books');
    }
}
