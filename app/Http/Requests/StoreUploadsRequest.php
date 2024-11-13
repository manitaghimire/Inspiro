<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadsRequest extends FormRequest
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
        $rules= [
            'title'=>['required','string','max:500'],
            'category_id'=>['required','integer','exists:categories,id'],
            'imageurl'=>['required','image', 'mimes:jpg,jpeg,png,gif,jfif', 'max:2048'],
            'caption'=>['nullable','string'],
            'link'=>['nullable', 'url'],
            'average_rating'=>['nullable','numeric', 'between:0,5'],
            'reviews'=>['nullable','integer','min:0'],
            'saves'=>['nullable','integer', 'min:0'],
            'tags'=>['nullable','array'],
            'tags.*'=>['string', 'max:100']            
        ];
        if($this->isMethod('post'))
        {
            $rules['imageurl']=['required','image', 'mimes:jpg,jpeg,png,gif,jfif', 'max:2048'];
        }
        else
        {
            $rules['imageurl']=['nullable','image', 'mimes:jpg,jpeg,png,gif,jfif', 'max:2048'];
        }
        return $rules;
    }
}
