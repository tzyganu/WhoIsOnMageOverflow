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
 * MageOverflow User admin edit tabs
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs {
    /**
     * Initialize Tabs
     * @access public
     * @author Marius Strajeru
     */
    public function __construct() {
        parent::__construct();
        $this->setId('overflowuser_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('easylife_mageoverflow')->__('MageOverflow User'));
    }
    /**
     * before render html
     * @access protected
     * @return Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Edit_Tabs
     * @author Marius Strajeru
     */
    protected function _beforeToHtml(){
        $this->addTab('form_overflowuser', array(
            'label'        => Mage::helper('easylife_mageoverflow')->__('MageOverflow User'),
            'title'        => Mage::helper('easylife_mageoverflow')->__('MageOverflow User'),
            'content'     => $this->getLayout()->createBlock('easylife_mageoverflow/adminhtml_overflowuser_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
    /**
     * Retrieve mageoverflow user entity
     * @access public
     * @return Easylife_MageOverflow_Model_Overflowuser
     * @author Marius Strajeru
     */
    public function getOverflowuser(){
        return Mage::registry('current_overflowuser');
    }
}
