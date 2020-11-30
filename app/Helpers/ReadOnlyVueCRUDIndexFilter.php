<?php


namespace App\Helpers;


use Datalytix\VueCRUD\Indexfilters\IVueCRUDIndexfilter;
use Datalytix\VueCRUD\Indexfilters\VueCRUDIndexfilterBase;
use Illuminate\Database\Eloquent\Builder;

class ReadOnlyVueCRUDIndexFilter extends VueCRUDIndexfilterBase implements IVueCRUDIndexfilter
{
    public $customLabel = '';

    public function addFilterToQuery(Builder $query, $requestField = null)
    {
        if ($requestField != null) {
            $this->value = request()->get($requestField);
        }
        return $query->when((string) $this->value != '' && (string) $this->value != '-1', function($query) {
            return $query->where(
                $this->property,
                '=',
                $this->value
            );
        });
    }

    /**
     * @param mixed $customLabel
     * @return ReadOnlyVueCRUDIndexFilter
     */
    public function setCustomLabel($customLabel)
    {
        $this->customLabel = $customLabel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomLabel()
    {
        return $this->customLabel;
    }
}