<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Model
{
	public $api_id 		= '23546756523435436546';
	public $api_secret 	= 'AS324DFj25ihGUJYHFGUY47237BNHSG5454VCSS';
	public $session_front;

	function __construct()
	{
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->datetime		= date('Y-m-d H:i:s');

		$this->session_front	= $this->session->userdata('session_login_front');
		$this->session_uid		= $this->session->userdata('session_uid');

		$this->tempname 		= 'ui';

		$this->template 		= $this->tempname.DS.'template';
		$this->template_login 	= $this->tempname.DS.'login';
		
		if(!defined('THEME')){
			define('THEME', TEMP.$this->tempname.'/');
		}

		if($this->session_front)
		{
			if(!$this->active_user()->uid)
			{
				$message = '<strong>Akun Anda telah dihapus oleh system</strong>'.br(2).'Silahkan hubungi Administrator untuk masalah ini.';
				$logged_out = TRUE;
			}

			if($this->active_user()->active == 'n')
			{
				$this->update_table('user', array('uid' => $this->session_uid), array('logged' => 'n'));
				$message = '<strong>Akun Anda telah diblok oleh system</strong>'.br(2).'Silahkan hubungi Administrator untuk masalah ini.';

				$logged_out = TRUE;
			}

			if($logged_out)
			{
				$this->no_cache();
				
				$sess_arr = array('session_login_front', 'session_uid');

				$this->session->unset_userdata($sess_arr);
				$this->session->set_flashdata('msg_error', $message);
				redirect('login');
			}
		}
	}

	function get_config()
	{
		return $this->get_table('config')->row();
	}

	public function viewdata()
	{
		$viewdata = array(
							'site_name' => 'Dewa VIP',
							'admin_domain' => 'adm.dewavip.dev',
							'site_domain' => 'dewavip.dev',
							'protocol' => ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://",
							'data_user' => $this->active_user(),
							'controller' => $this->uri->segment(1),

							'mod_notif' => ($this->general->mod_access('message') || $this->general->mod_access('transaction', 'alter')) ? TRUE : FALSE,

							'tempname' => $this->tempname
						  );
		
		return $viewdata;
	}

	function generate_qr(){
				$this->load->library('ciqrcode');
				$params['data'] = 'This is a text to encode become QR Code';
				$this->ciqrcode->generate($params);
	}
	function active_user()
	{
		if(!$this->session_uid)
		{
			return FALSE;
		}
		
		$this->db->select('user.*, user_group.gname, user_group.role');
		$this->db->where('user.uid', $this->session_uid);
		$this->db->join('user_group', 'user_group.guid = user.guid');
		$data_user = $this->db->get('user')->row();

		$data_user->usn_name = strtoupper($data_user->usn_name);

		return $data_user;
	}

	function set_phone_number($phone = '')
	{
		if(!$phone)
		{
			return FALSE;
		}

		if($phone && substr($phone, 0, 3) == '620')
		{
			$phone = substr_replace($phone, '0', 0, 3);
		}

		if($phone && substr($phone, 0, 1) == 0)
		{
			$phone = substr_replace($phone, '62', 0, 1);
		}

		return $phone;
	}

	function clear_permalink($permalink = '')
	{
		if(!$permalink)
		{
			return FALSE;
		}

		$search = array('http://', 'https://', 'www.', $this->viewdata()['site_domain']);
		$replace = array('', '', '', '');

		return rtrim(str_replace($search, $replace, $permalink),'.');
	}

	function set_subdomain($param = '')
	{
		if(!$param)
		{
			return FALSE;
		}

		return $this->viewdata()['protocol'].url_title($param,'',TRUE).'.'.$this->viewdata()['site_domain'].'/';
	}

	function paging_config()
	{
		$config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pull-right"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';

		$config['first_tag_open'] = '<li>';
		$config['first_link'] = '<i class="fa fa-angle-double-left icon-only"></i>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right icon-only"></i>';
		$config['last_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '<i class="fa fa-angle-left icon-only"></i>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '<i class="fa fa-angle-right icon-only"></i>';
		$config['next_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';

		return $config;
	}

	function no_cache()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}
	
	function check_loggedin($message = '')
	{						 
		if( $this->session_front == FALSE )
		{
			$this->no_cache();
			if($message)
			{
				$this->session->set_flashdata('msg_error', $message);	
			}
			
			redirect('login');
		}
	}

	function check_ajax_loggedin($url = '')
	{
		if( $this->session_front == FALSE )
		{
			$this->session->set_flashdata('msg_error', 'Silahkan login terlebih dahulu!');
			
			if($url)
			{
				$json['callback'] = ($url);	
			}
			
			$json['not_loggedin'] = TRUE;
			$data = json_encode($json);
			return $this->general->__gzip($data);
		}
	}

	function check_permalink($permalink = NULL, $view = FALSE)
	{
		if($permalink)
		{
			if(	strpos($permalink, 'https://') === FALSE)
			{
				$permalink = 'http://'.str_replace('http://', '', $permalink);
			}
			
			if(	$view )
			{
				$permalink = str_replace('http://', '', $permalink);
			}
		}

		return $permalink;
	}
	
	function general_message()
	{
		$msg = NULL;
		if($this->session->flashdata('general_error')){
			$msg = '<div class="alert alert-danger general-msg">'.$this->session->flashdata('general_error').'</div>';
		}
		if($this->session->flashdata('general_success')){
			$msg = '<div class="alert alert-success general-msg">'.$this->session->flashdata('general_success').'</div>';
		}
		if($this->session->flashdata('general_info')){
			$msg = '<div class="alert alert-info general-msg">'.$this->session->flashdata('general_info').'</div>';
		}
		
		return $msg;
	}
	
	function flash_message()
	{
		$msg = NULL;
		if($this->session->flashdata('msg_error')){
			$msg = '<div class="alert alert-danger">'.$this->session->flashdata('msg_error').'</div>';
		}
		if($this->session->flashdata('msg_success')){
			$msg = '<div class="alert alert-success">'.$this->session->flashdata('msg_success').'</div>';
		}
		if($this->session->flashdata('msg_info')){
			$msg = '<div class="alert alert-info">'.$this->session->flashdata('msg_info').'</div>';
		}
		
		return $msg;
	}

	function all_post()
	{
		return (object) $this->input->post();
	}

	function all_get()
	{
		return (object) $this->input->get();
	}

	public function __gzip($data = '')
	{
		$offset = 60 * 60;
		$expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
		header('HTTP/1.0 200 OK');
		header('HTTP/1.1 200 OK');
		header('Server: EUIS GEULIS');
		header('Content-Encoding: gz');
		header("Content-Type: application/json; charset=utf-8");
		header("Cache-Control: private, no-cache, no-store, must-revalidate");
		header( $expire );
		header('Vary: Accept-Encoding');
		header('Pragma: no-cache');
		echo trim($data);
	}

	function published($enum = 'y')
	{
		if($enum == 'y')
		{
			$temp = '<span class="publish success"><i class="fa fa-check"></i> Yes</span>';
		}
		else
		if($enum == 'n')
		{
			$temp = '<span class="publish error"><i class="fa fa-close"></i> No</span>';
		}
		else
		{
			$temp = '<i class="fa fa-ellipsis-h"></i> Unknown';
		}

		return $temp;
	}

	function locked($enum = 'y')
	{
		if($enum == 'open')
		{
			$temp = '<span class="publish success"><i class="fa fa-unlock-alt"></i> Open</span>';
		}
		else
		if($enum == 'close')
		{
			$temp = '<span class="publish error"><i class="fa fa-lock"></i> Close</span>';
		}
		else
		{
			$temp = '<i class="fa fa-ellipsis-h"></i> Unknown';
		}

		return $temp;
	}

	function set_subject_message($subject = '')
	{
		$this->config->load('message_subject');
		$allowed_subject = $this->config->item('data_subject');

		$subject = $allowed_subject[$subject];

		if($subject == NULL)
		{
			return 'Others';
		}

		return $subject;
	}


	/*
	 * General CRUD
	 */
	
	function get_table($table, $where = '', $select = '', $option = '')
	{
		if($select)
		{
			$this->db->select($select);	
		}
		if($where)
		{
			$this->db->where($where);	
		}
		$option;
		return $this->db->get($table);	
	}

	function insert_table($table, $data)
	{
		return $this->db->insert($table, $data);	
	}
	
	function update_table($table, $where, $data)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);	
	}
	
	function delete_table($table, $where)
	{
		$this->db->where($where);
		return $this->db->delete($table);	
	}



	// Access Level
	function get_module($where = '')
	{
		if($where)
		{
			$this->db->where($where);	
		}
		$this->db->order_by('mod_order', 'asc');
		return $this->db->get('module');
	}

	function get_modid($alias)
	{
		$get_module = $this->get_module(array('mod_alias' => $alias))->row();

		if(!$get_module->modid)
		{
			return show_404();
		}

		return $get_module->modid;
	}

	function list_module_showed($modid = 0)
	{
		$get_module = $this->get_module(array('parent_id' => $modid, 'published' => 'y'), 'mod_alias');

		$count_showed = 0;
		if($get_module->num_rows() > 0)
		{
			foreach($get_module->result() as $val)
			{
				if($this->mod_access($val->mod_alias) == TRUE)
				{
					$count_showed = $count_showed + 1;
				}
			}
		}

		return $count_showed;
	}

	function list_module($parent_id = 0, $modid = '')
	{
		$get_module = $this->get_module(array('parent_id' => $parent_id, 'published' => 'y'));
		$template   = NULL;
		
		$controller = $this->uri->segment(1);

		if($parent_id == 0)
		{
			$template .= '<ul id="side" class="nav navbar-nav side-nav">';

			if(!$controller)
			{
				$active = 'class="active"';
			}

			$template .= '<li>'.anchor('', 'Dashboard</a>', $active).'</li>';
		}
		else
		{
			$template .= '<ul class="collapse nav" id="components" data-modid="'.$modid.'">';
		}

		if($get_module->num_rows())
		{
			foreach($get_module->result() as $val)
			{
				$active 	= NULL;
				$get_sub_module = $this->get_module(array('parent_id' => $val->modid));

				$count_showed = $this->list_module_showed($val->modid);

				$template .= ($get_sub_module->num_rows() > 0 && $count_showed > 0) ? '<li>' : NULL;

				if($get_sub_module->num_rows() > 0 && $count_showed > 0 && $val->parent_id == 0)
				{
					if($val->permalink)
					{
						$template .= anchor($val->permalink, '<i class="'.$val->icon.'"></i> '.$val->mod_name, $active);
					}
					else
					{
						$template .= '<span>'.$val->mod_name.'</span>';
					}
				}

				if($this->mod_access($val->mod_alias) == TRUE)
				{
					if($get_sub_module->num_rows() == 0)
					{
						if($modid == $val->modid)
						{
							$active = ' class="active"';
						}
						$template .= '<li>';	
					}
					else
					{
						if($modid == $val->modid)
						{
							$active = ' active';
						}
						$template .= '<li class="panel">';	
					}
					
					$template .= anchor($val->permalink, '<i class="'.$val->icon.'"></i> '.$val->mod_name, $active);
					
					$template .= '</li>';
				}

				if($get_sub_module->num_rows() > 0)
				{
					$template .= $this->list_module($val->modid, $modid);
				}

				$template .= ($get_sub_module->num_rows() > 0 && $count_showed > 0) ? '</li>' : NULL;
			}
		}

		$template .= '</ul>';

		return $template;
	}

	function role_mod($role = 'view')
	{
		$data_user = $this->active_user();

		$roles = json_decode($data_user->role);

		switch($role)
		{
			case 'create':
				$role = explode(',', $roles->create);
			break;
			case 'alter':
				$role = explode(',', $roles->alter);
			break;
			case 'drop':
				$role = explode(',', $roles->drop);
			break;
			default:
				$role = explode(',', $roles->view);
		}

		foreach($role as $val)
		{
			$get_mod = $this->get_table('module', array('modid' => $val), 'mod_alias' );

			if($get_mod->num_rows() == 1)
			{
				$role_mod[$val] = $get_mod->row()->mod_alias;
			}
		}

		return $role_mod;
	}

	function mod_access($alias = '', $role = 'view')
	{
		$access = FALSE;
		$role_mod = $this->role_mod($role);

		if(is_array($role_mod) && in_array($alias, $role_mod))
		{
			$access = TRUE;
		}

		return $access;
	}

	function blocked_page($alias = '', $role = 'view')
	{
		if(!$alias)
		{
			return show_404();
		}

		if($this->mod_access($alias, $role) == FALSE )
		{
			return show_error("You don't have permission to access this page.", 403, 'Forbidden');
		}
	}

	function account_balance($uid = '')
	{
		$optional = ($uid) ? $this->db->where(array('uid' => $uid)) : NULL;
		$this->db->where_in('status', array('confirmed', 'manual'));
		$total_balance = $this->general->get_table('deposit', '', 'SUM(balance) AS grand_total')->row()->grand_total;
		
		$optional = ($uid) ? $this->db->where(array('uid' => $uid)) : NULL;
		$this->db->where_not_in('status', array('cancelled'));
		$total_transaction = $this->general->get_table('withdraw', '', 'SUM(amount) AS grand_total')->row()->grand_total;

		$optional = ($uid) ? $this->db->where(array('uid' => $uid)) : NULL;
		$this->db->where_not_in('status', array('cancelled'));
		$total_transfer_out = $this->general->get_table('transfer', array('game_to!=' => 'DewaVIP'), 'SUM(amount) AS grand_total')->row()->grand_total;

		$optional = ($uid) ? $this->db->where(array('uid' => $uid)) : NULL;
		$this->db->where_in('status', array('transfered', 'manual'));
		$total_transfer_in = $this->general->get_table('transfer', array('game_to' => 'DewaVIP'), 'SUM(amount) AS grand_total')->row()->grand_total;

		return ($total_balance+$total_transfer_in) - ($total_transaction + $total_transfer_out);
	}
	

	function points_balance($uid = '', $current =''){


			$this->db->group_by('uid');
			$this->db->where('uid', $uid);
			$accumulated_points = $this->general->get_table('points as p', '', 'SUM(p.points) as "points"')->row()->points;

			$this->db->group_by('uid');
			$this->db->where_in('status', array('approved', 'manual'));
			$used_points = $this->general->get_table('points_transaction',array('uid' => $uid), 'SUM(points_spent) as "points"')->row()->points;


			$this->db->group_by('uid');
			$this->db->where_in('status', 'pending');
			$pending = $this->general->get_table('points_transaction',array('uid' => $uid), 'SUM(grand_total) as "points"')->row()->points;

			if($current == 'y'){
				$total = ($accumulated_points - (($used_points ? $used_points : 0)));
			}
			else{
				$total = ($accumulated_points - (($used_points ? $used_points : 0) + ($pending ? $pending : 0)));
			}
			return $total;

	}


	function insert_log($type = '', $uid = '', $value = '')
	{
		$table_name = 'z_admin_log';
		if($type)
		{
			$uid = ($uid) ? $uid : $this->session_uid;
			
			$replace_log = array('login', 'logout');

			if(in_array($type, $replace_log))
			{
				$this->delete_table($table_name, array('type' => $type, 'uid' => $uid));
			}

			$insert_data = array(
				'uid' => $uid,
				'ip_address' => $this->input->ip_address(),
				'type' => $type,
				'value' => ($value) ? $value : NULL,
				'created' => $this->datetime
			);
			return $this->insert_table($table_name, $insert_data);
		}
	}

	function get_trans_session($trans_id = '', $json = FALSE)
	{
		if(!$trans_id)
		{
			return FALSE;
		}

		$this->db->where('trans_id', $trans_id);
		$get_session = $this->get_table('transaction', '', 'trans_session');

		if($get_session->num_rows() != 1)
		{
			return FALSE;
		}

		$trans_session = $get_session->row()->trans_session;

		return ($json) ? $trans_session : json_decode($trans_session);
	}
	
	public $twilio_sid 		= 'AC7a946b24767bbfb0923bb95d948539ed';
	public $twilio_token 	= '06c3e358b396b82a01d16dc58e57ceab';

	function send_sms($data = array())
	{
		if(!is_array($data))
		{
			return 'Please insert data with Array!';
		}

		$data = array_push_multidimension(array('From' => '+12019772096'), $data);

		$url = 'https://api.twilio.com/2010-04-01/Accounts/'.$this->twilio_sid.'/Messages.json';

		$post = http_build_query($data);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "$this->twilio_sid:$this->twilio_token");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		$curl_data = json_decode(curl_exec($curl));
		curl_close($curl);

		if($curl_data->code)
		{
			return $curl_data->message;
		}
	}
}