<?php


namespace App\Dataproviders\Filters;


use App\Dataproviders\MFPDataprovider;
use App\Dataproviders\PrinterDataprovider;
use App\Helpers\Productcategory;
use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;
use Illuminate\Database\Eloquent\Builder;

class ProductcategoryVueCRUDIndexFilter extends SelectVueCRUDIndexfilter
{

    public function __construct($property, $label, $default, $value = null)
    {
        parent::__construct($property, $label, $default, $value);
        $this->valueset = [
            ['value' => -1, 'label' => 'Nem adott'],
            ['value' => Productcategory::PRINTERS_ID, 'label' => Productcategory::PRINTERS_LABEL],
            ['value' => Productcategory::MFP_ID, 'label' => Productcategory::MFP_LABEL],
        ];
    }

    public function addFilterToQuery(Builder $query, $requestField = null)
    {
        if ($requestField != null) {
            $this->value = request()->get($requestField);
        }
        return $query->when((string) $this->value != '' && (string) $this->value != '-1', function($query) {
            if ($this->value == Productcategory::PRINTERS_ID) {
                return PrinterDataprovider::addBaseScopesToQuery($query);
            }
            if ($this->value == Productcategory::MFP_ID) {
                return MFPDataprovider::addBaseScopesToQuery($query);
            }
            return $query;
        });
    }

}