<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recover extends MX_Controller
{

	function index()
	{
		
		$this->viewdata['title'] = 'Reset Password | Evaluation';
		$this->load->view('recover/recover', $this->viewdata);

	}
	function recover_code(){
		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		$url = site_url('recover');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('phone', 'phone', 'required');

		
		if($fv->run() == TRUE){

			// IF USERNAME IS TAKEN
			$res = $this->general->get_table('users', array('phone' => $all_post->username), 'username');
			if ($res->num_rows() == 0) {
				$this->session->set_flashdata('msg_error', 'Phone Invalid');
				redirect($url);
			}

			// VALIDATE IF NUMBER IS TRUE
			if(strlen($all_post->number) != 13){
				$this->session->set_flashdata('msg_error', 'Invalid Phone Number');
				redirect($url);
			}
			// MIN OF 8 CHARACTER FOR PASSWORD
	
			$code = substr (uniqid(), 5, 5);
			$update_data = array(
								'reset_code' => $code,
								);

			$this->general->update_table('users', array('phone' => $all_post->phone), $update_data);

			$var = $this->general->send_sms($all_post->number, $code);
			
			foreach($all_post as $key => $val)
			{
				$this->session->set_flashdata($key, '');
			}
			$this->session->set_flashdata('msg_success', 'Code has been Successfully sent');
			$this->session->set_userdata('session_recover', $res->row()->username);
			redirect($url);
		}
		else{
			$this->session->set_flashdata('msg_error', 'Please Fill up the blank Fields');
			redirect('recover/reset');
		}
	}
	function reset()
	{
		
		$this->viewdata['title'] = 'Reset Password | Evaluation';
		$this->load->view('recover/reset', $this->viewdata);

	}
	function do_reset()
	{
		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		$url = site_url('recover/reset');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('code', 'code', 'required');
		$fv->set_rules('password', 'password', 'required');
		$fv->set_rules('password_again', 'password_again', 'required');

		
		if($fv->run() == TRUE){

			// IF USERNAME IS TAKEN
			$res = $this->general->get_table('users', array('code' => $all_post->code), 'id');
			if ($res->num_rows() == 0) {
				$this->session->set_flashdata('msg_error', 'Invalid code');
				redirect($url);
			}

			// MIN OF 8 CHARACTER FOR PASSWORD
			if(strlen($all_post->password) < 8){
				$this->session->set_flashdata('msg_error', 'Weak Password');
				redirect($url);
			}

			// CHECK IF THE PASSWORD MATCH
			if($all_post->password != $all_post->password_again){
				$this->session->set_flashdata('msg_error', 'Password not Match');
				redirect($url);
			}
	
			$update_data = array(
								'password' => base64_encode(base64_encode($all_post->password)),
								);

			$this->general->update_table('users', array('phone' => $all_post->code), $update_data);

			
			foreach($all_post as $key => $val)
			{
				$this->session->set_flashdata($key, '');
			}
			$this->session->set_flashdata('msg_success', 'Successfully Reset');
			redirect('login');
		}
	
	}
	function do_resend(){

		if($this->session->session_recover != ''){
			$res = $this->general->get_table('users', array('username' => $this->session->session_recover), 'phone, code');
			
			try {
				$this->general->send_sms($res->row()->phone, $res->row()->phone);
				exit(json_encode(array('status' => 'success', 'message' => 'Successfully Reset')));
			} catch (Exception $e) {
				exit(json_encode(array('status' => 'success', 'message' => 'We Cannot Process your request right now')));
			}
		}
		else{
			redirect('recover/reset');
		}

	}


	
	
	
	
}