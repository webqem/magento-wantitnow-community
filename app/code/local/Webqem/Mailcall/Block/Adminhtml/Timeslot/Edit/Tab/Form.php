<?php

class Webqem_Mailcall_Block_Adminhtml_Timeslot_Edit_Tab_Form extends Mage_Core_Block_Template 
	implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	
	public function __construct(){
	  	$this->setTemplate('webqem/timeslot.phtml');
	  	parent::__construct();
	 }
	 //Label to be shown in the tab
	 public function getTabLabel(){
	 	return Mage::helper('core')->__('Timeslot day');
	 }
	 
	 public function getTabTitle(){
	 	return Mage::helper('core')->__('Timeslot');
	 }
	 
	 public function canShowTab(){
	 	return true;
	 }
	 
	 public function isHidden(){
	 	return false;
	 }
	 protected function getHours(){
	 	$_hours=array();
	 	$_minute=array('00','30');
	 	for($i=6;$i<24;$i++){
	 		for($j=0;$j<=1;$j++){
	 			$hh=str_pad($i,2,"0",STR_PAD_LEFT);
	 			$mm=$_minute[$j];
	 			$_hours[$hh.':'.$mm]=$hh.':'.$mm;
	 		}
	 	}
	 	return $_hours;
	 }
	 public function getOptionHour()
	 {
	 	$html = '';
	 	foreach ($this->getHours() as $key=>$value) {
	 		$html .= '<option value="'.$key.'">'.$value.'</option>';
	 	}
	 	 
	 	
	 	return $html;
	 }
	 public function getOptionday()
	 {
	 	$arrData = Mage::getModel('webqemmailcall/timeslot_listdate')->getOptionArray();
	 	$html = "<select name='timeslot_day' class='timeslot_day'>";
	 	foreach ($arrData as $k=>$v) {
	 		$html .= "<option value='$k'>$v</option>";
	 	}
	 	
	 	$html .= "</select>";
	 	return $html;
	 }
}