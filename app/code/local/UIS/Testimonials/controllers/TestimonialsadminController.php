<?php
/**
 * Testimonials admin controller
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_TestimonialsadminController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Manage Testimonials"));
	   $this->renderLayout();
    }
	
	/**
	 * New testimonial.
	 */ 
	public function newAction() {
	
	    $this->_forward('edit');
	}
	
	
	/**
	 * New testimonial.
	 */
	public function editAction() {
     
		$this->_initTestimonial();
		$currentTestimonial = Mage::registry('current_testimonial');	
		$this->loadLayout();
		$this->_setActiveMenu('testimonials/adminhtml_testimonials');
		if (!is_null($currentTestimonial->getData('id'))) {
			$this->_addBreadcrumb(Mage::helper('testimonials')->__('Edit'), Mage::helper('testimonials')->__('Edit'));
		} else {
			$this->_addBreadcrumb(Mage::helper('testimonials')->__('New'), Mage::helper('testimonials')->__('New'));
		}		
		$this->_title($currentTestimonial->getData('id') ? $currentTestimonial->getLabel() : $this->__('New'));	
	
		$this->renderLayout();
	
	}
	
	/**
	 * Save testimonial.
	 */
	public function saveAction() {

		if($this->getRequest()->isPost()) {
			$postData = $this->getRequest()->getPost();
			$currentTestimonial = Mage::getModel('testimonials/testimonials');
			if (isset($postData['id'])) {
				$currentTestimonial->load($postData['id']);
				if (!$currentTestimonial) {
					$currentTestimonial->setId($postData['id']);
				}
			}
			if (isset($postData['testimonial_label'])) {
				$currentTestimonial->setTestimonialLabel($postData['testimonial_label']);
			}
			if (isset($postData['customer_name'])) {
				$currentTestimonial->setCustomerName($postData['customer_name']);
			}
			if (isset($postData['customer_email'])) {
				$currentTestimonial->setCustomerEmail($postData['customer_email']);
			}
			if (isset($postData['testimonial_text'])) {
				$currentTestimonial->setTestimonialText($postData['testimonial_text']);
			}
			
			if (isset($postData['enabled'])) {
				$currentTestimonial->setEnabled((int)$postData['enabled']);
			}
			try {
					$currentTestimonial->save();
					Mage::getSingleton('adminhtml/session')->addSuccess( Mage::helper('testimonials')->__('Successfully saved'));
				} catch (Exception $e) { 
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				}
		}
		
		$this->_redirect('*/*/');
	}
	
	
	
	/**
	 * This function is used for mass delete action
	 *
	 **/
		public function massDeleteAction()
	{
		$ids = $this->getRequest()->getParam('id');      
		if(!is_array($ids)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tax')->__('Please select testimonial(s).'));
		} else {
			try {
				$testimonialModel = Mage::getModel('testimonials/testimonials');
				foreach ($ids as $id) {
					$testimonialModel->load($id)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess( Mage::helper('testimonials')->__( 'Total of %d record(s) were deleted.', count($ids)) );
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/');
	}
	

	
	
	/**
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Controller_Action::_isAllowed()
	 */
	protected function _isAllowed(){
		return Mage::getSingleton('admin/session')->isAllowed('testimonials/testimonials_admin');
	}

	/**
	 * Load and register current news
	 */
	protected function _initTestimonial(){
		$currentId= $this->getRequest()->getParam('testimonial_id');
		var_dump($currentId);
		$sizechartModel = Mage::getModel('testimonials/testimonials');
		if (!(Mage::registry('current_testimonial') && Mage::registry('current_testimonial')->getId() == $currentId)) {
			Mage::register('current_testimonial', $sizechartModel);
			Mage::registry('current_testimonial')->load($currentId);
		}
	}
		

	/**
	 * Used for AJAX loading
	 */
	public function gridAction()
	{
		$this->loadLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('testimonials/adminhtml_testimonials_grid')->toHtml()
		);
}
}