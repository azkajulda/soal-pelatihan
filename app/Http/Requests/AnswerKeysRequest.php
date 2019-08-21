<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerKeysRequest extends FormRequest
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
        dd($this->request->get('answer'));
        foreach ($this->request->get('answer') as $key => $val)
        {
            $rules['answer.'.$key] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('answer') as $key => $val)
        {
            $messages['items.'.$key.'.max'] = 'Soal Nomor '.$key.'" harus terisi walaupun jawaban belum tentu benar';
        }
        return $messages;
    }
}
