<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->viewdata['modid'] = $this->general->get_modid('logs');
		$this->viewdata['controller'] = 'logs';
		
	}

	function index()
	{
		$this->general->blocked_page('logs');
		$this->viewdata['title'] = 'Logs';
		$this->viewdata['content'] = 'logs/table';
		$this->load->view($this->template, $this->viewdata);
	}

	
	
}