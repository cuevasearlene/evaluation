<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->session_uid		= $this->general->session_uid;

		$this->template = $this->general->template;
		$this->viewdata = $this->general->viewdata();

		$this->viewdata['modid'] = $this->general->get_modid('user_group');
		$this->viewdata['controller'] = 'usergroup';
	}

	function index()
	{
		$this->general->blocked_page('user_group');

		$all_get = $this->general->all_get();

		$optional = ($all_get->q) ? $this->db->like('gname', $all_get->q) : NULL;
		$get_table = $this->general->get_table('user_group');
		$this->viewdata['get_table'] = $get_table;

		$this->viewdata['all_get'] 		= $all_get;

		$this->viewdata['title'] = 'Data User Group';
		$this->viewdata['content'] = 'usergroup/table';
		$this->load->view($this->template, $this->viewdata);
	}

	function add()
	{
		$this->general->blocked_page('user_group', 'create');

		$this->viewdata['title'] = 'Add User Group';
		$this->viewdata['content'] = 'usergroup/form_add';
		$this->load->view($this->template, $this->viewdata);
	}

	function save()
	{
		$this->general->blocked_page('user_group', 'create');

		$all_post = $this->general->all_post();
		$fv = $this->form_validation;

		$fv->set_rules('gname', 'gname', 'required');

		$role_view 		= (is_array($all_post->view)) ? implode(',', $all_post->view) : '';
		$role_create 	= (is_array($all_post->create)) ? implode(',', $all_post->create) : '';
		$role_alter 	= (is_array($all_post->alter)) ? implode(',', $all_post->alter) : '';
		$role_drop 		= (is_array($all_post->drop)) ? implode(',', $all_post->drop) : '';

		$role_data = json_encode(array('view' => $role_view, 'create' => $role_create, 'alter' => $role_alter, 'drop' => $role_drop));

		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		$this->session->set_flashdata('role_data', $role_data);

		if($fv->run() == TRUE)
		{
			$check_gname = $this->general->get_table('user_group', array('gname' => $all_post->gname), 'gname');
			if($check_gname->num_rows() != 0)
			{
				$this->session->set_flashdata('msg_error', 'Group name already in use');
				redirect('usergroup/add');
			}

			$insert_data = array(
				'gname' => ucwords($all_post->gname),
				'role' => $role_data
			);

			$this->general->insert_table('user_group', $insert_data);

			$this->session->set_flashdata('msg_success', 'Data successfully saved');
			redirect('usergroup');
		}
		else
		{
			$this->session->set_flashdata('msg_error', 'Please enter all fields (*)!');
			redirect('usergroup/add');
		}
	}

	function edit($guid = '')
	{
		$this->general->blocked_page('user_group', 'alter');

		$all_post = $this->general->all_post();

		$table_id = $guid;

		$check_data = $this->general->get_table('user_group', array('guid' => $table_id));
		if($check_data->num_rows() != 1)
		{
			$this->session->set_flashdata('msg_error', 'Data not found');
			redirect('usergroup');
		}

	
		$data_edit = $check_data->row();
		$this->viewdata['data_edit'] = $data_edit;

		$this->viewdata['title'] = 'Edit User Group';
		$this->viewdata['content'] = 'usergroup/form_edit';
		$this->load->view($this->template, $this->viewdata);
	}

	function update()
	{

		$this->general->blocked_page('user_group', 'alter');

		$all_post = $this->general->all_post();
		$fv = $this->form_validation;

		$fv->set_rules('gname', 'gname', 'required');

		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		$this->session->set_flashdata('role_data', $role_data);

		if($fv->run() == TRUE)
		{
			
			if($all_post->old_gname != $all_post->gname){

				$check_gname = $this->general->get_table('user_group', array('guid !=' => $table_id, 'gname' => $all_post->gname), 'gname');

				if($check_gname->num_rows() != 0)
				{
					$this->session->set_flashdata('msg_error', 'Group name already in use');
					redirect('usergroup/edit/'.$all_post->gname);

				}
			}

			$role_view 		= (is_array($all_post->view)) ? implode(',', $all_post->view) : '';
			$role_create 	= (is_array($all_post->create)) ? implode(',', $all_post->create) : '';
			$role_alter 	= (is_array($all_post->alter)) ? implode(',', $all_post->alter) : '';
			$role_drop 		= (is_array($all_post->drop)) ? implode(',', $all_post->drop) : '';

			$role_data = json_encode(array('view' => $role_view, 'create' => $role_create, 'alter' => $role_alter, 'drop' => $role_drop));

			$update_data = array(
				'gname' => ucwords($all_post->gname),
				'role' => $role_data
			);

			$this->general->update_table('user_group', array('gname' => $all_post->gname), $update_data);

			$this->session->set_flashdata('msg_success', 'Data successfully saved');
			redirect('usergroup');
		}
		else
		{
			$this->session->set_flashdata('msg_error', 'Please enter all fields (*)!');
			redirect('usergroup/edit/'.$all_post->gname);
		}
	}

	function delete($id = '')
	{
		$this->general->blocked_page('user_group', 'drop');

		$all_post = $this->general->all_post();
		
		$res = $this->general->get_table('user_group', array('guid' => $all_post->id,  'gname' => $all_post->confirmation));

		if($res->num_rows() <= 0){
				exit(json_encode(array('status' => 'error', 'message' => 'Invalid Confirmation')));
		}

		$this->general->delete_table('user_group', array('guid' => $all_post->id));
	
		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Deleted')));

			
	}
}