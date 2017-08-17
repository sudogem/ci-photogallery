<?php
class Album_model extends CI_Model {
	/**
	 * This function will always be called!!
	 */
	function __construct()
	{
		parent::__construct();
		$this->t_album = 'album' ;
		$this->t_user  = 'users' ;
		$this->t_photo = 'photo' ;
		$this->t_album_users = 'album_users' ;
		$this->data = new stdClass ;
		$this->user_id = getuid();
    $this->per_page = $this->config->item('per_page');
	}

	/**
	 * Find the album by id
	 */
	public function find_by_id($id )
	{
		$this->db->where('id', $id);
    $query = $this->db->get( $this->t_album );
		$data = $query->row_array();
    return $data ;
	}

	public function get_album_user($album_id)
	{
    $this->db->join($this->t_album_users, sprintf("album_users.album_id = album.id and album.id = %d", $album_id));
    $this->db->join($this->t_user, sprintf("users.id = album_users.user_id"));
    $query = $this->db->get( $this->t_album );
		$data  = $query->row_array();
    return $data ;
	}
	/**
	 * Return the first row in the album table
	 */
	public function first()
	{
    $query = $this->db->get( $this->t_album );
		$data = $query->first_row();
    return $data;
	}

	/**
	 * Get all the album with extra parameters
	 */
	public function get_all_album($params=array())
	{
		$base_url = !empty($params['base_url']) ? $params['base_url'] : site_url("admin/album/index");
		$is_paginate = !empty($params['is_paginate']) ? $params['is_paginate'] : false;
		if ($is_paginate) {
			$config['base_url'] = $base_url;
			$config['total_rows'] =  $this->get_album_count();
			$config['per_page'] = $this->per_page ;
			$config['uri_segment'] = 4;
	 		$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$cur_offset = ( $this->uri->segment( $config['uri_segment'] ) != '' ) ? (int)$this->uri->segment( $config['uri_segment'] ) : 0 ;
			$tmpcur_offset = (empty($cur_offset)) ? 0 : $config['per_page'];
			$u = ($config['per_page'] * $cur_offset) - $tmpcur_offset;
		}

		if (isset($params['order_by'])) {
			$order_by = $params['order_by'];
		} else {
			$order_by = "photo.created_at desc";
		}

		if (isset($params['type']) && $params['type'] == 'public') {
				switch($this->db->dbdriver) {
					case 'postgre':
					// For postgres
					$sql = sprintf("SELECT DISTINCT ON (album.id) album.*, COUNT(photo.id) AS total_photos
                          FROM photo
                          RIGHT JOIN album ON album.id = photo.album_id
                          GROUP BY album.id");
					break;

					default:
						// For mysql
						$sql = sprintf("SELECT album.*, count(photo.id) AS total_photos
                            FROM photo
                            RIGHT JOIN album ON album.id = photo.album_id
                            GROUP BY album.id
                            HAVING total_photos > 0
                            ORDER BY %s", $order_by);
				}
		} else {
			if (is_admin()) {
				$limit = $is_paginate ? " LIMIT $this->per_page OFFSET $u" : "";
				switch($this->db->dbdriver) {
					case 'postgre':
						// For postgres
						$sql = sprintf("SELECT DISTINCT ON (album.id) album.*, COUNT(photo.id) AS total_photos
                            FROM photo
                            RIGHT JOIN album ON album.id = photo.album_id
                            GROUP BY album.id
                            ORDER BY album.id,%s %s", $order_by, $limit);
						break;

					default:
						// For mysql
						$sql = sprintf("SELECT album.*, COUNT(photo.id) AS total_photos
                            FROM photo
                            RIGHT JOIN album ON album.id = photo.album_id
                            GROUP BY album.id
                            ORDER BY %s %s", $order_by, $limit);
				}

			} else {
				$sql = sprintf("SELECT album.*, album_users.user_id, COUNT(photo.id) AS total_photos
                        FROM photo
                        RIGHT JOIN album ON album.id = photo.album_id
                        INNER JOIN album_users ON album_users.album_id = album.id
                        AND album_users.user_id = %d
                        GROUP BY album.id
                        ORDER BY %s", $this->user_id, $order_by);
			}
		}
		// print('Album_model.get_all_album: ');
		// print($sql);
    $query = $this->db->query($sql);
    if ($query->result()) {
      return array('data' => $query->result_array(), 'pagination' => $is_paginate ? $pagination : "");
    }
    else {
      return FALSE;
    }

	}

	public function get_album_count()
	{
		if (is_admin()) {
			$query = $this->db->get($this->t_album);
			return $query->num_rows();
		} else {
			// $sql = sprintf("
			// select album.*, album_users.user_id,  count(photo.id) as total_photos from photo
			// right join album on album.id = photo.album_id
			// inner join album_users on album_users.album_id = album.id and album_users.user_id = %d
			// group by album.id", $this->user_id);

			$this->db->join($this->t_album_users, sprintf("album_users.album_id = album.id and album_users.user_id = %d", $this->user_id));
			$query = $this->db->get($this->t_album);
			return $query->num_rows();
		}

	}

	public function add()
	{
		$this->data->album_name		= $this->input->post('album_name');
		$this->data->album_desc		= $this->input->post('album_desc');
		$created = $this->input->post('created');
		$this->data->created_at 	= (isset($created) && $created!= '') ? date('Y-m-d', strtotime($created)) : date('Y-m-d');
		$this->data->updated_at 	= (isset($created) && $created!= '') ? date('Y-m-d', strtotime($created)) : date('Y-m-d');
		$this->db->insert( $this->t_album , $this->data);
    $album_id = $this->db->insert_id();
		$this->db->insert( $this->t_album_users , array('user_id' => $this->user_id, 'album_id' => $album_id));

	}

	public function edit()
	{
		$this->data->album_name  	= $this->input->post('album_name');
		$this->data->album_desc 	= $this->input->post('album_desc');
		$this->data->updated_at		= date("Y-m-d") ;
		$this->db->where( array('id' => $this->input->post('id'))) ;
		$this->db->update( $this->t_album , $this->data );
	}

	public function delete($id)
	{
		$this->db->delete($this->t_album, array('id' => $id));
		$this->gallery_model->delete_by_album($id);
	}

}
