<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                Rule::unique('articles')->ignore($this->id), // уникальный slug, игнорирую текущую статью при обновлении
            ],
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'category_id' => 'required|integer',
        ];

        return $rules;
    }

    public function messages(): array
{
    return [
        'title.required' => 'Поле "Название статьи" обязательно для заполнения.',
        'title.string' => 'Поле "Название статьи" должно быть строкой.',
        'title.max' => 'Поле "Название статьи" не должно превышать 255 символов.',
        'slug.string' => 'Поле "Постоянная ссылка" должно быть строкой.',
        'slug.unique' => 'Такое значение поля "Постоянная ссылка" уже существует.',
        'description.string' => 'Поле "Аннотация" должно быть строкой.',
        'description.max' => 'Поле "Аннотация" не должно превышать 500 символов.',
        'content.string' => 'Поле "Содержание" должно быть строкой.',
        'category_id.required' => 'Поле "Категория" обязательно для заполнения.',
        'category_id.integer' => 'Поле "Категория" должно быть числом.',
    ];
}

}
