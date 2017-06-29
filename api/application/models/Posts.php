<?php
/** 
 * Modelo que controla o acesso as questões
 *
 * @author Rafael Figueiredo <rafael.figueiredo91@gmail.com>
 * @version 0.1 
 */ 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Posts extends CI_Model {
	/**
	 * CONSTRUCTOR
	 */

	function __construct()
	{
		parent::__construct();
		//load library database
		$this->load->database();
	}

	/**
	 * READ
	 * @args postId -
	 */
	public function read($data)
	{
		$this->db->select('*');
		$this->db->from('posts');
		$queryPosts = $this->db->get();
		$result = array('posts' => $queryPosts->result_array());
		echo json_encode($result);
	}

	public function create($data){
		//SQL Transactions
		$this->db->trans_begin();

		echo var_dump($data);
		//Create a new post into database
		$this->db->insert('posts', $data);

		//Error handling
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'error', 'mensage' => 'Was not possible add a new post to DB!'));		
		}
		else
		{
		        $post_id = $this->db->insert_id();
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'Post created', 'post_id'=>$post_id));
		}
	}

	public function delete($data){
		//SQL Transaction
		$this->db->trans_begin();

		//Delete a post by id
		$this->db->where('post_id', $data['post_id']);
		$this->db->delete('posts');

		//Error handling
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'error', 'mensage' => 'Was not possible add a new post to DB!'));		
		}
		else
		{
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'Post deleted'));
		}
	}

	public function update($data){
		//SQL Transaction
		$this->db->trans_begin();
		
		//Update a post by ID
		$this->db->where('post_id', $data['post_id']);
		$this->db->update('posts', $data); 

		//Error handling
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'error', 'mensage' => 'Was not possible add a new post to DB!'));		
		}
		else
		{
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'Post updated', 'post_id'=>$data['post_id']));
		}
	}
}