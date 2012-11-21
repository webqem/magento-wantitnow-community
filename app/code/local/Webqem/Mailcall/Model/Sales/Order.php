<?php
class Webqem_Mailcall_Model_Sales_Order extends Mage_Sales_Model_Order{
	public function getShippingDescription(){
		$desc = parent::getShippingDescription();
		$pickupObject = $this->getPickupObject();
		if($pickupObject){
			$timeslotId = $pickupObject->getTimeslot();
			
			$desc .= ' - '.$pickupObject->getTimeslot();
			$desc .= ' - Name: '.$pickupObject->getOrderId();
			
		}
		return $desc;
	}
}