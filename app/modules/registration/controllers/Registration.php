<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MX_Controller
{

	function index()
	{
		$this->viewdata['title'] = 'Registration | Evaluation';
		$this->load->view('registration/registration', $this->viewdata);
		


	}

	function do_register(){

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		// exit(var_dump($all_post));
		$url = $_SERVER['HTTP_REFERER'];
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('name', 'name', 'required');
		$fv->set_rules('email', 'email', 'required');
		$fv->set_rules('username', 'username', 'required');
		$fv->set_rules('number', 'number', 'required');
		$fv->set_rules('password', 'password', 'required');
		$fv->set_rules('password_again', 'password_again', 'required');
		if(!$all_post->manual){
			$fv->set_rules('captcha', 'captcha', 'required');
		}
		if($all_post->manual){
			$fv->set_rules('category', 'category', 'required');
		}
		
		
		if($fv->run() == TRUE){

			// IF EMAIL IS NOT VALID
			if (filter_var($all_post->email, FILTER_VALIDATE_EMAIL) === false) {
				$this->session->set_flashdata('msg_error', 'Invalid Email');
				redirect($url);
			}

			// IF EMAIL IS TAKEN
			$res = $this->general->get_table('users', array('email' => $all_post->email), 'id');
			if ($res->num_rows() > 0) {
				$this->session->set_flashdata('msg_error', 'Email Already Taken');
				redirect($url);
			}

			// IF USERNAME IS TAKEN
			$res = $this->general->get_table('users', array('username' => $all_post->username), 'id');
			if ($res->num_rows() > 0) {
				$this->session->set_flashdata('msg_error', 'Username Already Taken');
				redirect($url);
			}

			// VALIDATE IF NUMBER IS TRUE
			if(strlen($all_post->number) != 13){
				$this->session->set_flashdata('msg_error', 'Invalid Phone Number');
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

			if(!$all_post->manual){
				// CHECK IF THE PASSWORD MATCH
				if(	$this->session->userdata('captcha_word') != $all_post->captcha){
					$this->session->set_flashdata('msg_error', 'Invalid Captcha');
					redirect($url);
				}
			}

			$code = substr (uniqid(), 5, 5);
			$insert_data = array(
								'category' => $all_post->category ? $all_post->category : 'uncategorized',
								'username' => $all_post->username,
								'password' => base64_encode(base64_encode($all_post->password)),
								'name' => $all_post->name,
								'guid' => $all_post->guid ? $all_post->guid : 2,
								'email' => $all_post->email,
								'phone' => $all_post->number,
								'created_at' => $this->general->datetime,
								'verification_code' => $all_post->manual ? null: $code
								);
			$this->general->insert_table('users', $insert_data);

			if(!$all_post->manual){
				$var = $this->general->send_sms($all_post->number, $code);
			}
		
			
			foreach($all_post as $key => $val)
			{
				$this->session->set_flashdata($key, '');
			}
			$this->session->set_flashdata('msg_success', 'Succesfully Registered');
			if($this->session->userdata('session_uid') != ''){
				redirect('users');
			}
			else{
				redirect('activate');
			}

		}
		else{
			$this->session->set_flashdata('msg_error', 'Please Fill up the blank Fields');
			redirect($url);
		}


	}
	
	
}