<?php

namespace EQ;

class EarthQuart extends \EQ\Model {
    public $id;
    public $event_id;
    public $event_type;
    public $magnitude;
    public $event_detail;
    public $event_title;
    public $event_place;
    public $event_time;
    public $properties_type;
    private $_attributes = [];


    public function __get($name)
    {
        if (!strlen($name)) {
            return false;
        }
        if (!isset($this->_attributes[$name])) {
            $_attribute = EarthQuartAttribute::findOne([
                'earthquart_id' =>  $this->id,
                'name'          =>  $name
            ]);

            if (!$_attribute) {
                return false;
            }
            $this->_attributes[$_attribute->name] = $_attribute->value;
        }

        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : NULL;

    }
    public function __set($name, $value) {
        if (strlen($name)) {
            $this->_attributes[$name] = is_array($value) ? json_encode($value) : $value;
        }
    }
    protected function _afterSave() {
        parent::_afterSave();

        foreach ($this->_attributes as $_name => $_value) {
            $attribute = EarthQuartAttribute::findOne([
                'payout_transaction_id' => $this->id,
                'name'                  => $_name
            ]);
            if (!$attribute) {
                $attribute                       = new EarthQuartAttribute();
                $attribute->earthquart_id        = $this->id;
                $attribute->name                 = $_name;
            }
            $attribute->value = $_value;
            $attribute->save();
        }
    }
}