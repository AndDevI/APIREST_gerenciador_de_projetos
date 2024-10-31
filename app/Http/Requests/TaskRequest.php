<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
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
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
        ];
    }
    
    public function messages() {
        return [
            'title.required' => 'O título é obrigatório.',
            'status.in' => 'O status deve ser pending, in-progress, ou completed.',
            'due_date.date' => 'A data de entrega deve estar em um formato de data válido.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
