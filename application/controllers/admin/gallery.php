<?php

class Gallery extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->data['gallery_active'] = 'active' ;

    $this->uploadpath = 'uploads/gallery/';
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ( ! $this->session->userdata('login') ) redirect(ACCOUNT_SIGNIN_PATH);
    $this->per_page = $this->config->item('per_page');
    $a = $this->album_model->get_all_album(array('order_by' => 'album_name asc'));
    $this->album = $a['data'];
    $this->album_id = $this->uri->segment(4);
    $this->album_data = $this->album_model->find_by_id($this->album_id);
  }

  function index()
  {
    $config['base_url'] = site_url("admin/gallery/index/");
    $config['total_rows'] =  $this->gallery_model->get_galleries_count();
    $config['per_page'] = $this->per_page ;
    $config['uri_segment'] = 4 ;
    $this->pagination->initialize($config);
    $this->data['pagination'] = $this->pagination->create_links();
    $cur_offset = ( $this->uri->segment( $config['uri_segment'] ) != '' ) ? (int)$this->uri->segment( $config['uri_segment'] ) : 0 ;
    $tmpcur_offset = (empty($cur_offset)) ? 0 : $config['per_page'];
    $u = ($config['per_page'] * $cur_offset) - $tmpcur_offset;
    $this->gallery_model->_limit = array( 0 => $this->per_page, 1 => $u );
    $this->gallery = $this->gallery_model->get_all_galleries();
    $this->data['flash'] = $this->session->flashdata( 'flash' );
    $this->data['gallery'] = $this->gallery;
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/gallery',$this->data);
    $this->load->view('admin/footer');
  }

  function album()
  {
    $config['base_url'] = site_url("admin/gallery/album/".$this->album_id);
    $this->gallery_model->set_album_id($this->album_id);
    $config['total_rows'] =  $this->gallery_model->get_galleries_count();
    $config['per_page'] = $this->per_page ;
    $config['uri_segment'] = 5 ;
    $this->pagination->initialize($config);
    $this->data['pagination'] = $this->pagination->create_links();
    $cur_offset = ( $this->uri->segment( $config['uri_segment'] ) != '' ) ? (int)$this->uri->segment( $config['uri_segment'] ) : 0 ;
    $tmpcur_offset = (empty($cur_offset)) ? 0 : $config['per_page'];
    $u = ($config['per_page'] * $cur_offset) - $tmpcur_offset;
    $this->gallery_model->_limit = array( 0 => $this->per_page, 1 => $u );
    $this->gallery = $this->gallery_model->get_all_galleries();
    $this->data['flash'] = $this->session->flashdata( 'flash' );
    $this->data['gallery'] = $this->gallery;
    $this->data['album_data'] = $this->album_data;
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/gallery',$this->data);
    $this->load->view('admin/footer');
  }

  function form_gallery($id = 0)
  {
    $postid = $this->input->post( 'id' );
    $id = ! empty( $postid ) ? $postid : $id ;
    $this->data['id'] = $id ;
    if ( $id != '' )
    {
      $data = $this->gallery_model->get_photo_by_id($id);
      $this->data['photos'] = $data ;

    }

    $a = $this->album_model->get_all_album(array('order_by' => 'album_name asc', 'is_paginate' => false));
    $this->album = $a['data'];
    $albums = array();
    foreach($this->album as $key => $val) {
      $albums[$val['id']] = $val['album_name'];
    }
    $this->data['albums'] = $albums;
    $this->form_validation->set_rules('title', 'title', 'required|trim');
    $this->form_validation->set_rules('album_id', 'album', 'required|trim');
    $this->form_validation->set_rules('userfile', 'photo', 'callback_checkphoto');
    if ( $this->form_validation->run() == FALSE )
    {
      $this->load->view('admin/header',$this->data);
      $this->load->view('admin/form_gallery',$this->data);
      $this->load->view('admin/footer');
    }
    else
    {
      $uploaddata = $this->_upload();
      if ( ! $uploaddata) {
        redirect($_SERVER['HTTP_REFERER']);
      } else {
        if ( ! empty($id) )
        {
          if (empty($uploaddata['error']) && ! empty($uploaddata['upload_data']['file_name']) ) $this->gallery_model->picture = $uploaddata['upload_data']['file_name'] ;
          $this->gallery_model->edit() ;
          $this->session->set_flashdata( 'flash', 'Successfully updated' );
        }
        else
        {
          if (empty($uploaddata['error']) && ! empty($uploaddata['upload_data']['file_name']) ) $this->gallery_model->picture = $uploaddata['upload_data']['file_name'] ;
          $this->gallery_model->add() ;
          $this->session->set_flashdata( 'flash', 'Successfully saved' );
        }
      }

      redirect(ADMIN_GALLERY_PATH);
    }
  }

  public function checkphoto()
  {
    $picture = $this->input->post('picture');
    $id = $this->input->post('id');
    if (empty($_FILES['userfile']['name']) && empty($id)) {
      $this->form_validation->set_message('checkphoto', 'Please upload a photo.');
      return false;
    } else {
      if ($_FILES['userfile']['name']) {
        if (!in_array($_FILES["userfile"]["type"], array('image/jpg', 'image/jpeg', 'image/gif', 'image/png', 'image/bmp'))) {
          $this->form_validation->set_message('checkphoto', 'Please upload a valid image format.');
          return false;
        }
      }
    }
    return true;
  }

  function form_delete( $id )
  {
    $this->session->set_flashdata( 'flash', 'Successfully deleted' );
    $this->gallery_model->delete($id) ;
    redirect(ADMIN_GALLERY_PATH);
  }

  function _upload()
  {
    $config['upload_path'] = UPLOAD_LOCALPATH ;
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = FALSE ;
    $this->load->library('upload', $config);
    if (!empty($_FILES['userfile']['name']))
    {
      if ( ! $this->upload->do_upload())
      {
        $this->session->set_flashdata( 'flash_error', $this->upload->display_errors());
        return FALSE;
      }
      else
      {
        $data = array('upload_data' => $this->upload->data());
        $this->session->set_flashdata('save_message', 'Successfully upload photo.' );
        return $data;
      }
    }
    return TRUE;
  }
}

