<?php
class Webqem_Mailcall_Block_Timeslots_Pickup extends Mage_Checkout_Block_Onepage_Shipping_Method_Available
{
	public function __construct()
	{
		$this->setTemplate('webqem/mailcall/timeslots/pickup.phtml');
	}
	public function getConfigData($field)
	{
		$path = 'carriers/webqemmailcall_timeslot/'.$field;
		return Mage::getStoreConfig($path, $this->getStore());
	}
}