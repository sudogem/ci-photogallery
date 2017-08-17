<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	var $user_id;
	var $username;
	var $password;
	var $first_name;
	var $last_name;
	var $display_name;
	var $user_status;
	var $email_address;
	var $user_level;
	var $nosubscribers;

	var $page;
	var $limit;
	var $numpages;
	var $paginate;
	var $_where;
	var $_select;

	function __construct() {
		parent::__construct();
    $this->t_user = 'users' ;
    $this->per_page = $this->config->item('per_page');
    $this->data = array();
	}

	/**
	 * Get all the users
	 */
  function get_all($param) {
  	$base_url = !empty($param['base_url']) ? $param['base_url'] : site_url("admin/user/searchresults/");
		$config['base_url'] = $base_url;
		$config['total_rows'] =  $this->get_user_count();
		$config['per_page'] = $this->per_page ;
		$config['uri_segment'] = 4 ;

 		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$cur_offset = ( $this->uri->segment( $config['uri_segment'] ) != '' ) ? (int)$this->uri->segment( $config['uri_segment'] ) : 0 ;
		$tmpcur_offset = (empty($cur_offset)) ? 0 : $config['per_page'];
		$u = ($config['per_page'] * $cur_offset) - $tmpcur_offset;

		$q = $this->session->userdata('q');
		if (!empty($q)) {
			$this->db->like('first_name', $q);
			$this->db->or_like('last_name', $q);
		}
		$this->db->limit($this->per_page, $u);
    $query = $this->db->get($this->t_user);
    if ($query->result()) {
      return array('data' => $query->result_array(), 'pagination' => $pagination);
    }
    else {
      return FALSE;
    }
  }

  public function get_user_count()
  {
		$q = $this->session->userdata('q');
		if (!empty($q)) {
			$this->db->like('first_name', $q);
			$this->db->or_like('last_name', $q);
		}
    $query = $this->db->get( $this->t_user );
    return $query->num_rows();
  }

	function edit()
	{
		$this->data->username = $this->input->post('username');
		$this->data->first_name = $this->input->post('firstname');
		$this->data->last_name = $this->input->post('lastname');
		$this->data->password = $this->input->post('password');
		$this->db->where( array('id' => $this->input->post('id')));
		$this->db->update( $this->t_user , $this->data);
	}

	function save() {

		$db_array = array(
		'username'				=>	$this->input->post('username'),
		'first_name'			=>	$this->input->post('firstname'),
		'last_name'				=>	$this->input->post('lastname'),
		'password'				=>	$this->input->post('password'),
		'user_level'			=>	$this->input->post('user_level'),
		);

		if ($this->user_id) {
			$this->db->where('id', $this->user_id);
			$db_array['updated_at'] = date("Y-m-d");
			$this->db->update($this->t_user, $db_array);
		}
		else {
			$db_array['created_at'] = date("Y-m-d");
			$this->db->insert($this->t_user, $db_array);
		}
	}

	function delete() {
		$this->db->where('id', $this->user_id);
		$this->db->delete($this->t_user);
	}

	function _prep_query() {
		// this function should only contain anything needed by the query that collects all results for pagination numbers
		if ($this->user_id) {
			$this->db->where('id', $this->user_id);
		}

		if ($this->username AND $this->password) {
			$this->db->where('username', $this->username);
			$this->db->where('password', $this->password);
		}

		if ($this->username) {
			$this->db->where('username', $this->username);
		}

		if ($this->_where) {
			$this->db->where($this->_where) ;
		}

		if ($this->_select) {
			$this->db->select($this->_select) ;
		}
		$this->db->order_by('user_level, last_name, first_name');

	}

	function auth($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get($this->t_user);

		if ($query->num_rows()) {
			$return = $query->row();
			$row = $query->result();
			if ( $row[0]->user_level == 'Administrator' ) {
				$data = array( 'login' => TRUE, 'uid' => $row[0]->id, 'username' => $username, 'is_admin' => TRUE );
				$this->session->set_userdata( $data );
			} else {
				$data = array( 'login' => TRUE, 'uid' => $row[0]->id, 'username' => $username, 'is_admin' => FALSE );
				$this->session->set_userdata( $data );
			}
			return $data;
		}
		else {
			$return = FALSE;
		}
		return $return;
	}

	function is_username_exist($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->t_user);
		if ($query->num_rows()) return true;
		return false;
	}

	function check_admin() {
		// used from the admin controller to check if the user is admin?
		$this->db->where('user_level', 'Administrator');
		$this->db->where('id', $this->user_id);
		$query = $this->db->get($this->t_user);

		if ($query->num_rows()) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function get_by_group() {
		$user_groups = array();
		$user_levels = array(
		'Administrator',
		'Member'
		);

		foreach ($user_levels as $user_level) {
			$this->db->where('user_level', $user_level);
			$this->db->order_by('last_name, first_name');
			$query = $this->db->get($this->t_user);
			$user_groups[$user_level]['user_level'] = $user_level;
			$user_groups[$user_level]['users'] = $query->result();
		}

		return $user_groups;
	}

	function get_user()
	{
		$this->_prep_query();
		return $this->db->get($this->t_user)->result_array();
	}

	function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get( $this->t_user );
		if ($query->num_rows()) {
			$data = $query->row_array();
			$this->user_id = $data['id'];
			return $data ;
		}
	}
}
