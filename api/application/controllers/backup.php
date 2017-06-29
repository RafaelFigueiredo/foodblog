<?php
/**
 * @todo Top comments
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Posts','',true);
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->view('welcome_message');
	}

	/********************* API FUNCTIONS ***********************/
	/* Create a new post or Update a existent post
	 * @args none
	 * @POST title, subtitle, image and content.
	 * @return JSON {status: success|error, message: ###}
	 */
	public function save(){
		//configure the upload helper
		$file_element_name      ='file';
		$config['upload_path'] = '../uploads/';
    	$config['allowed_types'] = 'gif|jpg|png|bmp';
    	$config['max_size'] = 1024 * 8;
    	$config['encrypt_name'] = TRUE;
 		
    	$this->load->library('upload', $config);

    	//try to upload the file
    	if (!$this->upload->do_upload($file_element_name))
    	{
            $status = 'error';
        	$msg = $this->upload->display_errors('', '');
        	echo json_encode(array('status' => $status, 'mensage' => $msg));
    	}
    	else
    	{
    		$arquivo = $this->upload->data();
    		echo json_encode(array(	'status'=>'success',
    								'mensage'=>'Upload realizado com sucesso!',
    								'path'=> $arquivo['file_name']));
    		$data['image'] = $arquivo['file_name']);
    	}

    	//read the POST data
		$data['post_id'] = $this->input->post('post_id');
		$data['title'] = $this->input->post('title');
		
		$data['subtitle'] = $this->input->post('subtitle');
		$data['content'] = $this->input->post('content');
		//call model
		if($data['post_id']==''){
			$this->Posts->create($data);	
		}else{
			$this->Posts->update($data);	
		}
    	@unlink($_FILES[$file_element_name]);
	}


	/* Get data of one post by Id, or all posts if no Id was specified
	 * @POST postId
	 * @return JSON {status: success|error, message: ###, posts:[{...}]}
	 */
	public function read()
	{
		//read the POST data
		$data['post_id'] = $this->input->post('post_id');
		//call model
		$this->Posts->read($data);
	}

	/* Delete a specific post by Id.
	 * @args postId
	 * @return JSON {status: success|error, message: ###}
	 */
	public function delete(){
		//read the POST data
		$data['post_id'] = $this->input->post('post_id');
		//call model
		$this->Posts->delete($data);

	}
}