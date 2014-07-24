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
 * MageOverflow User admin grid block
 *
 * @category    Easylife
 * @package     Easylife_MageOverflow
 * @author     Marius Strajeru
 */
class Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Grid
    extends Mage_Adminhtml_Block_Widget_Grid {
    /**
     * constructor
     * @access public
     * @author Marius Strajeru
     */
    public function __construct(){
        parent::__construct();
        $this->setId('overflowuserGrid');
        $this->setDefaultSort('userid');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * prepare collection
     * @access protected
     * @return Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Grid
     * @author Marius Strajeru
     */
    protected function _prepareCollection(){
        $collection = Mage::getModel('easylife_mageoverflow/overflowuser')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * prepare grid collection
     * @access protected
     * @return Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Grid
     * @author Marius Strajeru
     */
    protected function _prepareColumns(){
        $this->addColumn('userid', array(
            'header'    => Mage::helper('easylife_mageoverflow')->__('User Id'),
            'align'     => 'left',
            'index'     => 'userid',
            'type'      => 'number'
        ));
        $this->addColumn('avatar', array(
            'header'=> Mage::helper('easylife_mageoverflow')->__('Avatar link'),
            'index' => 'avatar',
            'type'=> 'text',
            'filter' => false,
            'sortable' => false,
            'frame_callback' => array($this, 'showAvatar'),
            'style' => 'width:128px'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('easylife_mageoverflow')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
            'filter'    => false,
            'sortable'  => false
        ));
        $this->addColumn('last_seen', array(
            'header'=> Mage::helper('easylife_mageoverflow')->__('Last seen'),
            'index' => 'last_seen',
            'type'=> 'text',
            'sortable' => false,
            'filter' => false,
        ));
        $this->addColumn('status', array(
            'header'=> Mage::helper('easylife_mageoverflow')->__('Status'),
            'index' => 'status',
            'type'=> 'text',
            'sortable' => false,
            'filter' => false,
        ));
        $this->addColumn('action',
            array(
                'header'=>  Mage::helper('easylife_mageoverflow')->__('Action'),
                'width' => '100',
                'type'  => 'action',
                'getter'=> 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('easylife_mageoverflow')->__('Edit'),
                        'url'   => array('base'=> '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter'=> false,
                'is_system'    => true,
                'sortable'  => false,
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('easylife_mageoverflow')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('easylife_mageoverflow')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('easylife_mageoverflow')->__('XML'));
        return parent::_prepareColumns();
    }
    /**
     * prepare mass action
     * @access protected
     * @return Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Grid
     * @author Marius Strajeru
     */
    protected function _prepareMassaction(){
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('overflowuser');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('easylife_mageoverflow')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('easylife_mageoverflow')->__('Are you sure?')
        ));
        return $this;
    }
    /**
     * get the row url
     * @access public
     * @param Easylife_MageOverflow_Model_Overflowuser
     * @return string
     * @author Marius Strajeru
     */
    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    /**
     * get the grid url
     * @access public
     * @return string
     * @author Marius Strajeru
     */
    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
    /**
     * after collection load
     * @access protected
     * @return Easylife_MageOverflow_Block_Adminhtml_Overflowuser_Grid
     * @author Marius Strajeru
     */
    protected function _afterLoadCollection(){
        parent::_afterLoadCollection();
        $basePath = Mage::getStoreConfig('easylife_mageoverflow/overflowuser/base_feed_link');
        $limit = Mage::getStoreConfig('easylife_mageoverflow/overflowuser/awake');
        foreach ($this->getCollection() as $item) {
            try{
                $feed = Zend_Feed_Reader::import('http://magento.stackexchange.com/feeds/user/'.$item->getUserid());

    //            echo "<pre>"; print_r($feed->entry);exit;
                $now = new DateTime();
                $lastSeen = false;
                $author = false;
                foreach($feed as $entry){
                    //echo "<pre>"; print_r($entry->getDateModified());exit;
                    $author = $entry->getAuthor();
                    $lastDate = new DateTime();
                    $lastDate->setTimestamp($entry->getDateModified()->getTimestamp());
                    $lastSeen = $now->diff($lastDate);
                    break;
                }
                if ($author && is_array($author) && isset($author['name'])) {
                    $author = $author['name'];
                }
                else {
                    $author = '--';
                }
                $item->setName($author);
                if ($lastSeen) {
                    $output = $this->__('%s days, %s hours, %s minutes and %s seconds',
                        $lastSeen->d,
                        $lastSeen->h,
                        $lastSeen->i,
                        $lastSeen->s
                    );
                    $isSleeping = $lastSeen->h >= $limit;
                    $asleep =  $isSleeping ? $this->__('Is sleeping') : $this->__('Is awake');
                    $item->setLastSeen($output);
                    $item->setStatus($asleep);

                }
                else {
                    $item->setLastSeen($this->__('Was never seen'));
                    $item->setStatus($this->__('Does not exist'));
                }
            }
            catch (Exception $e) {
                $item->setLastSeen('--');
                $item->setStatus('--');
                $item->setName('--');
            }
        }
    }

    public function showAvatar($value, $row, $column, $isExport) {
        if ($isExport) {
            return $value;
        }
        if (empty($value)) {
            return '';
        }
        return '<img src="'.$value.'" alt=""/>';
    }
}
