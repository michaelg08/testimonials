<?php   
/**
 * Testimonials frontend List block
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Block_List extends Mage_Core_Block_Template{   

   
   	/**
	 * Get's testimonials collection
	 */
   public function getTestimonials() {
		return Mage::getModel('testimonials/testimonials')->getCollection();
   }

	/**
	 * Checks customer is logged in 
	 */
   public function getButtonEnabled() {
		$customer = Mage::getSingleton('customer/session'); 
		if ($customer && $customer->isLoggedIn()) {
			return true;
		}
		return false; 
   }	


}