<?php

class Account extends CI_Controller {

  function signin()
  {
    $flash = $this->session->flashdata('flash');
    $this->data['flash'] = '<div class="error flash"><a href="javascript:" id="closeme" class="cmdclose" style="float:right" >close</a><h3>There were problems with the following fields:</h3>'. $flash . '</div><br />' ;
    if ($_POST)
    {
      $auth_result = $this->user_model->auth($this->input->post('username'), $this->input->post('password'));
      if($auth_result) {
        redirect(ADMIN_ALBUM_PATH);
      }
      else {
        $this->session->set_flashdata( 'flash', 'Invalid username/password' );
        redirect(ACCOUNT_SIGNIN_PATH);
      }
    }
    else
    {
      $this->load->view('login', $this->data );
    }
  }

  /**
   * When signing-out, we set the session data into NULL
   */
  function signout()
  {
    $data = array( 'id' => NULL, 'login' => NULL, 'username' => NULL ) ;
    $this->session->unset_userdata( $data );
    $this->session->sess_destroy();
    redirect('home');
  }
}