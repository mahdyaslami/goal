<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['index', 'description'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
