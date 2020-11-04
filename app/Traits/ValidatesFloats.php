<?php


namespace App\Traits;


trait ValidatesFloats
{
    public function validationData()
    {
        $result = $this->input();
        if (method_exists($this, 'getFloatFields')) {
            foreach ($this->getFloatFields() as $field) {
                $result[$field] = str_ireplace(',', '.', $result[$field]);
            }
        }
        $this->replace($result);
        return $result;
    }
}