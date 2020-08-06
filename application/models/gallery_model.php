<?php

class Gallery_model extends CI_Model
{

	var $picture = '';
	var $_limit;
	var $_select;
	var $_where;
	var $paginate;
	var $_orderby;

    function __construct()
    {
			// Call the Model constructor
			parent::__construct();
			$this->t_photo = 'photo' ;
			$this->t_album = 'album';
			$this->t_album_user = 'album_users';
			$this->uploadpath = './uploads/gallery/';
			$this->data = new stdClass ;
			$this->user_id = getuid();
			$this->album_id = null;
    }

    /**
     * Get all gallery with parameters
     */
    public function get_all_galleries($params=array())
    {
		// $this->_orderby = array('order_by' => 'updated_at asc');
		$this->_orderby = 'photo.updated_at desc';
			$this->_prep_query();
			$this->db->_protect_identifiers=false;
			$this->db->select("album.id as album_id, album.*, photo.id as id, photo.*");
    	if ($this->get_album_id()) {
    		$this->db->where("album.id", $this->get_album_id());
    	}
			$this->db->join($this->t_album, "album.id = photo.album_id");

			if (isset($params['type']) && $params['type'] == 'public') {
				$query = $this->db->get( $this->t_photo );
			} else {
				if (is_admin()) {
					$query = $this->db->get( $this->t_photo );
				} else {
					$this->db->join($this->t_album_user, sprintf("album_users.user_id=%d and album_users.album_id=album.id", $this->user_id));
					$query = $this->db->get( $this->t_photo );
				}
			}

			$data = $query->result_array();
			return $data ;
    }

    /**
     * Get photo info by id
     */
    public function get_photo_by_id($id)
    {
			$this->db->where('id', $id);
			$query = $this->db->get( $this->t_photo );
			$data = $query->row_array();
			return $data ;
    }

    public function get_galleries_count()
    {
	    $this->_prep_query();
	    $this->db->_protect_identifiers=false;
    	if ($this->get_album_id()) {
    		$this->db->where("album.id", $this->get_album_id());
    	}
	    if (is_admin()) {
				$this->db->join($this->t_album, "album.id = photo.album_id");
	    	$query  = $this->db->get( $this->t_photo ) ;
	    } else {
				$this->db->join($this->t_album, "album.id = photo.album_id");
				$this->db->join($this->t_album_user, sprintf("album_users.user_id=%d and album_users.album_id=album.id", $this->user_id));
				$query  = $this->db->get( $this->t_photo ) ;
	    }
	    return $query->num_rows();
    }

    public function get_album_id()
    {
    	return $this->album_id;
    }

    public function set_album_id($id)
    {
    	$this->album_id = $id;
    }

    public function add()
    {
			$this->data->title   				= $this->input->post('title');
			$this->data->album_id				= $this->input->post('album_id');
			$this->data->filename				= $this->picture ;
			$this->data->created_at			= date("Y-m-d") ;
			$this->data->updated_at			= date("Y-m-d") ;
			$this->db->insert( $this->t_photo, $this->data);
    }

    public function edit()
    {
			$this->data->title   			= $this->input->post('title');
			$this->data->filename			= ! empty($this->picture) ? $this->picture : $this->input->post('picture');
			$this->data->album_id			= $this->input->post('album_id');
			$this->data->updated_at		= date("Y-m-d") ;
			$this->db->where( array('id' => $this->input->post('id')));
			$this->db->update( $this->t_photo , $this->data );
    }

    public function delete($id)
    {
			$data = $this->get_photo_by_id($id);
			$this->delete_pic($data['filename']) ;
			$this->db->delete($this->t_photo , array('id' => $id));
    }

    public function delete_by_album($id)
    {
			$this->db->where( array('album_id' => $id));
			$query = $this->db->get( $this->t_photo );
			$result = $query->result_array();
			foreach($result as $k => $v) {
				if ($v['id']) {
					$this->delete($v['id']);
				}
			}
    }

    public function delete_pic( $filename )
    {
			$file = $this->uploadpath . $filename ;
			@unlink( $file );
    }

    function _prep_query() {
			if ($this->_select) $this->db->select($this->_select);
			if ($this->_where) $this->db->where($this->_where);
			if ($this->_orderby) $this->db->order_by($this->_orderby);
			if ($this->_limit) $this->db->limit($this->_limit[0], $this->_limit[1]);
    }
}