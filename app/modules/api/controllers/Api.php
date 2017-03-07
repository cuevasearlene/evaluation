<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		 header("Access-Control-Allow-Origin: *");
		
	}

	//this will general captcha
	function captcha(){
		echo json_encode($this->general->captcha());
	}
	//This is pre define validation
	function custom_validation(){
		$all_post = $this->general->all_post();
		if($all_post->email != ''){
			$array = array('email' => $all_post->email);
			if($all_post->id){
					$array = $array +array('id <>' => $all_post->id);
			}
			$res = $this->general->get_table('users', $array, 'id');
			exit($res->num_rows() > 0 ? json_encode(false) : json_encode(true));
		}
		if($all_post->username != ''){
			$array = array('username' => $all_post->username);
			if($all_post->id){
					$array = $array + array('id <>' => $all_post->id);
			}
			$res = $this->general->get_table('users', $array, 'id');
			exit($res->num_rows() > 0 ? json_encode(false) : json_encode(true));
		}
	
	}


	
	function resend_code(){
		$all_post = $this->general->all_post();
		// CHECK IF NUMBER IS VALID
		if($all_post->number == '' || strlen($all_post->number) != 13){
			exit(json_encode(array('status' => 'error', 'message' => 'Invalid Number')));
		}


		// CHECK IF THERE IS NUMBER EXIST
		$res = $this->general->get_table('users', array('phone' => $all_post->number, 'verification_code' => 'is null'), 'verification_code');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'error', 'message' => 'Error Phone is already activated')));
		}

		$res = $this->general->get_table('users', array('phone' => $all_post->number), 'verification_code');
	

		// this will resend verification code
	    $this->general->send_sms($all_post->number, $res->row()->verification_code);
		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Resend')));
	}

	function question_info(){
		$this->general->blocked_page('evaluation');
		$all_post = $this->general->all_post();
		$data = $this->general->get_table('question', array('id' => $all_post->id), 'question, type, category')->row();
		exit(json_encode(array('data' => $data)));

	}

	function create_question(){

		$this->general->blocked_page('evaluation', 'create');
		$all_post = $this->general->all_post();
		// CHECK IF NUMBER IS VALID
		
		$fv = $this->form_validation;
		$fv->set_rules('question', 'question', 'required');
		$fv->set_rules('id', 'id', 'required');
		$fv->set_rules('type', 'type', 'required');
		$fv->set_rules('category', 'category', 'required');
		
		
		if($fv->run() == TRUE){

			// THIS WILL CHECK IF EVAL IS EXIST
			$eval = $this->general->get_table('evaluation', array('id' => $all_post->id), 'id');
			if($eval->num_rows() <= 0){
					exit(json_encode(array('status' => 'error', 'message' => 'Please Add Evaluation First')));
			}


			$insert_data = array(
							'question' => $all_post->question
							,'category' => $all_post->category
							,'type' => $all_post->type
							,'uid' => $this->session->session_uid
							,'created_at' => $this->general->datetime
							);

			$this->general->insert_table('question', $insert_data);

			$id = $this->db->insert_id();

			$insert_data = array(
							'evaluation_id' =>  $all_post->id
							,'question_id' => $id
							);
			$this->general->insert_table('question_evaluation', $insert_data);
			$id = $this->db->insert_id();

			$html = '<div class="panel-group panel-group-joined accordion_question" data-question-container="'.$id.'"> <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title"> <a data-toggle="collapse" href="#c'.$id.'" class="collapsed">'.$all_post->question.'</a> </h4> </div><div id="c'.$id.'" class="panel-collapse collapse"> <div class="panel-body"> <ul class="list-unstyled" id="cholder'.$id.'"> <li> <div class="input-group m-t-10"> <input type="text" name="answer" class="form-control" placeholder="Add Answer" style="margin-top:10px"> <span class="input-group-btn"> <button type="button" class="btn waves-effect waves-light btn-primary add_choices" data-id="'.$id.'">Submit</button> </span> </div></li></ul> <button" class="btn btn-danger waves-effect waves-light pull-right delete_question" data-id="'.$id.'"  ><i class="fa fa-trash"></i> Delete This Question</button> </div></div></div></div>';

			exit(json_encode(array('status' => 'success', 'message' => $html)));

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'Please enter blank fields.')));
			
		}

	}

	function create_choices(){

		$this->general->blocked_page('evaluation', 'create');
		$all_post = $this->general->all_post();
		// CHECK IF NUMBER IS VALID
		
		$fv = $this->form_validation;
		$fv->set_rules('question_id', 'question_id', 'required');
		$fv->set_rules('details', 'details', 'required');
		
		if($fv->run() == TRUE){

	
			$insert_data = array(
							'question_eval_id' => $all_post->question_id
							,'text' => $all_post->details
							,'created_at' => $this->general->datetime
							);

			$this->general->insert_table('question_choices', $insert_data);
			$id = $this->db->insert_id();

			$html = ' <li data-id="choices'.$id.'"><button class="btn btn-default delete_choices" data-id="'.$id.'"><i class="fa fa-times"></i></button>  '.$all_post->details.'</li>';

			exit(json_encode(array('status' => 'success', 'message' => $html, 'id' => 'cholder'.$all_post->question_id)));

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'Please enter blank fields.')));
			
		}

	}

	function delete_choices(){
		$this->general->blocked_page('evaluation', 'delete');
		$all_post = $this->general->all_post();

		$array = array('id' => $all_post->id);
		$this->general->delete_table('question_choices', $array);
		exit(json_encode(array('status' => 'success', 'id' => $all_post->id)));

	}
	function delete_question(){
		$this->general->blocked_page('evaluation', 'delete');
		$all_post = $this->general->all_post();

		$array = array('id' => $all_post->id);
		$this->general->delete_table('question_evaluation', $array);

		$array = array('question_eval_id' => $all_post->id);
		$this->general->delete_table('question_choices', $array);


		exit(json_encode(array('status' => 'success', 'id' => $all_post->id)));


	}
	// THIS WILL OUTPUT HOW MANY EVALUATION FOR DELETING CURRENT QUESTION
	function quest_affect_evaluation(){

		$all_post = $this->general->all_post();
		$this->db->limit(1);
		$this->db->group_by('evaluation_id');
		$res = $this->general->get_table('question_evaluation', array('evaluation_id' => $all_post->id), 'COUNT(1) as total_affected');

		exit(json_encode(array('data' => number_format($res->row()->total_affected))));
	}

	// THIS FUNCTION WILL GET THE ALLOWED FILETYPE
	function allowed_filetype(){

		$filetype = '';
		$this->db->limit(1);
		$res = $this->general->get_table('settings', array('name' => 'filetype'), 'data')->row()->data;
		$res = explode(',', $res);
		for ($i=0; $i < sizeof($res); $i++) { 
			$filetype .= '.'.$res[$i].((sizeof($res) - 1 == $i) ? null : ',' );
		}
		echo $filetype;
	}


	function summary_reports(){
		$all_post = $this->general->all_post();
		$this->general->blocked_page('evaluation');
		$r = $this->general->get_table('evaluation as e', array('e.id' => $all_post->id), 'e.created_at, e.expired_at, (SELECT COUNT(1) FROM evaluation_authorize where evaluation_id = e.id group by evaluation_id) as "authorize", (SELECT COUNT(1) FROM evaluation_authorize where evaluation_id = e.id and evaluated = 1 group by evaluation_id) as "evaluated"');
		echo json_encode($r->row());
	}

	// ANDROID APIS
	// ANDROID APIS

	function w(){
		echo $_POST['a'];
	}

	function retrieve_account(){
		$all_post = $this->general->all_post();

		$res = $this->general->get_table('users', array('id' => $all_post->id, 'token' => $all_post->token), 'id');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'success', 'message' => 'user has found')));
		}
		exit(json_encode(array('status' => 'error', 'message' => 'user not found')));
	}

	function login_qr(){
		$all_post = $this->general->all_post();

		$res = $this->general->get_table('users', array('token' => $all_post->token), 'id');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'success', 'message' => 'user has found')));
		}
		exit(json_encode(array('status' => 'error', 'message' => 'user not found')));
	}
	function login_manual(){
		$all_post = $this->general->all_post();

		$this->db->where('username', $all_post->id);
		$this->db->or_where('phone', $all_post->id);
		$this->db->where('password', base64_encode(base64_encode($all_post->password)));
		$res = $this->general->get_table('users', '', 'id');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'success', 'message' => 'user has found')));
		}
		exit(json_encode(array('status' => 'error', 'message' => 'user not found')));
	}

	function register(){
		$all_post = $this->general->all_post();
	
	
		$fv = $this->form_validation;

		$fv->set_rules('username', 'username', 'required');
		$fv->set_rules('password', 'password', 'required');
		$fv->set_rules('name', 'name', 'required');
		$fv->set_rules('email', 'email', 'required');
		$fv->set_rules('phone', 'phone', 'required');

		
		if($fv->run() == TRUE){

			// IF EMAIL IS NOT VALID
			if (filter_var($all_post->email, FILTER_VALIDATE_EMAIL) === false) {
				exit(json_encode(array('status' => 'error', 'message' => 'Invalid Email')));
			}

			// IF EMAIL IS TAKEN
			$res = $this->general->get_table('users', array('email' => $all_post->email), 'id');
			if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Email Already Taken')));
			}

			// IF USERNAME IS TAKEN
			$res = $this->general->get_table('users', array('username' => $all_post->username), 'id');
			if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Username Already Taken')));
			}

			// VALIDATE IF NUMBER IS TRUE
			if(strlen($all_post->number) != 13){
				exit(json_encode(array('status' => 'error', 'message' => 'Invalid Phone Number')));
			}

			// IF NUMBER IS TAKEN
			$res = $this->general->get_table('users', array('phone' => $all_post->phone), 'id');
			if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Phone Already Taken')));
			}

			// MIN OF 8 CHARACTER FOR PASSWORD
			if(strlen($all_post->password) < 8){
				exit(json_encode(array('status' => 'error', 'message' => 'Weak password')));
			}


			$code = substr (uniqid(), 5, 5);
			$insert_data = array(
								'category' => 'uncategorized',
								'username' => $all_post->username,
								'password' => base64_encode(base64_encode($all_post->password)),
								'name' => $all_post->name,
								'guid' =>  2,
								'email' => $all_post->email,
								'phone' => $all_post->phone,
								'created_at' => $this->general->datetime,
								'verification_code' => $code
								);
			$this->general->insert_table('users', $insert_data);

			$var = $this->general->send_sms($all_post->number, $code);

			exit(json_encode(array('status' => 'success', 'message' => 'Successfully Registered')));

		}
		else{
			exit(json_encode(array('status' => 'error', 'message' => 'please input blank fields')));
		}
	}
	function edit_profile(){
		$all_post = $this->general->all_post();
		

		$update = array();
		// IF EMAIL IS NOT VALID
		if(isset($all_post->email) && $all_post->email != ''){
			if (filter_var($all_post->email, FILTER_VALIDATE_EMAIL) === false) {
				exit(json_encode(array('status' => 'error', 'message' => 'Invalid Email')));
			}

			// IF EMAIL IS TAKEN
			$this->db->where('token !=', $all_post->token);
			$res = $this->general->get_table('users', array('email' => $all_post->email), 'id');
			if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Email Already Taken')));
			}

			$update = $update + array('email' => $all_post->email);
		}
		

		if(isset($all_post->username) && $all_post->username != ''){
	    	// IF USERNAME IS TAKEN
	    	$this->db->where('token !=', $all_post->token);
			$res = $this->general->get_table('users', array('username' => $all_post->username), 'id');
				if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Username Already Taken')));
			}
			$update = $update + array('username' => $all_post->username);
		}


		if(isset($all_post->phone) & $all_post->phone != ''){
			// VALIDATE IF NUMBER IS TRUE
			if(strlen($all_post->phone) != 13){
				exit(json_encode(array('status' => 'error', 'message' => 'Invalid Phone Number')));
			}

		// IF NUMBER IS TAKEN
			$this->db->where('token !=', $all_post->token);
			$res = $this->general->get_table('users', array('phone' => $all_post->phone), 'id');
			if ($res->num_rows() > 0) {
				exit(json_encode(array('status' => 'error', 'message' => 'Phone Already Taken')));
			}
			$update = $update + array('phone' => $all_post->phone);

		}

		if(isset($all_post->name) & $all_post->name != ''){

			$update = $update + array('name'=> $all_post->name);
		}

		if(isset($all_post->password) && $all_post->password != ''){
			// MIN OF 8 CHARACTER FOR PASSWORD
			if(strlen($all_post->password) < 8){
				exit(json_encode(array('status' => 'error', 'message' => 'Weak password')));
			}
			$update = $update + array('password' => base64_encode(base64_encode($all_post->password)));
		}


		$this->general->update_table('users', array('token' => $all_post->token) , $update);

		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Updated')));
		
	}

	function evaluation_authorize(){

		$all_post = $this->general->all_post();

		$this->db->where('u.token', $all_post->id);
		$this->db->where('ea.evaluation_id', $all_post->evaluationID);
		$this->db->join('users as u', 'u.id = ea.evaluator_id');
		$res = $this->general->get_table('evaluation_authorize as ea', '', 'id');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'success', 'message' => 'user is authorize')));
		}
		exit(json_encode(array('status' => 'error', 'message' => 'is not authorize')));
	}

	function evaluation_info(){

		$all_post = $this->general->all_post();

		$this->db->where('e.id', $all_post->evaluationID);
		$this->db->join('users as u', 'u.id = e.uid', 'inner');
		$res = $this->general->get_table('evaluation as e', '', 'e.title, e.description, e.category, u.name, (SELECT SUM(rate) / COUNT(1) from evaluation_ratings where evaluation_ratings.evaluation_id = e.id) as ratings');

		if($res->num_rows() > 0){
			exit(json_encode(array('status' => 'success', 'message' => 'user is authorize', 'data' => $res->result())));
		}
		exit(json_encode(array('status' => 'error', 'message' => 'is not authorize')));
	}

	function evaluation_download(){

		$all_post = $this->general->all_post();
		$this->db->where('e.id', $all_post->evaluationID);
		$res = $this->general->get_table('evaluation_attachment','','name');

		if($res->num_rows() < 0){
			exit(json_encode(array('status' => 'error', 'message' => 'invalid evaluation id')));
		}

		$files = array();
		foreach ($res->result() as $vals) {
			array_push($files, site_url().'/assets/attachments/'.$all_post->evaluationID.'/'.$vals->name);
		}

		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Retrieve file', 'data' => $files)));

	}

	function evaluation_question(){


		$all_post = $this->general->all_post();
		$this->db->where('u.token', $all_post->token);
		$this->db->where('ea.evaluation_id', $all_post->evaluationID);
		$this->db->join('users as u', 'u.id = ea.evaluator_id', 'inner');
		$res = $this->general->get_table('evaluation_authorize as ea','','ea.evaluated');

		if($res->num_rows() < 0){
			exit(json_encode(array('status' => 'error', 'message' => 'invalid token')));
		}

		if($res->row()->evaluated == 1){
			exit(json_encode(array('status' => 'error', 'message' => 'you already evaluated')));
		}

		$this->db->join('question as q', 'q.id = qe.question_id');
		$res = $this->general->get_table('question_evaluation as qe', array('qe.evaluation_id', $all_post->evaluationID), 'q.question, q.type, qe.id');
		$i = 0;
		foreach ($res->result() as $vals) {
			$data[]['question_id'] = $vals->id;
			$data[]['question'] = $vals->question;
			$data[]['type'] = $vals->type;

			$answers = $this->general->get_table('question_choices', array('question_eval_id' => $vals->id), 'text');
			$question = array();
			foreach ($answers->result() as $val) {
				array_push($question, array('text' => $val->text, 'id' => $val->id));
			}
			$data[]["answers"] = $question;
			$i++;
		}

		exit(json_encode(array('status' => 'success', 'message' => 'Successfully Retireve', 'data' => $data)));


	}





	// ANDROID APIS
	// ANDROID APIS
	
}