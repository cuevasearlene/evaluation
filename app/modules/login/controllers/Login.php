<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller
{

	function __construct()
	{
		parent::__construct();
	

	}

	function index()
	{

		// if the user remeber his/her login
	  	if($_COOKIE["user_token"] != ''){
	  		//check if there is a result for remember token if found
	  		$id = $this->general->get_table('users', array('remember_token' => base64_encode(base64_encode($_COOKIE["user_token"]))), 'id')->row()->id;
	  		if($id != ''){
	  			$this->session->set_userdata('session_uid', $id);
	  			redirect('/home');
	  		}
	  	}
	  	//if there is session
	  	if($this->session->userdata('session_uid') != ''){
	  		redirect('/home');
	  	}
	  	$this->viewdata['title'] = 'Admin Login | Evaluation ';
		$this->load->view('login/login', $this->viewdata);

	}
	function do_login(){
	
		$this->load->model('General');

		// THIS LINE will convert all post data into object
		$all_post = $this->general->all_post();
		
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		// this will check if the user exist
		$this->db->where('guid <>', 2);
		$is_login = $this->general->get_table('users', array('username' => $all_post->username, 'password' => base64_encode(base64_encode($all_post->password))), 'id');

		// if user found
		if($is_login->num_rows() > 0){
			// this will set user id to session
			 $this->session->set_userdata('session_uid', $is_login->row()->id);
			// if remember me is check
			
			if($all_post->remember == "on"){

				//it will generate a token and save to cookie
				$remember = uniqid(10);

				setcookie("user_token", $remember, time()+9999999); 


				

			    $this->general->update_table('users', array('id' => $is_login->row()->id), array('remember_token' => base64_encode(base64_encode($remember))));

			}
			redirect('/home');
		}
		// else it will go back to login
		else{
			$this->session->set_flashdata('msg_error', 'Invalid Credentials');
			redirect('login');
		}
	
	}
	function do_logout(){
		setcookie("user_token", '');
		$this->session->unset_userdata('session_uid');
		redirect('login');
	}

	
	
}