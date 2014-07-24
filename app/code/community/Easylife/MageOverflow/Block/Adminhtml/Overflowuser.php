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
 * MageOverflow User admin block
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Block_Adminhtml_Overflowuser
    extends Mage_Adminhtml_Block_Widget_Grid_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function __construct(){
        $this->_controller         = 'adminhtml_overflowuser';
        $this->_blockGroup         = 'easylife_mageoverflow';
        parent::__construct();
        $this->_headerText         = Mage::helper('easylife_mageoverflow')->__('MageOverflow User');
        $this->_updateButton('add', 'label', Mage::helper('easylife_mageoverflow')->__('Add MageOverflow User'));

    }
}
