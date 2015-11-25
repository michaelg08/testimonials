<?php
/**
 * Simple edit form.
 * The form is a placeholder for other widgets.
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
	
	
	/**
	 * Constructs the form.
	 */
	public function __construct(){
		parent::__construct();
		$this->setTitle(Mage::helper('testimonials')->__('testimonials'));
	}
	
	/**
	 * Creates a new Form and use it for working form.
	 */
	protected function _prepareForm(){
	    
		$testimonialsModel = Mage::registry('current_testimonial');

		$form = new Varien_Data_Form(array(
				'id'        => 'edit_form',
				'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
				'method'    => 'post'
			 ));
     
		$fieldset = $form->addFieldset('testimonials_info', array(
						'legend'    => Mage::helper('testimonials')->__('Testimonials'),
						'class'     => 'fieldset-wide',
		    ));
     
		if ($testimonialsModel->getId()) {
			$fieldset->addField('id', 'hidden', array(
								'name' => 'id',
					    ));
		}  
	 
		$fieldset->addField('testimonial_label', 'text', array(
				    'name'      => 'testimonial_label',
				    'label'     => Mage::helper('testimonials')->__('Label'),
				    'value'     => $testimonialsModel->getData('testimonial_label'),
				    'required'  => true,
		));
		
		$fieldset->addField('customer_name', 'text', array(
				    'name'      => 'customer_name',
				    'label'     => Mage::helper('testimonials')->__('Name'),
				    'value'     => $testimonialsModel->getCustomerName(),
				    'required'  => true,
		));
		
		$fieldset->addField('customer_email', 'text', array(
				    'name'      => 'customer_email',
				    'label'     => Mage::helper('testimonials')->__('Email'),
				    'value'     => $testimonialsModel->getCustomerEmail(),
				    'required'  => true,
		));			
		
		$fieldset->addField('testimonial_text', 'textarea', array(
				    'name'      => 'testimonial_text',
				    'label'     => Mage::helper('testimonials')->__('Feedback'),
				    'value'     => $testimonialsModel->getTestimonialText(),
				    'required'  => true,
		));			
		
		$fieldset->addField('enabled', 'select', array(
				    'name'      => 'enabled',
				    'label'     => Mage::helper('testimonials')->__('Is Enabled'),
					'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
				    'value'     => (int)$testimonialsModel->getEnabled(),
				    'required'  => true,
		));										

		
		$form->setValues($testimonialsModel->getData());
		$form->setUseContainer(true);
		$this->setForm($form);
     
		
	 
		return parent::_prepareForm();
		
	}
}
?>  