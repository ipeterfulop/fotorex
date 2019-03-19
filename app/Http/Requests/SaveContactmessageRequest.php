<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactmessageRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'A név nem lehet üres',
            'email.required' => 'Az e-mailcím nem lehet üres',
            'email.email' => 'Az e-mailcím formátuma nem megfelelő',
            'message.required' => 'Az üzenet nem lehet üres',
        ];
    }

    public function getDataset()
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone', null),
            'message' => $this->input('message'),
        ];
    }
}
