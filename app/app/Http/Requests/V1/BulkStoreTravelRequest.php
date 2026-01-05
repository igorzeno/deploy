<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreTravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.travelId' => ['required', 'integer'],
            '*.name' => ['required'],
            '*.status' => ['required', Rule::in(['N', 'P', 'C', 'n', 'p', 'c'])],
            '*.startingDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.endingDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.price' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['travel_id'] = $obj['travelId'] ?? null;
            $obj['starting_date'] = $obj['startingDate'] ?? null;
            $obj['ending_date'] = $obj['endingDate'] ?? null;

            $data[] = $obj;
        }
        $this->merge($data);
    }
}
