<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */

   //you also need the constructor
  //  function __construct(){
  //      parent::__construct();
  //  }

  /**
   * default gallery homepage
   */
  public function index()
  {
    $albumData = $this->album_model->first();
    $id = $albumData->id;
    $this->gallery_model->_orderby = "album.created_at DESC";
    $this->gallery_model->set_album_id($id);
    $gallery = $this->gallery_model->get_all_galleries(array('type' => 'public'));
    $galleries = array();
    foreach($gallery as $key => $value) {
      if (file_exists(UPLOAD_LOCALPATH . $value['filename'])) {
        $galleries[] = array('filename' => base_url() . UPLOAD_LOCALPATH . $value['filename'], 'title' => $value['title']);
      }
    }

    $album = $this->album_model->get_all_album(array('type' => 'public') );
    $this->data['album'] = $album;
    $this->data['photo'] = $galleries;
    $this->load->view('home', $this->data);
  }

  /**
   * View the album by id
   */
  public function view_album($id)
  {
    $this->gallery_model->_orderby = "album.created_at DESC";
    $this->gallery_model->set_album_id($id);
    $gallery = $this->gallery_model->get_all_galleries(array('type' => 'public'));
    $galleries = array();
    foreach($gallery as $key => $value) {
      if (file_exists(UPLOAD_LOCALPATH . $value['filename'])) {
        $galleries[] = array('filename' => base_url() . UPLOAD_LOCALPATH . $value['filename'], 'title' => $value['title']);
      }
    }

    $album = $this->album_model->get_all_album(array('type' => 'public') );

    $this->data['album_title'] = $this->album_model->find_by_id($id);
    $this->data['album_owner'] = $this->album_model->get_album_user($id);
    $this->data['album'] = $album;
    $this->data['photo'] = $galleries;
    $this->load->view('view_album', $this->data);
  }
}
