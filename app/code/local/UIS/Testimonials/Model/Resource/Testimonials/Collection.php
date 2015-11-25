<?php
/**
 * Testimonials collection
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
    class UIS_Testimonials_Model_Resource_Testimonials_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
    {

		public function _construct(){
			$this->_init("testimonials/testimonials");
		}

		

    }
	 