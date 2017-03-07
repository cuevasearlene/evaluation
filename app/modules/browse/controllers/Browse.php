<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->limit = 9;

		$this->viewdata['modid'] = $this->general->get_modid('evaluation');
		$this->viewdata['controller'] = 'browse';
		
	}


	function index()
	{
			
		$this->general->blocked_page('evaluation');

		$all_get = $this->general->all_get();
		$offset = ($offset != NULL) ? $offset : $all_get->per_page;


		if($all_get->status){
			if($all_get->status == 'active'){
				$this->db->having('questions >=', 5);
				$this->db->where('e.expired_at >=', date('Y-m-d'));

			}
			if($all_get->status == 'inactive'){

				$this->db->having('questions <', 5);
				$this->db->or_having('questions is null');
				// $this->db->or_where('e.expired_at >=', date('Y-m-d'));

			}

		}

		$optional = $all_get->topics ? $this->db->where('e.category', $all_get->topics) : null;
		$optional = $all_get->q ? $this->db->like('e.title', $all_get->q, 'both') : NULL;
		$this->db->order_by('e.expired_at', 'desc');
		$this->db->limit($this->limit, $offset);
		
		$this->viewdata['get_table'] = $this->general->get_table('evaluation as e', '', 'e.*, 
			(SELECT COUNT(1) from evaluation_authorize where evaluation_id = e.id GROUP BY evaluation_id) as "authorize",
			(SELECT COUNT(1) from evaluation_authorize where evaluation_id = e.id and evaluated = 1 GROUP BY evaluation_id) as "evaluated",
			(SELECT COUNT(qe.id) from question_evaluation as qe where qe.evaluation_id = e.id GROUP BY qe.evaluation_id) as 
			"questions"
			');
		// GETTING TABLE RESULT

		if($all_get->status){
			if($all_get->status == 'active'){
				$this->db->having('questions >=', 5);
				$this->db->where('e.expired_at >=', date('Y-m-d'));

			}
			if($all_get->status == 'inactive'){

				$this->db->having('questions <', 5);
				$this->db->or_having('questions is null');
				// $this->db->or_where('e.expired_at >=', date('Y-m-d'));

			}

		}
		$optional = $all_get->q ? $this->db->like('e.title', $all_get->q, 'both') : NULL;
		$optional = $all_get->topics ? $this->db->where('e.category', $all_get->topics) : null;
		$total_row = $this->general->get_table('evaluation as e', '', 'e.id, (SELECT COUNT(qe.id) from question_evaluation as qe where qe.evaluation_id = e.id GROUP BY qe.evaluation_id) as 
			"questions"')->num_rows();
		// GETTING NUMBER OF ROWS

		if($total_row == 0){
				$this->session->set_flashdata('msg_error', 'No data Found');
		}

		$page_query_string = FALSE;
		$base_url = site_url('browse/index/');
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
				$base_url  = base_url('browse?');
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


		$this->viewdata['category'] = $this->general->get_category('topic');
		$this->viewdata['title'] = 'Browse Topic';
		$this->viewdata['content'] = 'browse/table';
		$this->load->view($this->template, $this->viewdata);
	}
	// CRUD ALL
	function add()
	{
		$this->general->blocked_page('evaluation', 'create');
		$this->viewdata['category'] = $this->general->get_category('topic', false);
		$this->viewdata['title'] = 'Add Evaluation';
		$this->viewdata['content'] = 'evaluation/basic_add';
		$this->load->view($this->template, $this->viewdata);
	}

	function save_basic(){
		$this->general->blocked_page('evaluation', 'create');

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));

		$url = site_url('evaluation');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('title', 'title', 'required');
		$fv->set_rules('category', 'category', 'required');
		$fv->set_rules('description', 'description', 'required');
		$fv->set_rules('page', 'page', 'required');
		$fv->set_rules('expired_at', 'expired_at', 'required');
		
		
		if($fv->run() == TRUE){

			// VALIDATE IF TITLE IS LESS THAN 15
			if(strlen($all_post->title) < 15){
				exit(json_encode(array('status' => 'error', 'message' => 'title must be at least 15 characters.')));
			}

			// VALIDATE IF DESCRIPTION IS LESS THAN 50
			if(strlen($all_post->description) < 50){
				exit(json_encode(array('status' => 'error', 'message' => 'title must be at least 15 description.')));
			}

			$id = uniqid();

			$date = explode('-', $all_post->expired_at);
			$all_post->expired_at = str_replace(',', '', $date[0]);
			$all_post->expired_at = date('Y-m-d', strtotime($all_post->expired_at));
		

			$insert_data = array(
				'id' => $id
				,'title' => $all_post->title
				,'category' => $all_post->category
				,'description' => $all_post->description
				,'page_size' => $all_post->page
				,'expired_at' => $all_post->expired_at
				,'created_at' => $this->general->datetime
				);
			$this->general->insert_table('evaluation', $insert_data);

			$path = "assets/attachments/".$id;

 			if(!is_dir($path)) //create the folder if it's not already exists
  			{
    			mkdir($path, 0777, TRUE);
    		}

			
			exit(json_encode(array('status' => 'success', 'message' => 'Successfully save you can now Proceed to next step')));

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'Please enter blank fields.')));
		}
	}
	// CRUD ALL


	// PARTIAL EDIT
	function edit_info($id = '')
	{
		$this->general->blocked_page('evaluation', 'alter');
		$res = $this->general->get_table('evaluation', array('id' => $id), '*');
		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}
		$this->viewdata['data'] = $res->row();
		
		$this->viewdata['category'] = $this->general->get_category('topic', false);
		$this->viewdata['title'] = 'Basic Information';
		$this->viewdata['content'] = 'evaluation/basic_edit';
		$this->load->view($this->template, $this->viewdata);
	}

	function update_basic(){
		$this->general->blocked_page('evaluation', 'alter');

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));

		$url = site_url('evaluation');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('title', 'title', 'required');
		$fv->set_rules('category', 'category', 'required');
		$fv->set_rules('description', 'description', 'required');
		$fv->set_rules('page', 'page', 'required');
		$fv->set_rules('expired_at', 'expired_at', 'required');
		
		
		if($fv->run() == TRUE){

			// VALIDATE IF TITLE IS LESS THAN 15
			if(strlen($all_post->title) < 15){
				exit(json_encode(array('status' => 'error', 'message' => 'title must be at least 15 characters.')));
			}

			// VALIDATE IF DESCRIPTION IS LESS THAN 50
			if(strlen($all_post->description) < 50){
				exit(json_encode(array('status' => 'error', 'message' => 'title must be at least 15 description.')));
			}

			$id = uniqid();

			$date = explode('-', $all_post->expired_at);
			$all_post->expired_at = str_replace(',', '', $date[0]);
			$all_post->expired_at = date('Y-m-d', strtotime($all_post->expired_at));

			$update_data = array(
				'title' => $all_post->title
				,'category' => $all_post->category
				,'description' => $all_post->description
				,'page_size' => $all_post->page
				,'expired_at' => $all_post->expired_at
				);
			$this->general->update_table('evaluation', array('id' => $all_post->id), $update_data);

			exit(json_encode(array('status' => 'success', 'message' => 'Successfully Updated')));

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'Please enter blank fields.')));
		}
	}
	function edit_attachment($id = '')
	{
		$this->general->blocked_page('evaluation', 'alter');
		$res = $this->general->get_table('evaluation', array('id' => $id), 'id');
		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}
		$this->viewdata['id'] = $res->row()->id;
		$this->viewdata['title'] = 'Attachments';
		$this->viewdata['content'] = 'evaluation/attachment_edit';
		$this->load->view($this->template, $this->viewdata);
	}

	function questions($id = '')
	{
		$this->general->blocked_page('evaluation', 'alter');
		$res = $this->general->get_table('evaluation', array('id' => $id), 'id');
		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}
		$this->viewdata['id'] = $res->row()->id;
		$this->viewdata['title'] = 'Question';
		$this->viewdata['content'] = 'evaluation/questions_edit';
		$this->load->view($this->template, $this->viewdata);
	}


	function retrieve_file(){
		$this->general->blocked_page('evaluation', 'alter');
		$all_post = $this->general->all_post();
		$res = $this->general->get_table('evaluation_attachment', array('evaluation_id' => $all_post->id));
	    foreach($res->result() as $file){ //get an array which has the names of all the files and loop through it 
      		 $obj['name'] = $file->name; //get the filename in array
       		 $obj['size'] = 0;
       		 if(file_exists('assets/attachments/'.$all_post->id.'/'.$file->name)){
       		 	 $obj['size'] = filesize('assets/attachments/'.$all_post->id.'/'.$file->name); //get the flesize in array
       		 }
       		
             $result[] = $obj; // copy it to another array
         }
       header('Content-Type: application/json');
       echo json_encode($result); // now you have a json response which you can use in client side 
	}

	function delete_file(){
		$this->general->blocked_page('evaluation', 'alter');
		$all_post = $this->general->all_post();

	    $this->general->delete_table('evaluation_attachment', array('evaluation_id' => $all_post->id, 'name' => $all_post->filename));

	  	  unlink('assets/attachments/'.$all_post->id.'/'.$all_post->filename);
	     
	 
	}
	function upload_file(){
		$this->general->blocked_page('evaluation', 'alter');

		$all_post = $this->general->all_post();
		if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

		$path = "assets/attachments/".$all_post->id;

		if(!is_dir($path)) //create the folder if it's not already exists
		{
			mkdir($path, 0777, TRUE);
		}
		$array = array(
						'name' =>  $_FILES['file']['name']
						,'evaluation_id' => $all_post->id
						,'uid' => $this->general->session_uid
						,'created_at' => $this->general->datetime
						);
		$this->general->insert_table('evaluation_attachment', $array);
        $targetPath = getcwd() . '/assets/attachments/'.$all_post->id.'/';

        $targetFile = $targetPath . $fileName ;
        move_uploaded_file($tempFile, $targetFile);
    	}
            
	}


	// GENERATING REPORTS
	function generate_report($id = '')
	{
		$this->general->blocked_page('evaluation');
		$res = $this->general->get_table('evaluation', array('id' => $id), 'id');
		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}
		$this->viewdata['title'] = 'Report';
		$this->viewdata['content'] = 'evaluation/report';
		$this->load->view($this->template, $this->viewdata);
	}
	// GENERATING REPORTS



}