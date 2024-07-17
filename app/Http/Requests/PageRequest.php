<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{ 
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('articles')->ignore($this->id), // уникальный slug, игнорирую текущую страницу при обновлении
            ], 
            'content' => 'nullable|string', 
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
        'content.string' => 'Поле "Содержание" должно быть строкой.', 
    ];
}
}
