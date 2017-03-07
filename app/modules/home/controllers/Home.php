<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->current = $this->general->check_user();
		$this->template = $this->general->template;
		$this->template_login = $this->general->template_login;
		$this->viewdata = $this->general->viewdata();
		
		
	}

	function index()
	{




		$this->db->join('(SELECT COUNT(1) as quest_total, qe.evaluation_id from question_evaluation as qe group by qe.evaluation_id) as q', 'q.evaluation_id = ev.id', 'INNER');
		$this->db->having('quest_total >= ', 5);
		$this->viewdata['active_topic'] = $this->general->get_table('evaluation as ev', array('ev.expired_at >=' => date('Y-m-d')), 'q.quest_total')->num_rows();


		$this->viewdata['question_count'] = $this->general->get_table('question as q', '', 'count(1) as total_question')->row()->total_question;

		$this->viewdata['evaluator_count'] = $this->general->get_table('users as q', array('guid' => 2), 'count(1) as evaluator_count')->row()->evaluator_count;

		




		$this->viewdata['title'] = 'Dashboard';
		$this->viewdata['content'] = 'home/content';
		$this->load->view($this->template, $this->viewdata);
	}

	
	
}