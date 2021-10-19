<?php

namespace Tests\Feature\Book;

use Illuminate\Support\Str;

trait HasBookRequest
{
    public function test_title_is_required()
    {
        $this->assertValidationFail('title', '');
    }

    public function test_title_should_be_shorter_than_256()
    {
        $this->assertValidationFail('title', Str::random(256));
    }

    public function test_title_should_be_at_least_255()
    {
        $this->assertValidationOk('title', Str::random(255));
    }

    public function test_page_count_is_required()
    {
        $this->assertValidationFail('page_count', '');
    }

    public function test_page_count_is_integer()
    {
        $this->assertValidationFail('page_count', 'not-a-number');
    }

    public function test_step_count_is_required()
    {
        $this->assertValidationFail('step_count', '');
    }

    public function test_step_count_is_integer()
    {
        $this->assertValidationFail('step_count', 'not-a-number');
    }
}
