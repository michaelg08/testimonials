<?php
/**
 * Displays testimonials grid   
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright  Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid{

	/**
	* Create a Grid
	*/
    public function __construct(){
        parent::__construct();
        $this->setId('testimonials_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
		if (Mage::registry('preparedFilter')) {
        	$this->setDefaultFilter( Mage::registry('preparedFilter') );
        }
    }

    /**
     * Creating collection
     * 
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_Widget_Grid::_prepareCollection()
     */ 
	protected function _prepareCollection(){
	    $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
	}
	
	/**
     * Modify column filter if needed by custom implementation of IN() and NOT IN() MySQL statement + prepared filter functionality
     *
     */
    protected function _addColumnFilterToCollection($column)
    {
        $filterArr = Mage::registry('preparedFilter');
 
    	if ( $column->getFilter()->getValue() && strpos($column->getFilter()->getValue(), ',')) {
 
    		$_inNin = explode(',', $column->getFilter()->getValue());
    		$inNin = array();
 
    		foreach ($_inNin as $k => $v) {
    			if (is_string($v) && strlen(trim($v))) {
    				$inNin[] = trim($v);
    			}
    		}
 
    		if (count($inNin)>1 && in_array($inNin[0], array('in', 'nin'))) {
    			$in = $inNin[0];
    			$values = array_slice($inNin, 1);
    			$this->getCollection()->addFieldToFilter($column->getId(), array($in => $values));
    		} else {
    			parent::_addColumnFilterToCollection($column);
 
    		}
    	} elseif (is_array($filterArr) && array_key_exists($column->getId(), $filterArr) && isset($filterArr[$column->getId()])) {
    		$this->getCollection()->addFieldToFilter($column->getId(), $filterArr[$column->getId()]);
 
    	} else {
    		parent::_addColumnFilterToCollection($column);
 
    	}
    	return $this;
    }
	/**
     * Retrieve collection class
     *
     * @return string
     */
    protected function _getCollectionClass()
    {
        return 'testimonials/testimonials_collection';
    }
	
	/**
	 * Define columns to be displayed
	 * 
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Grid::_prepareColumns()
	 */	
	protected function _prepareColumns(){
		
		$this->addColumn('id',
				array(
						'header'=> Mage::helper('testimonials')->__('Id'),
						'width' => '10px',
						'type'  => 'number',
						'index' => 'id',
				));
		$this->addColumn('testimonial_label',
				array(
						'header'=> Mage::helper('testimonials')->__('Label'),
						'width' => '50%',
						'index' => 'testimonial_label',
				));
				
		$this->addColumn('customer_name',
				array(
						'header'=> Mage::helper('testimonials')->__('Customer name'),
						'width' => '20%',
						'index' => 'customer_name',
				));

		$this->addColumn('customer_email',
				array(
						'header'=> Mage::helper('testimonials')->__('Customer email'),
						'width' => '20%',
						'index' => 'customer_email',
				));
		$this->addColumn('enabled',
				array(
						'header'=> Mage::helper('testimonials')->__('Enabled'),
						'width' => '100px',
						'type'      => 'options',
						'options' => array ( '-1' => 'Please select option', '0' => 'No', '1' => 'Yes'),   
						'index' => 'enabled',
				));

				
		return parent::_prepareColumns();
	}
	

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('id');
 
		$this->getMassactionBlock()->addItem('delete', array(
			'label'=> Mage::helper('testimonials')->__('Delete'),
			'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
			'confirm' => Mage::helper('testimonials')->__('Are you sure?')
		));
 
		return $this;
	}
	
	/**
	 * Url is displayed for applying actions on a row.
	 * 
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Grid::getRowUrl()
	 */ 
	public function getRowUrl($row){
		return $this->getUrl('*/*/edit', array(
				'testimonial_id'=>$row->getData('id'))
		);
	}
	
	/**
	 * Url for the whole grid.
	 * 
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Grid::getGridUrl()
	 */	
	public function getGridUrl(){
		return $this->getUrl('*/*/grid', array('_current'=> true));
	}
}
