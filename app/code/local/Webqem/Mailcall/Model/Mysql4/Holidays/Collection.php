<?php

class Webqem_Mailcall_Model_Mysql4_Holidays_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('webqemmailcall/holidays');
    }
    
}