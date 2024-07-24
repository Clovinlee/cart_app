<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $rule = [];
        if ($this->method() == "PUT") {
            $rule = [
                "name" => "required|string|max:255",
                "description" => "nullable|string",
                "price" => "required|numeric|min:0",
                "category_id" => "required|exists:categories,id"
            ];
        } else {
            $rule = [
                "name" => "sometimes|string|max:255",
                "description" => "sometimes|string",
                "price" => "sometimes|numeric|min:0",
                "category_id" => "sometimes|exists:categories,id"
            ];
        }
        return $rule;
    }
}
