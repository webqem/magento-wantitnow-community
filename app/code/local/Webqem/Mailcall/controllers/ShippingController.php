<?php
class Webqem_Mailcall_ShippingController extends Mage_Core_Controller_Front_Action
{
	public function getTimeslotAction()
	{
		if ($data = $this->getRequest()->getPost()) {
			
			$inputDate = str_replace('/', '-', $data['day']);
			$day = date('N', strtotime($inputDate));
			$count = 0;
			$timeslots = Mage::getModel('webqemmailcall/timeslot')->getAllTimeslotByDay($day);
			
			$html = "<select name='shipping_pickup[timeslot]' style='width:170px' class='required-entry'>";
			foreach ($timeslots as $timeslot) {
				if (date("d/m/Y") == $data['day']) {
					$nowTime = Mage::getSingleton('core/date')->timestamp();
					
					$currentTime = floatval(date("H.i", $nowTime))+1;
					$timestart = floatval(str_replace(':', '.', $timeslot->getTimeStart()));
					
					if ($timestart>$currentTime) {
						
						$html .="<option value='".$timeslot->getId()."'>".$timeslot->getDescription()." " . $timeslot->getTimeStart() ." to " . $timeslot->getTimeEnd(). "</option>";
						$count++;
					}
					
				} else {
					$html .="<option value='".$timeslot->getId()."'>".$timeslot->getDescription()." " . $timeslot->getTimeStart() ." to " . $timeslot->getTimeEnd(). "</option>";
					$count++;
				}
				
			}
			if ($count==0) {
				$html .= '<option value="">-- Please select date --</option>';
			}
			echo $html."</select>";
			die;
		}
	}
}