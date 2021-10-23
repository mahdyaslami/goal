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

    public function pathToUpdate()
    {
        return route('book-update', ['book' => $this->id]);
    }
}
