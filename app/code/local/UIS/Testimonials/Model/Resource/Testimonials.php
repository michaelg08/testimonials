<?php
/**
 * Resourse model for testimonials model
 *
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */
class UIS_Testimonials_Model_Resource_Testimonials extends  Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init("testimonials/testimonials", "id");
    }
}