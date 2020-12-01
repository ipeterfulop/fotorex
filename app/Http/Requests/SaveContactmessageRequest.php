<?php

namespace App\Http\Requests;

use App\Contactmessage;
use App\Printer;
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
            'subject' => 'required',
            'message' => 'required',
            'printer_id' => 'sometimes|exists:printers,id'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'A név nem lehet üres',
            'email.required' => 'Az e-mailcím nem lehet üres',
            'email.email' => 'Az e-mailcím formátuma nem megfelelő',
            'subject.required' => 'A tárgy nem lehet üres',
            'message.required' => 'Az üzenet nem lehet üres',
        ];
    }

    public function save()
    {
        return Contactmessage::create($this->getDataset());
    }

    protected function getDataset()
    {
        $result = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone', null),
            'subject' => $this->input('subject'),
            'message' => $this->input('message'),
        ];
        if ($this->has('printer_id')) {
            $printer = Printer::find($this->input('printer_id'));
            $result['printername'] = $printer->name;
            $result['printerdata'] = $printer->toJson();
        }

        return $result;
    }
}
