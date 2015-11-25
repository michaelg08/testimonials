<?php
class UIS_Testimonials_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Testimonials"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("testimonials", array(
                "label" => $this->__("Testimonials"),
                "title" => $this->__("Testimonials")
		   ));

      $this->renderLayout(); 
	  
    }
	
	/**
	 * Opens Add form
	 */
	public function addAction() {

      if (!$this->isCustomerLoggedIn()) {
		Mage::getSingleton('core/session')->addError( Mage::helper('testimonials')->__('You are not logged in! Please log in to proceed.'));
		$this->_redirect('customer/account/login');
		return ;
	  }	  

	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Add new testimonial"));
	  $this->renderLayout(); 
	}
	 
	 /**
	 * Checks customer is logged in 
	 */
	public function isCustomerLoggedIn() {
		$customer = Mage::getSingleton('customer/session'); 
		if ($customer && $customer->isLoggedIn()) {
			return true;
		}
		return false; 
	}
	
	/**
	 * Saves new feedback
	 */
	public function saveAction() {
	  if (!$this->isCustomerLoggedIn()) {
		Mage::getSingleton('core/session')->addError( Mage::helper('testimonials')->__('You are not logged in! Please log in to proceed.'));
		$this->_redirect('customer/account/login');
		return ;
	  }	
	  
	  if ($this->getRequest()->isPost()) {
		$newTestimonial = Mage::getModel('testimonials/testimonials');
        $postData = $this->getRequest()->getPost();
		
			if (isset($postData['testimonial-lable'])) {
				$newTestimonial->setTestimonialLabel($postData['testimonial-lable']);
			}
			if (isset($postData['customer-name'])) {
				$newTestimonial->setCustomerName($postData['customer-name']);
			}
			if (isset($postData['customer_email'])) {
				$newTestimonial->setEmail($postData['customer_email']);
			}
			if (isset($postData['testimonial-feedback-text'])) {
				$newTestimonial->setTestimonialText($postData['testimonial-feedback-text']);
			}
			if (isset($postData['customer_id'])) {
				$newTestimonial->setCustomerId($postData['customer_id']);
			}
			if (isset($postData['enabled'])) {
				$newTestimonial->setEnabled(0);
			}
			try {
					$newTestimonial->save();
					Var_dump($newTestimonial->getData());
					Mage::getSingleton('customer/session')->addSuccess( Mage::helper('testimonials')->__('Successfully saved. Please wait while it\'s checked by moderator.'));
				} catch (Exception $e) { 
					Mage::logError($e->getMessage());
					Mage::getSingleton('customer/session')->addError('There was an error while saving Your feedback.');
				}			
	  }
		//$this->_redirect('testimonials/index');	  
	}
	
	
	
}