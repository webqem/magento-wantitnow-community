<?php

class Webqem_Mailcall_Block_Adminhtml_Timeslot_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'webqemmailcall';
        $this->_controller = 'adminhtml_timeslot';
        
        $this->_updateButton('save', 'label', Mage::helper('webqemmailcall')->__('Save Timeslot'));
        $this->_updateButton('delete', 'label', Mage::helper('webqemmailcall')->__('Delete Timeslot'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('fbcp_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'fbcp_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'fbcp_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('timeslot_data') && Mage::registry('timeslot_data')->getId() ) {
            return Mage::helper('webqemmailcall')->__("Edit Timeslot");
        } else {
            return Mage::helper('webqemmailcall')->__('Add Timeslot');
        }
    }
}