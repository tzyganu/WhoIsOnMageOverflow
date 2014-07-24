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
 * MageOverflow User admin controller
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Adminhtml_Mageoverflow_OverflowuserController
    extends Mage_Adminhtml_Controller_Action {
    /**
     * init the overflowuser
     * @access protected
     * @return Easylife_MageOverflow_Model_Overflowuser
     */
    protected function _initOverflowuser(){
        $overflowuserId  = (int) $this->getRequest()->getParam('id');
        $overflowuser    = Mage::getModel('easylife_mageoverflow/overflowuser');
        if ($overflowuserId) {
            $overflowuser->load($overflowuserId);
        }
        Mage::register('current_overflowuser', $overflowuser);
        return $overflowuser;
    }
     /**
     * default action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function indexAction() {
        $this->loadLayout();
        $this->_title(Mage::helper('easylife_mageoverflow')->__('Who is on MageOverflow?'))
             ->_title(Mage::helper('easylife_mageoverflow')->__('MageOverflow Users'));
        $this->renderLayout();
    }
    /**
     * grid action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function gridAction() {
        $this->loadLayout()->renderLayout();
    }
    /**
     * edit mageoverflow user - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function editAction() {
        $overflowuserId    = $this->getRequest()->getParam('id');
        $overflowuser      = $this->_initOverflowuser();
        if ($overflowuserId && !$overflowuser->getId()) {
            $this->_getSession()->addError(Mage::helper('easylife_mageoverflow')->__('This mageoverflow user no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getOverflowuserData(true);
        if (!empty($data)) {
            $overflowuser->setData($data);
        }
        Mage::register('overflowuser_data', $overflowuser);
        $this->loadLayout();
        $this->_title(Mage::helper('easylife_mageoverflow')->__('Who is on MageOverflow?'))
             ->_title(Mage::helper('easylife_mageoverflow')->__('MageOverflow Users'));
        if ($overflowuser->getId()){
            $this->_title($overflowuser->getUserid());
        }
        else{
            $this->_title(Mage::helper('easylife_mageoverflow')->__('Add mageoverflow user'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }
    /**
     * new mageoverflow user action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function newAction() {
        $this->_forward('edit');
    }
    /**
     * save mageoverflow user - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost('overflowuser')) {
            try {
                $overflowuser = $this->_initOverflowuser();
                $overflowuser->addData($data);
                $overflowuser->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('easylife_mageoverflow')->__('MageOverflow User was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $overflowuser->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setOverflowuserData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('There was a problem saving the mageoverflow user.'));
                Mage::getSingleton('adminhtml/session')->setOverflowuserData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('Unable to find mageoverflow user to save.'));
        $this->_redirect('*/*/');
    }
    /**
     * delete mageoverflow user - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0) {
            try {
                $overflowuser = Mage::getModel('easylife_mageoverflow/overflowuser');
                $overflowuser->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('easylife_mageoverflow')->__('MageOverflow User was successfully deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('There was an error deleting mageoverflow user.'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('Could not find mageoverflow user to delete.'));
        $this->_redirect('*/*/');
    }
    /**
     * mass delete mageoverflow user - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function massDeleteAction() {
        $overflowuserIds = $this->getRequest()->getParam('overflowuser');
        if(!is_array($overflowuserIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('Please select mageoverflow users to delete.'));
        }
        else {
            try {
                foreach ($overflowuserIds as $overflowuserId) {
                    $overflowuser = Mage::getModel('easylife_mageoverflow/overflowuser');
                    $overflowuser->setId($overflowuserId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('easylife_mageoverflow')->__('Total of %d mageoverflow users were successfully deleted.', count($overflowuserIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('easylife_mageoverflow')->__('There was an error deleting mageoverflow users.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * export as csv - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function exportCsvAction(){
        $fileName   = 'overflowuser.csv';
        $content    = $this->getLayout()->createBlock('easylife_mageoverflow/adminhtml_overflowuser_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as MsExcel - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function exportExcelAction(){
        $fileName   = 'overflowuser.xls';
        $content    = $this->getLayout()->createBlock('easylife_mageoverflow/adminhtml_overflowuser_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as xml - action
     * @access public
     * @return void
     * @author Marius Strajeru
     */
    public function exportXmlAction(){
        $fileName   = 'overflowuser.xml';
        $content    = $this->getLayout()->createBlock('easylife_mageoverflow/adminhtml_overflowuser_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * Check if admin has permissions to visit related pages
     * @access protected
     * @return boolean
     * @author Marius Strajeru
     */
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('easylife_mageoverflow');
    }
}
