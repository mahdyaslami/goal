<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepRequest;
use App\Models\Step;

class StepController extends Controller
{
    public function update(Step $step, StepRequest $request)
    {
        $step->update($request->validated());

        return redirect($step->book->pathToEdit());
    }
}
