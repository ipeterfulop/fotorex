<?php

namespace App;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;
use Datalytix\VueCRUD\Traits\VueCRUDManageable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, canBeTurnedIntoKeyValueCollection, VueCRUDManageable;
    const SUBJECT_SLUG = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getVueCRUDIndexColumns()
    {
        // TODO: Implement getVueCRUDIndexColumns() method.
        return [
            'name' => 'Név',
            'email' => 'E-mail'
        ];
    }

    public function getVueCRUDDetailsFields()
    {
        return [
            'name' => 'Név',
            'email' => 'E-mail'
        ];
    }

    public static function getVueCRUDIndexFilters()
    {
        // TODO: Implement getVueCRUDIndexFilters() method.
        return [];
    }
}
