<?php


namespace App\Formdatabuilders;


use App\Contactmessage;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\RichtextTrixVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ContactmessageVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['email'] = (new TextVueCRUDFormfield())
            ->setLabel('Címzett')
            ->setMandatory(true)
            ->setContainerClass('col-12');
        $result['subject'] = (new TextVueCRUDFormfield())
            ->setLabel('Üzenet tárgya')
            ->setMandatory(true)
            ->setContainerClass('col-12');
        $result['response'] = (new RichtextTrixVueCRUDFormfield())
            ->setLabel('Üzenet')
            ->setMandatory(true)
            ->setContainerClass('col-12');

        return collect($result);
    }

    public function __construct(Contactmessage $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $response = '<br><br>'
            .'<p>Üzenet feladója: '.$this->subject->name
            .' ('.$this->subject->email;
        if ($this->subject->phone != null) {
            $response .= ', '.$this->subject->phone;
        }
        $response .= ')<br>Üzenet beküldve: '.$this->subject->created_at_label;
        $response .= '<br>Üzenet:<br>'.str_ireplace("\n", '<br>', $this->subject->message);
        $this->defaults = $defaults;
        $this->subject->response = $response;
        $this->subject->subject = 'Fotorex - válasz '
            .$this->subject->created_at_label
            .'-kor beküldött kérdésére';
    }
}