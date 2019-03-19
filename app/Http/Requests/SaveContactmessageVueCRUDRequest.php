<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ContactmessageVueCRUDFormdatabuilder;
use App\Contactmessage;
use App\Mail\ContactmessageResponseMail;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveContactmessageVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ContactmessageVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Contactmessage $subject)
    {
        $dataset = $this->getDataset();
        $dataset['name'] = $subject->name;
        try {
            \Mail::send(new ContactmessageResponseMail($dataset));
        } catch (\Exception $e) {
            $subject->logLastActionTaken('Küldés sikertelen: '.$e->getMessage());
            return false;
        }
        $subject->logLastActionTaken('Válasz elküldve: '.$dataset['response']);

        return $subject;
    }

    public function getDataset()
    {
        $result = [
            'email' => $this->input('email'),
            'subject' => $this->input('subject'),
            'response' => $this->input('response')
        ];

        return $result;
    }
}
