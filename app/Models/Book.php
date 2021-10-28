<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'page_count'];

    public function pathToEdit()
    {
        return route('book-edit', ['book' => $this->id]);
    }

    public function path()
    {
        return route('book-update', ['book' => $this->id]);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function createSteps($count)
    {
        $steps = [];
        $step = ceil($this->page_count / $count);

        for ($i = 1; $i <= $count; $i++) {
            $stepGoal = $i * $step;

            array_push($steps, [
                'description' => "To page {$stepGoal}."
            ]);
        }

        return $this->steps()->createMany($steps);
    }

    public function recentlyCreated()
    {
        return $this->created_at->diffInSeconds() < 5;
    }
}
