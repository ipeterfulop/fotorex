<?php


namespace App\Searching;


abstract class SearchField
{
    protected $value;
    protected $label;
    protected $type;
    protected $field;
    protected $valueset;

    /**
     * @param mixed $type
     * @return SearchField
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    abstract public function view();

    /**
     * @param mixed $value
     * @return SearchField
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $label
     * @return SearchField
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $field
     * @return SearchField
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $valueset
     * @return SearchField
     */
    public function setValueset($valueset)
    {
        $this->valueset = $valueset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValueset()
    {
        return $this->valueset;
    }

    public function getDefaultValue()
    {
        if ($this->type == 'radiogroup') {
            return -1;
        }

        return '';
    }
}
