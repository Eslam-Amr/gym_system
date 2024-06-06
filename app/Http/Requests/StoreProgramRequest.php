<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
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
            'title'=>'required|unique:programs,title|string',
'slogan'=>'required|unique:programs,slogan|string',
'price'=>'numeric|required|min:0',
'discount'=>'numeric|required|min:0|max:100',
'duration'=>'numeric|required|min:0|max:12',
'limit'=>'numeric|required|min:1|max:100',
        ];
    }
    public function attributes()
    {
        return [
            'title'=>__("keywords.title"),
'slogan'=>__("keywords.slogan"),
'price'=>__("keywords.price"),
'discount'=>__("keywords.discount"),
'duration'=>__("keywords.durationInMonth"),
'limit'=>__("keywords.limit"),
        ];
    }
}
