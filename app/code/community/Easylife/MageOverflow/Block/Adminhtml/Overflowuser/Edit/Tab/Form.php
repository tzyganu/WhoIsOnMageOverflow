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
 * MageOverflow User edit form tab
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form {
    /**
     * prepare the form
     * @access protected
     * @return MageOverflow_Overflowuser_Block_Adminhtml_Overflowuser_Edit_Tab_Form
     * @author Marius Strajeru
     */
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('overflowuser_');
        $form->setFieldNameSuffix('overflowuser');
        $this->setForm($form);
        $fieldset = $form->addFieldset('overflowuser_form', array('legend'=>Mage::helper('easylife_mageoverflow')->__('MageOverflow User')));

        $fieldset->addField('userid', 'text', array(
            'label' => Mage::helper('easylife_mageoverflow')->__('User Id'),
            'name'  => 'userid',
            'note'	=> $this->__('The ID of the MageOverflow user'),
            'required'  => true,
            'class' => 'required-entry',

        ));

        $fieldset->addField('avatar', 'text', array(
            'label' => Mage::helper('easylife_mageoverflow')->__('Avatar link'),
            'name'  => 'avatar',

        ));
        $formValues = array();
        if (Mage::getSingleton('adminhtml/session')->getOverflowuserData()){
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getOverflowuserData());
            Mage::getSingleton('adminhtml/session')->setOverflowuserData(null);
        }
        elseif (Mage::registry('current_overflowuser')){
            $formValues = array_merge($formValues, Mage::registry('current_overflowuser')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
