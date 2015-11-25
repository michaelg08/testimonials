<?php
/**
 * Entry point for editing testimonials.
 * Works as a container for the testimonials grid.
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Block_Adminhtml_Testimonials_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct(){
		$this->_controller = 'adminhtml_testimonials';
		$this->_blockGroup = 'testimonials';
		$this->_headerText  = Mage::helper('testimonials')->__('Manage testimonials');
		parent::__construct();
	}


	protected function _prepareLayout(){
		$this->_updateButton('add', 'label', Mage::helper('core')->__('Add testimonial'));
		$this->_updateButton('add', 'id','add_new_testimonial');
		return parent::_prepareLayout();
	}
}

?>