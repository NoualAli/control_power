<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $accepted = request()->has('accepted') && !empty(request()->accepted) ? request()->accepted : 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf';
        // dd(request()->all());
        $isMultiple = is_array(request()->media);
        if ($isMultiple) {
            return [
                'attachable' => ['nullable', 'array'],
                'media' => ['required', 'array'],
                'media.*' => ['required', 'file', 'max:3000', 'mimes:' . $accepted]
            ];
        } else {
            return [
                'media' => ['required', 'file', 'max:3000', 'mimes:' . $accepted]
            ];
        }
    }
}