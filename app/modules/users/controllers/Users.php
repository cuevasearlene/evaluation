<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->viewdata['modid'] = $this->general->get_modid('users');
		$this->viewdata['controller'] = 'users';
		
	}

	function index()
	{
		$all_get = $this->general->all_get();
		$offset = ($offset != NULL) ? $offset : $all_get->per_page;


		$cat = $this->general->get_table('user_group', '', 'guid, gname')->result();
		$array = array();
		$array[] = 'All Users';
		foreach($cat as $row ){
			$array[ $row->guid] = $row->gname;
		}

		$this->viewdata['category'] = $array;


		// exit(var_dump($this->viewdata['category']));

		$this->db->order_by('q.created_at', 'DESC');
		$this->db->limit($this->limit, $offset);
		$this->db->join('user_group as ug', 'ug.guid = q.guid');
		$optional = $all_get->q ? $this->db->like('username', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('phone', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('email', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('name', $all_get->q) : null;
		$optional = $all_get->category ? $this->db->where('q.guid', $all_get->category) : null;
		$optional = $all_get->status && $all_get->status != "all" ? ($all_get->status == 'active' ? $this->db->where('verification_code is null') : $this->db->where('verification_code <> ""')) : null;
		$this->viewdata['get_table'] = $this->general->get_table('users as q', '', 'q.*, ug.gname');
		// GETTING TABLE RESULT



		$optional = $all_get->q ? $this->db->like('username', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('phone', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('email', $all_get->q) : null;
		$optional = $all_get->q ? $this->db->or_like('name', $all_get->q) : null;
		$optional = $all_get->category ? $this->db->where('q.guid', $all_get->category) : null;
		$optional = $all_get->status && $all_get->status != "all" ? ($all_get->status == 'active' ? $this->db->where('verification_code is null') : $this->db->where('verification_code <> ""')) : null;
		$total_row = $this->general->get_table('users as q', '', '1')->num_rows();
		// GETTING NUMBER OF ROWS

		if($total_row == 0){
			$this->session->set_flashdata('msg_error', 'No data Found');
		}

		$page_query_string = FALSE;
		$base_url = site_url('user/index/');
		if($_SERVER['QUERY_STRING'])
		{
			$query_string = NULL;
			foreach($all_get as $key => $val)
			{
				if($key != 'per_page' && $val)
				{
					$query_string .= $key.'='.$val.'&';
				}
			}

			if($query_string)
			{
				$base_url  = base_url('user?');
				$base_url .= rtrim($query_string, '&');

				$page_query_string = TRUE;
			}
		}

		$this->load->library('pagination');
		
		$config = $this->general->paging_config();

		$config['base_url'] 	= $base_url;
		$config['total_rows'] 	= $total_row;
		$config['per_page'] 	= $this->limit;
		$config['page_query_string'] = $page_query_string;

		// exit(var_dump($config));

		$this->pagination->initialize($config);
		$this->viewdata['pagination'] 		= $this->pagination->create_links();
		
		$this->viewdata['total_rows'] 	= $total_row;
		$this->viewdata['title'] = 'Users';
		$this->viewdata['content'] = 'users/table';
		$this->load->view($this->template, $this->viewdata);
	}


	function add()
	{
		$this->general->blocked_page('users', 'create');

		$cat = $this->general->get_table('user_group', '', 'guid, gname')->result();
		$array = array();
		foreach($cat as $row ){
			$array[$row->guid] = $row->gname;
		}

		$this->viewdata['category'] = $array;
		$this->viewdata['user_category'] = $this->general->get_category('user', false);

		$this->viewdata['title'] = 'Add User';
		$this->viewdata['content'] = 'users/form_add';
		$this->load->view($this->template, $this->viewdata);
	}


	function edit($id ='')
	{	
		$this->general->blocked_page('users', 'alter');

		$cat = $this->general->get_table('user_group', '', 'guid, gname')->result();
		$array = array();
		foreach($cat as $row ){
			$array[$row->guid] = $row->gname;
		}

		$data = $this->general->get_table('users', array('id' => $id), '*');

		$this->viewdata['data'] = $data->row();
		$this->viewdata['category'] = $array;
		$this->viewdata['user_category'] = $this->general->get_category('user', false);
		$this->viewdata['title'] = 'Edit User';
		$this->viewdata['content'] = 'users/form_edit';
		$this->load->view($this->template, $this->viewdata);
	}

	function update(){
		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));
		// will old data into flash session
		foreach($all_post as $key => $val)
		{
			$this->session->set_flashdata($key, $val);
		}

		// exit(var_dump($all_post));
		$url = site_url('users/edit/'.$id);
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('firstName', 'firstName', 'required');
		$fv->set_rules('password', 'password', 'required');
		$fv->set_rules('email', 'email', 'required');
		$fv->set_rules('username', 'username', 'required');
		$fv->set_rules('number', 'number', 'required');
		$fv->set_rules('password', 'password', 'required');
		$fv->set_rules('password_again', 'password_again', 'required');
		$fv->set_rules('category', 'category', 'required');
	
		
		if($fv->run() == TRUE){
			// IF EMAIL IS NOT VALID
			if (filter_var($all_post->email, FILTER_VALIDATE_EMAIL) === false) {
				$this->session->set_flashdata('msg_error', 'Invalid Email');
				redirect($url);
			}

			// IF EMAIL IS TAKEN
			$res = $this->general->get_table('users', array('email' => $all_post->email, 'email <>' =>  $all_post->email), 'id');
			if ($res->num_rows() > 0) {
				$this->session->set_flashdata('msg_error', 'Email Already Taken');
				redirect($url);
			}

			// IF USERNAME IS TAKEN
			$res = $this->general->get_table('users', array('username' => $all_post->username, 'username <> ' => $all_post->username), 'id');
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

	
	
			$update_data = array(
				'username' => $all_post->username,
				'password' => base64_encode(base64_encode($all_post->password)),
				'name' => $all_post->name,
				'guid' => $all_post->guid,
				'email' => $all_post->email,
				'phone' => $all_post->number,
				'category' => $all_post->category
				);

			$this->general->update_table('users', array('id' => $all_post->id), $update_data);
			$this->session->set_flashdata('msg_success', 'Successfully Update');
			redirect('users');

		

		}
		else{
			$this->session->set_flashdata('msg_error', 'Please Fill up the blank Fields');
			redirect($url);
		}

	}

	function delete(){

		$this->general->blocked_page('users', 'drop');

		$all_post = $this->general->all_post();
	
		$res = $this->general->get_table('users', array('id' => $all_post->id, 'username' => $all_post->confirmation));
		if($res->num_rows() <= 0 ){
			exit(json_encode(array('status' => 'error', 'message' => 'Please Enter the right confirmation')));
		}

		$this->general->delete_table('users', array('id' => $all_post->id));

		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Deleted')));

	}

	function profile($username = ""){

		$this->general->blocked_page('users', 'alter');

		$cat = $this->general->get_table('user_group', '', 'guid, gname')->result();
		$array = array();
		foreach($cat as $row ){
			$array[$row->guid] = $row->gname;
		}

		$data = $this->general->get_table('users', array('username' => $username), '*');

		$this->viewdata['data'] = $data->row();
		$this->viewdata['category'] = $array;
		$this->viewdata['user_category'] = $this->general->get_category('user', false);
		$this->viewdata['title'] = 'Profile';
		$this->viewdata['content'] = 'users/profile';
		$this->load->view($this->template, $this->viewdata);

	}
	function retrieve_my_evaluation(){

		$data = array();

        $no = $_POST['start'];

        $this->general->table = 'evaluation as e';
        $this->db->where('e.uid', $this->session->session_uid);
        $this->db->select('e.title', 'e.created_at');
           
        $this->general->column_search = array('e.title', 'e.created_at');
        $this->general->column_order = array('e.title', 'e.created_at');

        $list = $this->general->get_datatables();

        foreach ($list as $val) {
        
            $row = array();
            $row['title'] = $val->title;
            $row['created_at'] = date('F d, Y', strtotime($val->created_at));
        
            $data[] = $row;
        }

        $this->db->where('e.uid', $this->session->session_uid);
      	$x = $this->db->get('evaluation as e')->num_rows();
      	$total = $x;

  	    $this->db->where('e.uid', $this->session->session_uid);
      	$filtered = $this->general->count_filtered();

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);
	}



	
	
}