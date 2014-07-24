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
 * MageOverflow User collection resource model
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Model_Resource_Overflowuser_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected $_joinedFields = array();
    /**
     * constructor
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    protected function _construct(){
        parent::_construct();
        $this->_init('easylife_mageoverflow/overflowuser');
    }
    /**
     * get overflowusers as array
     * @access protected
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     * @author Marius Strajeru
     */
    protected function _toOptionArray($valueField='entity_id', $labelField='userid', $additional=array()){
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
    /**
     * get options hash
     * @access protected
     * @param string $valueField
     * @param string $labelField
     * @return array
     * @author Marius Strajeru
     */
    protected function _toOptionHash($valueField='entity_id', $labelField='userid'){
        return parent::_toOptionHash($valueField, $labelField);
    }
    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     * @access public
     * @return Varien_Db_Select
     * @author Marius Strajeru
     */
    public function getSelectCountSql(){
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(Zend_Db_Select::GROUP);
        return $countSelect;
    }
}
