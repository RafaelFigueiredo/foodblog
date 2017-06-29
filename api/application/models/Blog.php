<?php
/** 
 * Modelo que controla o acesso as questões
 *
 * @author Rafael Figueiredo <rafael.figueiredo91@gmail.com>
 * @version 0.1 
 */ 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CONSTANTES GLOBAIS
 */
define( "ACT_CREATE", 10);
define( "ACT_UPDATE" 	, 20);
define( "ACT_DELETE", 30);
define( "ACT_CHANGE_PUBLISHED_STATE" , 40);



class Posts extends CI_Model {
	function __construct(){
		parent::__construct();
	{
		$this->load->database();
	}

	//@todo Filtros
	public function read($postId)
	{
		$this->db->select('*');
		$this->db->from('posts');
		if(isset($postId) && $postId!=null){
			$this->db->where('post_id',$postId);
		}
		$queryPosts = $this->db->get();
			
		$result = array('status' 	=> "",
						'message' 	=> "",
						'posts'		=> $queryPosts->result_array()
		);
		
		



		//QUERY PUBLISHED STATE
		$this->db->select('*');
		$this->db->from('publishedstate');
		$queryVisibilities = $this->db->get();

		//QUERY BOARDS
		$this->db->select('*');
		$this->db->from('boards');
		$queryBoards = $this->db->get();

		$result = array('questions' 	=> $queryPosts->result_array(),
						'visibilities' => $queryVisibilities->result_array(),
						'boards' => $queryBoards->result_array()
			);

		//Listar questão especifica

		return $result;
	}
	
	public function update($data){
		//INICIA TRANSAÇÃO
		$this->db->trans_begin();

		$this->db->where('post_id', $data['post_id']);
		$this->db->update('posts', $data); 

		//TRATA ERROS
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'alert', 'mensage' => 'Ops, não foi possível salvar o arquivo!'));		
		}
		else
		{
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'Arquivo salvo com sucesso'));
		        //grava o log
		        $data['action']= ACT_UPDATE;
		        $this->load->model('Log','',true);
				$this->Log->create($data);
		}
	}



	public function create(){
		//INICIA TRANSAÇÃO
		$this->db->trans_begin();

		$data = array(
		   'post_type' => '1' ,
		   'author' => $this -> session -> userdata('user_id') ,
		   'board' => '2',
		   'published_state' => '10'
		);

		$this->db->insert('posts', $data);

		//TRATA ERROS
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'alert', 'mensage' => 'Ops, não foi possível adicionar questão!'));		
		}
		else
		{
		        $post_id = $this->db->insert_id();
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'Questão criada, abrindo editor...', 'post_id'=>$post_id));
		        //grava o log
		        $data['action']=ACT_CREATE;
		        $data['post_id']=$post_id;
		        $this->load->model('Log','',true);
				$this->Log->create($data);
		}
	}

	public function delete($data){
		//INICIA TRANSAÇÃO
		$this->db->trans_begin();

		$this->db->where('post_id', $data['post_id']);
		$this->db->delete('posts');

		//TRATA ERROS
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        echo json_encode(array('status' => 'alert', 'mensage' => 'Ops, não foi possível remover essa questão!'));		
		}
		else
		{
		        $post_id = $this->db->insert_id();
		        $this->db->trans_commit();
		        echo json_encode(array('status' => 'success', 'mensage' => 'questão apagada', 'post_id'=>$post_id));
		        //grava o log
		        $data['action']= ACT_DELETE;
		        $this->load->model('Log','',true);
				$this->Log->create($data);
		}
	}
}