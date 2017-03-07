<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MX_Controller
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
		$this->general->blocked_page('evaluation');
		$res = $this->general->get_table('evaluation', array('id' => $id), 'id');
		if($res->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Invalid Evaluation');
				redirect('evaluation');
		}

		$this->db->join('question as q', 'q.id = qe.question_id', 'inner');
		$question_list = $this->general->get_table('question_evaluation as qe', array('qe.evaluation_id' => $id), 'qe.id, q.question, q.type');
		if($question_list->num_rows() <= 0){
				$this->session->set_flashdata('msg_error', 'Ops we cannot generate report due to insufficient data.');
				redirect('evaluation');
		}
		$r = $this->general->get_table('evaluation as e', array('e.id' => $id), 'e.created_at, e.expired_at, (SELECT COUNT(1) FROM evaluation_authorize where evaluation_id = e.id group by evaluation_id) as "authorize", (SELECT COUNT(1) FROM evaluation_authorize where evaluation_id = e.id and evaluated = 1 group by evaluation_id) as "evaluated"');
		$this->viewdata['sum'] = $r->row();
		$this->viewdata['id'] = $id;
		$this->viewdata['questions'] = $question_list;
		$this->viewdata['title'] = 'Report';
		$this->viewdata['content'] = 'evaluation/report';
		$this->load->view($this->template, $this->viewdata);
	}



	 function load_evaluated_members(){
        $data = array();

        $no = $_POST['start'];
      

        $this->general->table = 'users as s';

        $this->db->where('answer_id', $_POST['aid']);
        $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary as es', 'es.uid = s.id', 'inner');
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
            

        $this->db->where('answer_id', $_POST['aid']);
        $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary as es', 'es.uid = s.id', 'inner');
        $total = $this->general->count_all();


   		$this->db->where('answer_id', $_POST['aid']);
        $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary as es', 'es.uid = s.id', 'inner');
        $filtered = $this->general->count_filtered();


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);

    }


	 function load_other_answers(){
        $data = array();

        $no = $_POST['start'];
      

        $this->general->table = 'users as s';
        $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary_other as es', 'es.uid = s.id', 'inner');
        $this->db->select(array('s.username', 'es.text'));



        $this->general->column_search = array('es.text', 's.username');
        $this->general->column_order = array('es.text', 's.username');

        $list = $this->general->get_datatables();


        foreach ($list as $val) {
        
            $row = array();
            $row['username'] = $val->username;
            $row['answers'] = ($val->text);
            $row['created_at'] = date('F d, Y', strtotime($val->created_at));
        
            $data[] = $row;
        }
            

        $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary_other as es', 'es.uid = s.id', 'inner');
        $total = $this->general->count_all();


   	    $this->db->where('question_id', $_POST['qid']);
        $this->db->join('evaluation_summary_other as es', 'es.uid = s.id', 'inner');
        $filtered = $this->general->count_filtered();


        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $filtered,
                        "data" => $data,
                );
        echo json_encode($output);

    }

    function question_summary_graph(){
    	$all_post = $this->general->all_post();
    	$this->db->group_by('es.answer_id');
    	$this->db->join('question_choices as qc', 'qc.id = es.answer_id');
    	$answers = $this->general->get_table('evaluation_summary as es', array('es.id' => $all_post->qid), 'COUNT(1) as "answers", qc.text');
    	$res['answers'] = $answers->result();

		$custom = array('single_custom', 'multiple_custom');

    	$this->db->join('question as q', 'q.id = es.question_id');
    	$details = $this->general->get_table('question_evaluation as es', array('es.question_id' => $all_post->qid), 'q.type');
    	if(in_array($details->row()->type, $custom) ){
    		$others = $this->general->get_table('evaluation_summary_other as es', array('es.question_id' => $all_post->qid), 'id')->num_rows();
    		$res['others'] = $others;

    	}
    	echo json_encode($res);


    }
	
}