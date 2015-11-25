<?php
/**
 * Mysql installer 
 * 
 * @category    UIS
 * @package     UIS_Testimonials
 * @copyright   Copyright (c) 2015 Husak Mykhailo
 * @license     All Rights Reserved
 *
 */

$installer = $this;
$installer->startSetup();

$installer->run('

/* Table structure for table `test`*/		
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_label` varchar(100), 
  `customer_name` varchar(100),
  `customer_email` varchar(100),
  `testimonial_text` TEXT,
  `customer_id` int(11),
  `enabled` tinyint, 
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


');

$installer->endSetup();
	 