<?php

namespace EQ;

class Action extends \LT\Action {

    public function __construct() {
        parent::__construct();

        $this->view->assign('YEAR', date('Y'));
    }

}