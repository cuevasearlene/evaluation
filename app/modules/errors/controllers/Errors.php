<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MX_Controller
{

	function e_404()
	{
		$this->viewdata['title'] = 'Eror 404';
		$this->viewdata['content'] = 'errors/404';
		$this->load->view('errors/404', $this->viewdata);
	}
	function e_403()
	{
		$this->viewdata['title'] = 'Eror 403';
		$this->viewdata['content'] = 'errors/403';
		$this->load->view('errors/403', $this->viewdata);
	}


	
	
}