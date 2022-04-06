<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CalculatorRequest;


use Illuminate\Validation\ValidationException;

class CalculatorController extends Controller
{

    public function view()
    {
        return view('calculator.show');
    }


    public function calculate(CalculatorRequest $request)
    {

        return response()->json([
            'result' => $request->amount * 0.9
        ]);
    }
}
