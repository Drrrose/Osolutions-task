<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskPriority;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        'title' => ['sometimes', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'priority' => ['sometimes', Rule::enum(TaskPriority::class)], // using sometimes cause it may not need to be updated
        'category_id' => ['sometimes', 'exists:categories,id'],
        'due_date' => ['sometimes', 'date_format:Y-m-d'],
        'completed' => ['boolean'],
        'image_url' => ['nullable', 'string', 'max:500'],
        ];
    }
}
