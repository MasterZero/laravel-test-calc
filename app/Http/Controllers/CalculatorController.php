<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
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
        $salary = new Salary;
        $salary->fill($request->all());
        $salary->calculate();

        return response()->json($salary->toArray());
    }

    public function save(CalculatorRequest $request)
    {
        $salary = Salary::where([
            'amount' => $request->amount,
            'should_work' => $request->should_work,
            'actually_work' => $request->actually_work,
            'mzp' => $request->mzp,
            'pensioner' => $request->pensioner,
            'disability' => $request->disability,
            'year' => $request->year,
            'month' => $request->month,
        ])->first();

        if ($salary) {
            return response()->json($salary->toArray());
        }

        $salary = new Salary;
        $salary->fill($request->all());
        $salary->calculate();
        $salary->save();

        return response()->json($salary->toArray());
    }
}
