<?php

class Login extends CI_Controller {

	function index()
	{
		$flash = $this->session->flashdata('flash');
		$this->data['flash'] = '<div class="error flash"><a href="javascript:" id="closeme" class="cmdclose" style="float:right" >close</a><h3>There were problems with the following fields:</h3>'. $flash . '</div><br />' ;
		if ( $this->input->post( 'login' ) )
		{
			$auth_result = $this->user_model->auth($this->input->post('username'), $this->input->post('password'));
			if($auth_result) {
				redirect('admin/user');
			}
			else {
				$this->session->set_flashdata( 'flash', 'Invalid username/password' );
				redirect('admin/login');
			}			
			// $this->db->where( array( 'username' => $_POST['username'], 'password' => $_POST['password'] ) );
			// $res = $this->db->get('user');
	
			// if ( $res->num_rows() > 0 )
			// {	
				// $row = $res->result();
				// if ( $row[0]->user_level == 'Administrator' )
				// {
						// $data = array( 'login' => TRUE, 'username' => $_POST['username'], 'isadmin' => TRUE ) ;
						// $this->session->set_userdata( $data );
						// redirect('admin/user');
				// }
			// }
			// else
			// {
				// $this->session->set_flashdata( 'flash', 'Invalid username/password' );
				// redirect('admin/login');
			// }
		}
		else
		{

			$this->load->view('login', $this->data );

		}
	}
}
 