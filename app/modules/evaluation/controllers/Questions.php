<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends MX_Controller
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

        $this->db->join('question as q', 'q.id = qe.question_id');
		$data = $this->general->get_table('question_evaluation as qe', array('qe.evaluation_id' => $id), 'qe.id, q.question');

        $this->viewdata['category'] = $this->general->get_category('question');
        $this->viewdata['types']    = array('single' => '1 answer Only', 'multiple' => 'Many answer are acceptable', 'single_custom' => '1 answer Only with custom field',  'multiple_custom' => 'Many answer are acceptable with custom field');
        $this->viewdata['data'] = $data;
		$this->viewdata['id'] = $res->row()->id;
		$this->viewdata['title'] = 'Questions';
		$this->viewdata['content'] = 'evaluation/questions_edit';
		$this->load->view($this->template, $this->viewdata);
	}


    function get_question_list(){

        $all_post = $this->general->all_post();

        $data = array();

        $no = $_POST['start'];

       $this->general->column_search = array('question', 'category');
       $this->general->column_order = array('question', 'category');

       $this->general->table = 'question as q';
       $this->db->where('q.id not in (SELECT question_id from question_evaluation where evaluation_id = "'.$all_post->id.'")', NULL, FALSE);
       $this->db->select('question, category, id');
        $list = $this->general->get_datatables();

        foreach ($list as $val) {
            $row = array();
            $row['question'] = '<span class="more">'.$val->question.'</span>';
            $row['category'] = ($val->category != '' ? $val->category : 'uncategorized');
            $row['action'] = '<button class="btn btn-default waves-effect waves-light btn-xs m-b-5 add_exists_question" data-qid="'.$val->id.'"><i class="fa fa-plus"> Add </i></button>';
            $data[] = $row;
        }

        $this->db->where('q.id not in (SELECT question_id from question_evaluation where evaluation_id = "'.$all_post->id.'")', NULL, FALSE);
        $x = $this->db->get('question as q')->num_rows();
        $total =$x;

        $this->db->where('q.id not in (SELECT question_id from question_evaluation where evaluation_id = "'.$all_post->id.'")', NULL, FALSE);
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