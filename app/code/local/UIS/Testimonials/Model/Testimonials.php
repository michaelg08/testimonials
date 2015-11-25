<?php
/**
 * Testimonials model
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Model_Testimonials extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("testimonials/testimonials");

    }
	
	/**
	 * Checks testimonial availability for frontend
	 * @return boolean
	 */
	public function canShow() {
		$canShow = false;
		if ($this->getEnabled() && $this->getCustomerName() && $this->getTestimonialText()) {
			$canShow = true; 
		} 
	
		return $canShow;
	}
	
}
	 