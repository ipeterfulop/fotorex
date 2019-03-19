<?php

namespace App;

use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Database\Eloquent\Model;

class Contactmessage extends Model
{
    use VueCRUDManageable;
    const SUBJECT_SLUG = 'contactmessage';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'last_action_taken'
    ];

    protected $appends = ['created_at_label', 'contact_details'];

    public function getCreatedAtLabelAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function getContactDetailsAttribute()
    {
        return $this->email.'<br>'.$this->phone;
    }

    public static function getVueCRUDIndexColumns()
    {
        return [
            'created_at_label' => 'Beküldve',
            'name' => 'Név',
            'contact_details' => 'Kapcsolat',
            'message' => 'Üzenet',
            'last_action_taken' => 'Állapot',
        ];
    }

    public static function getVueCRUDSortingIndexColumns()
    {
        return [
            'created_at_label' => 'created_at',
            'name' => 'name',
            'email' => 'email',
        ];
    }

    public function getVueCRUDDetailsFields()
    {
        return [
            'created_at_label' => 'Beküldve',
            'name' => 'Név',
            'email' => 'E-mail',
            'phone' => 'Telefon',
            'message' => 'Üzenet',
            'last_action_taken' => 'Állapot',
        ];
    }

    public static function getVueCRUDIndexFilters()
    {
        return [];
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

}
