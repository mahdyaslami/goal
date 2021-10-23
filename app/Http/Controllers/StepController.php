<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepRequest;
use App\Models\Step;

class StepController extends Controller
{
    public function create()
    {
        # code...
    }

    public function store(StepRequest $request)
    {
        Step::create($request->validated());
    }
}
