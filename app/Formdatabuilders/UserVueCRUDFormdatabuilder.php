<?php


namespace App\Formdatabuilders;


use App\User;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class UserVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Név')
            ->setProperty('name')
            ->setContainerClass('col-6');
        $result['email'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('E-mail')
            ->setProperty('email')
            ->setContainerClass('col-6');

        return collect($result);
    }

    public function __construct(User $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}