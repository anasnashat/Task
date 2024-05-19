<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class taskRequest extends FormRequest
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
        $taskId = $this->route('task')->id ?? null;
        return [
            'title' => 'required|unique:task,title' . ($taskId ? ',' . $taskId : '') . '|max:255',
            'images.*' => 'required_if:images,null|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
