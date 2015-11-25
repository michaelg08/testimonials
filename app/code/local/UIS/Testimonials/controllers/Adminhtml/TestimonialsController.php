<?php
class UIS_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
			   echo(12345);
	   die();
	
       $this->loadLayout();
	   $this->_title($this->__("Manage Testimonials"));

	   $this->renderLayout();
    }
}