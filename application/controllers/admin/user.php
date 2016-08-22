<?php

class User extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library( 'form_validation' );
    $this->data['user_active'] = 'active' ;
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ( ! $this->session->userdata('login') || !is_admin()) redirect(ACCOUNT_SIGNIN_PATH);
  }

  function index()
  {
    $this->data['flash'] = $this->session->flashdata( 'flash' );
    $searchopts = array('q' => '', 'limit' => '', 'offset' => 0);
    $this->session->unset_userdata($searchopts);
    $result = $this->user_model->get_all(array('base_url' => site_url("admin/user/index/")));
    $this->data['users'] = $result['data'];
    $this->data['pagination'] = $result['pagination'];
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/user',$this->data);
    $this->load->view('admin/footer');
  }

  function form_user()
  {
    $id = (int)$this->uri->segment(4);
    $postid = $this->input->post( 'id' );
    $id = ! empty( $postid ) ? $postid : $id ;
    $this->data['id'] = $id ;
    if ( $id != '' ) {
      $data = $this->user_model->get_by_id($id);
      $this->data['user'] = $data ;
    }

    $this->form_validation->set_rules('username', 'username', 'required|trim|callback_checkusername');
    $this->form_validation->set_rules('password', 'password', 'required|trim');
    $this->form_validation->set_rules('first_name', 'first name', 'required|trim');
    $this->form_validation->set_rules('last_name', 'last name', 'required|trim');
    $this->form_validation->set_rules('user_level', 'user level', 'required|trim');

    if ( $this->form_validation->run() == FALSE )
    {
      $this->load->view('admin/header',$this->data);
      $this->load->view('admin/form_user',$this->data);
      $this->load->view('admin/footer');
    } 
    else {
      $this->user_model->save();
      if ($this->user_model->isCreated) {
        $this->session->set_flashdata( 'flash', 'Successfully saved' );
      } else {
        $this->session->set_flashdata( 'flash', 'Successfully updated' );
      }
      redirect(ADMIN_USER_PATH);
    }

  }

  function checkusername()
  {
    $username = $this->input->post('username');
    $old_username = $this->input->post('old_username');
    if ($old_username != $username) {
      if ($this->user_model->is_username_exist(trim($username))) {
        $this->form_validation->set_message('checkusername', 'Username is already exist.');
        return false;
      }
      return true;      
    }
  }

  function searchresults()
  {
    if ($_POST) {
      $q = $this->input->post('q', '');
      $limit  = 2;
      $offset = 2;
      $searchopts = array('q' => $q, 'limit' => $limit, 'offset' => $offset);
      $this->session->set_userdata($searchopts);
    }
    $q = $this->session->userdata('q');
    $result = $this->user_model->get_all(array());
    $this->data['users'] = $result['data'];
    $this->data['flash'] = '';
    $this->data['pagination'] = $result['pagination'];
    $this->data['q'] = $q;
    $this->load->view('admin/header', $this->data);
    $this->load->view('admin/searchresults', $this->data);
    $this->load->view('admin/footer');
  }

  function form_delete($id)
  {
    $this->user_model->delete($id);
    $this->session->set_flashdata( 'flash', 'Successfully deleted user ' . $id );
    redirect(ADMIN_USER_PATH);
  }
}