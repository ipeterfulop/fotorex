<?php


namespace App\Helpers;


class ProductcategoryConfiguration
{
    public $id;
    public $label;
    public $dataproviderClass;
    public $filterbuilderClass;
    public $filterbuilderParameters;

    public function __construct($id, $dataproviderClass, $filterbuilderClass, $filterbuilderParameters, $label)
    {
        $this->id = $id;
        $this->dataproviderClass = $dataproviderClass;
        $this->filterbuilderClass = $filterbuilderClass;
        $this->filterbuilderParameters = $filterbuilderParameters;
        $this->label = $label;
    }


}