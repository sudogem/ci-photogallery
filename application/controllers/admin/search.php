<?php

class Search extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library( 'form_validation' );
    $this->data['search_active'] = 'active' ;
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ( ! $this->session->userdata('login') || !is_admin()) redirect(ACCOUNT_SIGNIN_PATH);
  }

  function index() 
  {
    $searchopts = array('q' => '', 'limit' => '', 'offset' => 0, 'searchby' => '');
    $this->session->unset_userdata($searchopts);
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/search',$this->data);
    $this->load->view('admin/footer');
  }

  function results()
  {
    if ($_POST) {
      $q = $this->input->post('q', '');
      $searchby = $this->input->post('searchby');
      $limit  = 2;
      $offset = 2;
      $searchopts = array('q' => $q, 'limit' => $limit, 'offset' => $offset, 'searchby' => $searchby);
      $this->session->set_userdata($searchopts);
    }

    $userdata = $this->session->all_userdata();
    if ($userdata['searchby'] == 'user') {
      $this->data['q'] = $userdata['q'];
      $params = array('search_keyword' => $this->data['q']);
      $result = $this->user_model->get_all($params);
      $this->data['results'] = $result['data'];
      $this->data['pagination'] = $result['pagination'];
      $tpl = $this->load->view('admin/_search_user', $this->data, true);
      $this->data['tpl'] = $tpl;
    }

    if ($userdata['searchby'] == 'album') {
      $this->data['q'] = $userdata['q'];
      $params = array('search_keyword' => $this->data['q'], 'is_paginate' => true, 'base_url' => site_url("admin/search/results"));
      $result = $this->album_model->get_all_album($params);
      $this->data['results'] = $result['data'];
      $this->data['pagination'] = $result['pagination'];
      $tpl = $this->load->view('admin/_search_album', $this->data, true);
      $this->data['tpl'] = $tpl;
    }

    $this->load->view('admin/header', $this->data);
    $this->load->view('admin/searchresults', $this->data);
    $this->load->view('admin/footer');
  }
}
