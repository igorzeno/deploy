<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTravelRequest extends FormRequest
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
                'isPublic' => ['required'],
                'name' => ['required'],
                'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
                'numberOfDays' => ['required', 'integer'],
            ];
        } else {
            return [
                'isPublic' => ['sometimes', 'required'],
                'name' => ['sometimes', 'required'],
                'type' => ['sometimes', 'required', Rule::in(['I', 'B', 'i', 'b'])],
                'numberOfDays' => ['sometimes', 'required', 'integer'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->numberOfDays) {
            $this->merge([
                'number_of_days' => $this->numberOfDays,
            ]);
        }
        if($this->isPublic) {
            $this->merge([
                'is_public' => $this->isPublic,
            ]);
        }

    }
}
