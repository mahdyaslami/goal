<?php

namespace Tests\Feature\Book;

trait HasBookFormAssertion
{
    protected function assertHasInputForTitle($response, $book = null)
    {
        $this->assertDomHasInput($response, 'text', 'title', [
            'value' => $book ? $book->title : '',
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }

    protected function assertHasInputForPageCount($response, $book = null)
    {
        $this->assertDomHasInput($response, 'number', 'page_count', [
            'value' => $book ? $book->page_count : '',
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }

    protected function assertHasInputForStepCount($response, $book = null)
    {
        $this->assertDomHasInput($response, 'number', 'step_count', [
            'value' => $book ? $book->page_count : '',
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }

    protected function assertHasLinkToAllBooksPage($response)
    {
        $this->assertDomHasLink($response, '/books');
    }
}
