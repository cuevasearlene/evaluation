<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activate extends MX_Controller
{

	function index()
	{
		
		$this->viewdata['title'] = 'Admin Activate | Evaluation';
		$this->load->view('activate/activate', $this->viewdata);

	}
	//this function will do activation process
	function verify(){

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		$url = site_url('activate');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('code', 'code', 'required');
		$fv->set_rules('number', 'number', 'required');



		if($fv->run() == TRUE){
			$number = $this->general->get_table('users', array('phone' => $all_post->number), 'id');
			if($number->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Phone Number');
				redirect($url);
			}
			$code = $this->general->get_table('users', array('verification_code' => $all_post->code), 'id');

			if($code->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Verfication Code');
				redirect($url);
			}
			$this->general->update_table('users', array('phone' => $all_post->number), array('verification_code' => ''));
			$this->session->set_flashdata('msg_success', 'Succesfully Verified');
			redirect('login');

		}
		else{
			$this->session->set_flashdata('msg_error', 'Please Fill up the blank Fields');
			redirect($url);
		}

	}
	
	
}