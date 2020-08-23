<?php

namespace EQ;

class Model extends \LT\Model {

    protected function _beforeCreate() {
        parent::_beforeCreate();
        $t					 = time();
        $this->created_time	 = $t;
        $this->updated_time	 = $t;
    }

    protected function _beforeUpdate() {
        parent::_beforeUpdate();
        $this->updated_time = time();
    }

}