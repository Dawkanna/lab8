<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'          => 'required|string|min:3|max:255',
            'author'         => 'required|string|min:3|max:255',
            'published_date' => 'required|date',
            'price'          => 'required|numeric|min:0',
            'genre'          => 'required|string|min:3|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Номын нэрийг заавал бөглөнө үү.',
            'title.min'      => 'Номын нэр хамгийн багадаа 3 тэмдэгт байна.',
            'author.required'=> 'Зохиолчийн нэрийг заавал бөглөнө үү.',
            'price.numeric'  => 'Үнэ зөвхөн тоон утга байх ёстой.',
            'genre.required' => 'Жанрын мэдээллийг оруулна уу.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'          => 'Номын нэр',
            'author'         => 'Зохиолчийн нэр',
            'published_date' => 'Хэвлэгдсэн огноо',
            'price'          => 'Үнэ',
            'genre'          => 'Жанр',
        ];
    }
}
