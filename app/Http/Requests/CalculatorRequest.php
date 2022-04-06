<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|integer|gt:0',
            'should_work' => 'required|integer|between:1,31|gte:actually_work',
            'actually_work' => 'required|integer|between:0,31',
            'year' => 'required|integer|gt:1900',
            'month' => 'required|integer|between:1,12',
            'mzp' => 'required|boolean',
            'pensioner' => 'required|boolean',
            'disability' => [
                'required',
                'integer',
                function ($attr, $value, $fail) {
                    if (!in_array($value, [0, 1, 2, 3])) {
                        $fail($attr . ' is not valid group');
                    }
                }
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'pensioner' => $this->toBoolean($this->pensioner),
            'mzp' => $this->toBoolean($this->mzp),
        ]);
    }

    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
