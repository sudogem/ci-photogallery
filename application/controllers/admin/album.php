<?php

class Album extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library( 'form_validation' );
    $this->data['album_active'] = 'active' ;
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ( ! $this->session->userdata('login') ) redirect(ACCOUNT_SIGNIN_PATH);
    $this->album = $this->album_model->get_all_album(
      array(
        'order_by' => 'album_name asc',
        'base_url' => site_url("admin/user/index/"
      )));
  }

  function index()
  {
    $searchopts = array('limit' => '', 'offset' => 0);
    $this->session->unset_userdata($searchopts);
    $this->album = $this->album_model->get_all_album(
      array(
        'is_paginate'   => true,
        'order_by'      => 'album_name asc',
        'base_url'      => site_url("admin/album/index/")
      )
    );
    $this->data['flash'] = $this->session->flashdata( 'flash' );
    $this->data['album'] = $this->album['data'];
    $this->data['pagination'] = $this->album['pagination'];
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/album',$this->data);
    $this->load->view('admin/footer');
  }

  function form_album()
  {
    $id = (int)$this->uri->segment(4);
    $postid = $this->input->post('id');
    $id = ! empty( $postid ) ? $postid : $id ;
    $this->data['id'] = $id ;
    if ( $id != '' )
    {
      $data = $this->album_model->find_by_id($id);
      $this->data['album'] = $data ;
    }

    $this->form_validation->set_rules('album_name', 'album name', 'required|trim');
    $this->form_validation->set_rules('album_desc', 'album description', 'required|trim');
    if ( $this->form_validation->run() == FALSE )
    {
      $this->load->view('admin/header',$this->data);
      $this->load->view('admin/form_album',$this->data);
      $this->load->view('admin/footer');
    }
    else
    {
      if ( ! empty($id) && $id > 0 )
      {
        $this->album_model->edit() ;
        $this->session->set_flashdata( 'flash', 'Successfully updated' );
      }
      else
      {
        $this->album_model->add() ;
        $this->session->set_flashdata( 'flash', 'Successfully saved' );
      }
      redirect(ADMIN_ALBUM_PATH);
    }
  }

  function form_delete()
  {
    $id = (int)$this->uri->segment(4);
    $this->album_model->delete($id);
    $this->session->set_flashdata( 'flash', 'Successfully deleted album' );
    redirect(ADMIN_ALBUM_PATH);
  }
}