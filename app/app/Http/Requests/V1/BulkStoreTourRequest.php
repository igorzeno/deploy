<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreTourRequest extends FormRequest
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
            '*.is_public' => ['required', 'boolean'],
            '*.name' => ['required'],
            '*.type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
            '*.numberOfDays' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['number_of_days'] = $obj['numberOfDays'] ?? null;
            $obj['is_public'] = $obj['isPublic'] ?? null;

            $data[] = $obj;
        }
        $this->merge($data);
    }
}
