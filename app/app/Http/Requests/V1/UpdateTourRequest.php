<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTourRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'travelId' => ['required', 'integer'],
                'name' => ['required'],
                'status' => ['required', Rule::in(['N', 'P', 'C', 'n', 'p', 'c'])],
                'startingDate' => ['required', 'date_format:Y-m-d H:i:s'],
                'endingDate' => ['required', 'date_format:Y-m-d H:i:s'],
                'price' => ['required', 'integer'],
            ];
        } else {
            return [
                'travelId' => ['sometimes', 'required', 'integer'],
                'name' => ['sometimes', 'required'],
                'status' => ['sometimes', 'required', Rule::in(['N', 'P', 'C', 'n', 'p', 'c'])],
                'startingDate' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
                'endingDate' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
                'price' => ['sometimes', 'required', 'integer'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->travelId) {
            $this->merge([
                'travel_id' => $this->travelId,
            ]);
        }
        if($this->startingDate) {
            $this->merge([
                'starting_date' => $this->startingDate,
            ]);
        }
        if($this->endingDate) {
            $this->merge([
                'ending_date' => $this->endingDate,
            ]);
        }

    }
}
