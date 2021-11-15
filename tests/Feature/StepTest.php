<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Step;
use Illuminate\Support\Str;
use Tests\TestCase;

class StepTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->book = Book::factory()->hasSteps()->create();
        $this->step = $this->book->steps()->first();
    }

    public function test_description_is_required()
    {
        $this->request('')
            ->assertSessionHasErrors('description');
    }

    public function test_it_update_a_step()
    {
        $description = Str::random();

        $this->request($description)
            ->assertRedirect($this->book->pathToEdit());

        $this->assertDatabaseHas('steps', [
            'id' => $this->step->id,
            'description' => $description
        ]);
    }

    protected function request($description)
    {
        return $this->put($this->step->path(), [
            'description' => $description
        ]);
    }
}
