<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();

		$this->limit = 8;

		$this->viewdata['modid'] = $this->general->get_modid('evaluation');
		$this->viewdata['controller'] = 'evaluation';
		
	}


	function index($id = '')
	{
		$this->general->blocked_page('evaluation', 'alter');
		$res = $this->general->get_table('evaluation', array('id' => $id), 'id');

		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}
		$this->viewdata['id'] = $res->row()->id;
		$this->viewdata['title'] = 'Members';
		$this->viewdata['content'] = 'evaluation/members';
		$this->load->view($this->template, $this->viewdata);
	}
	// CRUD ALL


	public function user_by_category(){
	 	$data = array();

        $no = $_POST['start'];

        $this->db->group_by('s.category');

        $this->general->table = 'users as s';
        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->select(array('COUNT(1) as "category_user"', '(SELECT COUNT(1) from evaluation_authorize where evaluation_id = "'.$_POS['id'].'") as "members"', 's.category'));
            $this->db->where('s.guid',2);

        $this->general->column_search = array('s.category');

        $this->general->column_order = array('s.category');
        $list = $this->general->get_datatables();

        foreach ($list as $val) {
        
            $row = array();
            $row['category_user'] = number_format($val->category_user - $val->members);
            $row['category'] = ($val->category != '' ? $val->category : 'uncategorized');
            $row['action'] = '<button class="btn btn-default waves-effect waves-light btn-xs m-b-5 add_members" data-category="'.$row['category'].'"><i class="fa fa-plus"> Add </i></button>';
            $data[] = $row;
        }

        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
  	    $this->db->where('s.guid',2);
      	$this->db->group_by('s.category');
      	$x = $this->db->get('users as s')->num_rows();
      	$total = $x;

        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
       $this->db->where('s.guid',2);
      	$this->db->group_by('s.category');
      	$filtered = $this->general->count_filtered();

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);
	}


	public function user_by_evaluation(){
	 	$data = array();

        $no = $_POST['start'];
      
        $this->db->where('s.guid',2);
        $this->general->table = 'users as s';
        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->select(array('s.username', 's.category'));


        $this->general->column_search = array('s.username', 's.category');
        $this->general->column_order = array('s.username', 's.category');

        $list = $this->general->get_datatables();

        foreach ($list as $val) {
        
            $row = array();
            $row['username'] = $val->username;
            $row['category'] = ($val->category != '' ? $val->category : 'Uncategorized');
            $row['action'] = '<button class="btn btn-default waves-effect waves-light btn-xs m-b-5 add_members" data-id="'.$val->username.'"><i class="fa fa-plus"> Add </i></button>';
            $data[] = $row;
        }
            
        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->where('s.guid',2);
        $total = $this->general->count_all();


        $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->where('s.guid',2);
        $filtered = $this->general->count_filtered();


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);
	}
    function load_evaluated_members(){
        $data = array();

        $no = $_POST['start'];
      

        $this->general->table = 'users as s';
        $this->db->where('ea.evaluation_id',$_POST['id']);
        $this->db->where('s.guid',2);
        $this->db->where('ea.evaluated', 1);
        $this->db->join('evaluation_authorize as ea', 'ea.evaluator_id = s.id', 'inner');
        $this->db->select(array('s.username', 's.category'));


        $this->general->column_search = array('s.username', 's.category');
        $this->general->column_order = array('s.username', 's.category');

        $list = $this->general->get_datatables();

        foreach ($list as $val) {
        
            $row = array();
            $row['username'] = $val->username;
            $row['category'] = ($val->category != '' ? $val->category : 'Uncategorized');
        
            $data[] = $row;
        }
            
        $this->db->where('ea.evaluation_id',$_POST['id']);
        $this->db->where('s.guid',2);
        $this->db->where('ea.evaluated', 1);
        $this->db->join('evaluation_authorize as ea', 'ea.evaluator_id = s.id', 'inner');
        $total = $this->general->count_all();


        $this->db->where('ea.evaluation_id',$_POST['id']);
        $this->db->where('s.guid',2);
        $this->db->where('ea.evaluated', 1);
        $this->db->join('evaluation_authorize as ea', 'ea.evaluator_id = s.id', 'inner');
        $filtered = $this->general->count_filtered();


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);

    }

   function load_members(){
        $data = array();

        $no = $_POST['start'];
      
        $this->db->where('s.guid',2);
        $this->general->table = 'users as s';
        $this->db->where('s.id IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->select(array('s.username', 's.category'));


        $this->general->column_search = array('s.username', 's.category');
        $this->general->column_order = array('s.username', 's.category');

        $list = $this->general->get_datatables();

        foreach ($list as $val) {
        
            $row = array();
            $row['username'] = $val->username;
            $row['category'] = ($val->category != '' ? $val->category : 'Uncategorized');
        
            $data[] = $row;
        }
            
        $this->db->where('s.id IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'")', NULL, FALSE);
        $this->db->where('s.guid',2);
        $total = $this->general->count_all();


        $this->db->where('s.id IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$_POST["id"].'" )', NULL, FALSE);
        $this->db->where('s.guid',2);
        $filtered = $this->general->count_filtered();


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);

    }




    function add_members(){
        $all_post = $this->general->all_post();

        $eval = $this->general->get_table('evaluation', array('id' => $all_post->evaluation_id), 'title');
        if( $all_post->id != ''){
            $data = $this->general->get_table('users as s', array('username'=> $all_post->id), 's.id, s.phone');
            $insert_data = 
                          array(
                                'evaluator_id' => $data->row()->id
                                ,'evaluation_id' => $all_post->evaluation_id
                                ,'uid' => $this->general->session_uid
                                ,'created_at' => $this->general->datetime
                                );


            $this->general->send_sms($data->row()->phone, 'You can now Evaluate '.$eval->row()->title);
            $this->general->insert_table('evaluation_authorize', $insert_data);
            exit(json_encode(array('status' => 'success', 'message' => 'Successfully Added')));

        }
        if( $all_post->category != ''){
         
                $all_post->category == 'uncategorized' ? $this->db->where('s.category = ""') : $this->db->where('s.category', $all_post->category);
                $this->db->where('s.id NOT IN (SELECT evaluator_id from evaluation_authorize where evaluation_id = "'.$all_post->evaluation_id.'")');
                $this->db->where('s.guid', 2);
                $res = $this->general->get_table('users as s');
                 // exit(var_dump($res->num_rows()));
                foreach ($res->result() as $val) {
                      // $this->general->send_sms($val->phone, 'You can now Evaluate '.$eval->row()->title);
                       $insert_data = 
                          array(
                                'evaluator_id' => $val->id
                                ,'evaluation_id' => $all_post->evaluation_id
                                ,'uid' => $this->general->session_uid
                                ,'created_at' => $this->general->datetime
                                );
                        $this->general->insert_table('evaluation_authorize', $insert_data);
                }
                 exit(json_encode(array('status' => 'success', 'message' => 'Successfully Added')));
            }
           
        }

}