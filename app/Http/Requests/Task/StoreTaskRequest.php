<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskPriority;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // an other way to handle the token
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', Rule::enum(TaskPriority::class)],
            'category_id' => ['required', 'exists:categories,id'],
            'due_date' => ['required', 'date_format:Y-m-d'],
            'completed' => ['boolean'],
            'image_url' => ['nullable', 'string', 'max:500'],
        ];
    }

    protected function prepareForValidation(): void
    {
        //forcing the priority to be lowercase to match enum cases and avoid validation issues
        if ($this->has('priority')) {
            $this->merge([
                'priority' => strtolower($this->input('priority')),
            ]);
        }
    }
}
