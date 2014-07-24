<?php
/**
 * Easylife_MageOverflow extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Easylife
 * @package        Easylife_MageOverflow
 * @copyright      Copyright (c) 2014
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * MageOverflow User admin edit form
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'easylife_mageoverflow';
        $this->_controller = 'adminhtml_overflowuser';
        $this->_updateButton('save', 'label', Mage::helper('easylife_mageoverflow')->__('Save MageOverflow User'));
        $this->_updateButton('delete', 'label', Mage::helper('easylife_mageoverflow')->__('Delete MageOverflow User'));
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('easylife_mageoverflow')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    /**
     * get the edit form header
     * @access public
     * @return string
     * @author Marius Strajeru
     */
    public function getHeaderText(){
        if( Mage::registry('current_overflowuser') && Mage::registry('current_overflowuser')->getId() ) {
            return Mage::helper('easylife_mageoverflow')->__("Edit MageOverflow User '%s'", $this->escapeHtml(Mage::registry('current_overflowuser')->getUserid()));
        }
        else {
            return Mage::helper('easylife_mageoverflow')->__('Add MageOverflow User');
        }
    }
}
