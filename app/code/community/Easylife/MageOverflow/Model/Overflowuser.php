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
 * MageOverflow User model
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Model_Overflowuser
    extends Mage_Core_Model_Abstract {
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'easylife_mageoverflow_overflowuser';
    const CACHE_TAG = 'easylife_mageoverflow_overflowuser';
    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'easylife_mageoverflow_overflowuser';

    /**
     * Parameter name in event
     * @var string
     */
    protected $_eventObject = 'overflowuser';
    /**
     * constructor
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function _construct(){
        parent::_construct();
        $this->_init('easylife_mageoverflow/overflowuser');
    }
    /**
     * before save mageoverflow user
     * @access protected
     * @return Easylife_MageOverflow_Model_Overflowuser
     * @author Marius Strajeru
     */
    protected function _beforeSave(){
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()){
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }
    /**
     * save overflowuser relation
     * @access public
     * @return Easylife_MageOverflow_Model_Overflowuser
     * @author Marius Strajeru
     */
    protected function _afterSave() {
        return parent::_afterSave();
    }
}
