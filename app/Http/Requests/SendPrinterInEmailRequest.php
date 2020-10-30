<?php

namespace App\Http\Requests;

use App\Mail\SendPrinter;
use Illuminate\Foundation\Http\FormRequest;

class SendPrinterInEmailRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'email_sidenote' => 'max:0', //honeypot
        ];
    }

    public function messages()
    {
        return [
            'email_sidenote.max' => 'Bot check failed'
        ];
    }

    public function send()
    {
        \Mail::send(new SendPrinter())
    }
}
