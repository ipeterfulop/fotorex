<?php

namespace App;

use Datalytix\VueCRUD\Indexfilters\TextVueCRUDIndexfilter;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Contactmessage extends Model
{
    use VueCRUDManageable;
    const SUBJECT_SLUG = 'contactmessage';
    const SUBJECT_NAME = 'Üzenet';
    const SUBJECT_NAME_PLURAL = 'Üzenetek';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'subject',
        'last_action_taken',
        'printername',
        'printerdata',
    ];

    protected $appends = ['created_at_label', 'contact_details', 'printerdata_label'];

    public function getCreatedAtLabelAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function getContactDetailsAttribute()
    {
        return $this->name.'<br>'.$this->email.'<br>'.$this->phone;
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'created_at_label' => 'Beküldve',
            'contact_details' => 'Kapcsolat',
            'subject' => 'Tárgy',
            'message' => 'Üzenet',
            'printername' => 'Érintett termék (ha van)',
            'last_action_taken' => 'Állapot',
        ];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'created_at_label' => 'created_at',
        ];
    }

    public function getVueCRUDDetailsFields()
    {
        return [
            'created_at_label' => 'Beküldve',
            'name' => 'Név',
            'email' => 'E-mail',
            'phone' => 'Telefon',
            'subject' => 'Tárgy',
            'message' => 'Üzenet',
            'last_action_taken' => 'Állapot',
            'printerdata_label' => 'Érintett termék (ha van)'
        ];
    }

    public static function getVueCRUDIndexFilters()
    {
        $result = [];
        $searchableFields = ['name', 'email', 'message', 'printername', 'subject'];
        $result[TextVueCRUDIndexfilter::buildPropertyName($searchableFields)] = new TextVueCRUDIndexfilter($searchableFields, 'Keresés (név, e-mail, érintett termék, üzenet)', '');

        return $result;
    }

    public static function shouldVueCRUDAddButtonBeDisplayed()
    {
        return false;
    }

    public static function shouldVueCRUDOperationsBeDisplayed()
    {
        // authorization logic can be implemented here
        return true;
    }

    public static function getVueCRUDModellistButtons()
    {
        return [
            'details' => [
                'class'       => 'btn btn-outline-primary',
                'html'        => __('Details'),
            ],
            'edit'   => [
                'class'       => 'btn btn-outline-secondary',
                'html'        => 'Válasz',
            ],

        ];
    }

    public function logLastActionTaken($action)
    {
        return $this->update([
            'last_action_taken' => now()->format('Y-m-d H:i:s').': '.$action
        ]);
    }

    public function getPrinterdataLabelAttribute()
    {
        if ($this->printerdata == null) {
            return '';
        }
        return view('admin.contactmessage-printerdata', [
            'printer' => json_decode($this->printerdata),
            'date' => $this->created_at
        ])->render();
    }
}
