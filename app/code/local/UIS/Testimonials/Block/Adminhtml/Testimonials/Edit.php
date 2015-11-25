<?php
/**
 * Container class for the Testimonials edit form.
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct(){

		$this->_objectId = 'id';
 		$this->_controller = 'adminhtml_testimonials';
 		$this->_blockGroup = 'testimonials';

		parent::__construct();

 		$this->_updateButton('save', 'label', Mage::helper('testimonials')->__('Save'));
 		$this->_updateButton('save', 'id','save_post_button');
 		$this->_updateButton('delete', 'label', Mage::helper('testimonials')->__('Delete'));
	}

	/**
	 * Find matching form using layout config and return form html.
	 *
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Form_Container::getFormHtml()
	 */
	public function getFormHtml() {
		$html = $this->getLayout()->createBlock('testimonials/adminhtml_testimonials_edit_form')->toHtml();
		return $html;
	}


	/**
	 * Returns headline text
	 *
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Container::getHeaderText()
	 */
	public function getHeaderText()
	{
		if (Mage::registry('current_testimonial') && Mage::registry('current_testimonial')->getId()) {
			return Mage::helper('testimonials')->__('Edit testimonials');
		}
		else {
			return Mage::helper('testimonials')->__('New testimonial');
		}
	}
}