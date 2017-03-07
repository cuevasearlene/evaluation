<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->viewdata['modid'] = $this->general->get_modid('question');
		$this->viewdata['controller'] = 'question';

		$this->limit = 10;
		
	}

	function index()
	{

		$this->general->blocked_page('question');

		$all_get = $this->general->all_get();
		$offset = ($offset != NULL) ? $offset : $all_get->per_page;


		$this->viewdata['category'] = $this->general->get_category('question');
		$this->viewdata['modal_category'] = $this->general->get_category('question', false);


		$this->db->order_by('q.created_at', 'desc');
		$this->db->limit($this->limit, $offset);
		$this->db->join('users as s', 's.id = q.uid');
		$optional = $all_get->q ? $this->db->like('q.question', $all_get->q) : null;
		$optional = $all_get->category ? $this->db->where('q.category', $all_get->category) : null;
		$this->viewdata['get_table'] = $this->general->get_table('question as q', '', 'q.*, s.username');
		// GETTING TABLE RESULT



		$optional = $all_get->q ? $this->db->like('question', $all_get->q) : null;
		$optional = $all_get->category ? $this->db->where('q.category', $all_get->category) : null;
		$total_row = $this->general->get_table('question as q', '', '1')->num_rows();
		// GETTING NUMBER OF ROWS

		if($total_row == 0){
				$this->session->set_flashdata('msg_error', 'No data Found');
		}

		$page_query_string = FALSE;
		$base_url = site_url('question/index/');
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
				$base_url  = base_url('question?');
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

		$this->viewdata['types'] 	= array('single' => '1 answer Only', 'multiple' => 'Many answer are acceptable', 'single_custom' => '1 answer Only with custom field',  'multiple_custom' => 'Many answer are acceptable with custom field');
		$this->viewdata['total_rows'] 	= $total_row;
		$this->viewdata['title'] = 'Questions';
		$this->viewdata['content'] = 'question/table';
		$this->load->view($this->template, $this->viewdata);
	}

	function create(){

		$this->general->blocked_page('question', 'create');

		$all_post = $this->general->all_post();
		// exit(var_dump($all_post));

		$url = site_url('evaluation');
		// THIS IS server side validation
		$fv = $this->form_validation;
		$fv->set_rules('question', 'question', 'required');
		$fv->set_rules('category', 'category', 'required');
		$fv->set_rules('type', 'type', 'required');
		
		
		if($fv->run() == TRUE){



			if($all_post->id != ''){
				// VALIDATE IF TITLE IS LESS THAN 15
				if(strlen($all_post->question) < 30){
					exit(json_encode(array('status' => 'error', 'message' => 'question must be at least 30 characters.')));
				}

				$res = $this->general->get_table('question', array('question' => $all_post->question, 'id <>' => $all_post->id), 'id');
				if($res->num_rows() > 0){
					exit(json_encode(array('status' => 'error', 'message' => 'Question already Exist on the Selection')));
				}


				$update_data = array(
					'question' => $all_post->question
					,'category' => $all_post->category
					,'type' => $all_post->type
					);
				$this->general->update_table('question', array('id' => $all_post->id), $update_data);

				
				exit(json_encode(array('status' => 'success', 'message' => 'Successfully Save')));

			}
			else{
				// VALIDATE IF TITLE IS LESS THAN 15
				if(strlen($all_post->question) < 30){
					exit(json_encode(array('status' => 'error', 'message' => 'question must be at least 30 characters.')));
				}

				$res = $this->general->get_table('question', array('question' => $all_post->question), 'id');
				if($res->num_rows() > 0){
					exit(json_encode(array('status' => 'error', 'message' => 'Question already Exist on the Selection')));
				}


				$insert_data = array(
					'question' => $all_post->question
					,'category' => $all_post->category
					,'uid' => $this->session->session_uid
					,'created_at' => $this->general->datetime
					,'type' => $all_post->type
					);
				$this->general->insert_table('question', $insert_data);

				exit(json_encode(array('status' => 'success', 'message' => 'Successfully Save')));

			}		

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'Please enter blank fields.')));
			
		}

	}

	function delete(){

		$this->general->blocked_page('question', 'drop');

		$all_post = $this->general->all_post();
	

		if($all_post->confirmation != 'FOREVER'){
			exit(json_encode(array('status' => 'error', 'message' => 'Invalid Confirmation')));
		}

		$this->general->delete_table('question', array('id' => $all_post->id));
		$this->general->delete_table('question_evaluation', array('question_id' => $all_post->id));

		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Deleted')));


	}




	
	
}