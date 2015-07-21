<?php

class IndexController extends Yaf_Controller_Abstract
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        echo Yaf_Registry::get('I18n')->get('payment', 'I have %num% cat and the value is %value%.', array('%num%' => '19', '%value%' => '15'));
        $this->_view->word = "hello world";
    }
}
