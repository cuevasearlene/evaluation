<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		$this->viewdata['modid'] = $this->general->get_modid('Settings');
		$this->viewdata['controller'] = 'settings';
	}

	function index()
	{

		$this->viewdata['filetype'] = $this->general->get_table('settings', array('name' => 'filetype'), 'data')->row()->data;
		$this->viewdata['user'] = $this->general->get_table('settings', array('name' => 'user'), 'data')->row()->data;
		$this->viewdata['question'] = $this->general->get_table('settings', array('name' => 'question'), 'data')->row()->data;
		$this->viewdata['topic'] = $this->general->get_table('Settings', array('name' => 'topic'), 'data')->row()->data;
		$res = $this->general->get_table('Settings', array('name' => 'sms'), 'data')->row()->data;
		$this->viewdata['sms'] = json_decode($res);

		$this->viewdata['title'] = 'Settings';
		$this->viewdata['content'] = 'settings/content';
		$this->load->view($this->template, $this->viewdata);
	}
	function delete_category(){
		$all_post = $this->general->all_post();
		$res = $this->general->get_table('settings', array('name' => $all_post->name), 'data')->row()->data;
		$res = explode(',', $res);
		if (($key = array_search($all_post->value, $res)) !== false) {
   			 unset($res[$key]);
		}
		$res = implode(',', $res);
			$update_data = array(
					  'data' => $res
					  );
		$this->general->update_table('settings', array('name' => $all_post->name), $update_data);
		exit(json_encode(array('status' => 'success', 'message'  => $all_post->name)));

	}
	function add_category(){
		$all_post = $this->general->all_post();

		$res = $this->general->get_table('settings', array('name' => $all_post->name), 'data')->row()->data;
		$res = explode(',', $res);

		if (in_array($all_post->value, $res))
  		{
  			exit(json_encode(array('status' => 'error', 'message' => 'Already on the List')));
  		}
  		array_push($res, $all_post->value);
  	
		$res = implode(',', $res);

		$update_data = array(
					  'data' => $res
					  );

		$this->general->update_table('settings', array('name' => $all_post->name), $update_data);
		exit(json_encode(array('status' => 'success', 'message' => $all_post->name)));
	}
	function save_sms_gateway(){
		$all_post = $this->general->all_post();
		$data = json_encode($all_post);
		$this->general->update_table('settings', array('name' => 'sms'), array('data'=> $data));
		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Updated')));
	
	}

	
	
}