<?php
		    class Blog extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Blog_model');
	        $this->module = 'blog';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Blog';
			if ( $this->permission['view_all'] == '1'){$this->data['blog'] = $this->Blog_model->get_blog();}
			elseif ($this->permission['view'] == '1') {$this->data['blog'] = $this->Blog_model->get_blog($this->id);}
			$this->data['permission'] = $this->permission;
			$this->load->template('blog/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Blog';$this->data['table_blog_category'] = $this->Blog_model->all_rows('blog_category');$this->load->template('blog/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');$config['upload_path']          = './uploads/';
					                $config['allowed_types']        = 'png|jpg|jpeg|gif';
					                $config['max_size']             = 1000;
					                $config['max_width']            = 1024;
					                $config['max_height']           = 768;

					                $this->load->library('upload', $config);

					                if ( $this->upload->do_upload('image'))
					                {
					                        $data['image'] = '/uploads/'.$this->upload->data('file_name');
					                }
					                $id = $this->Blog_model->insert('blog',$data);
			if ($id) {
				redirect('blog');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Blog';
			$this->data['blog'] = $this->Blog_model->get_row_single('blog',array('id'=>$id));$this->data['table_blog_category'] = $this->Blog_model->all_rows('blog_category');$this->load->template('blog/edit',$this->data);
		}

		public function update()
		{
			if ( $this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$id = $data['id'];
			unset($data['id']);$config['upload_path']          = './uploads/';
					                $config['allowed_types']        = 'png|jpg|jpeg|gif';
					                $config['max_size']             = 1000;
					                $config['max_width']            = 1024;
					                $config['max_height']           = 768;

					                $this->load->library('upload', $config);

					                if ( $this->upload->do_upload('image'))
					                {
					                        $data['image'] = '/uploads/'.$this->upload->data('file_name');
					                }
					                $id = $this->Blog_model->update('blog',$data,array('id'=>$id));
			if ($id) {
				redirect('blog');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Blog_model->delete('blog',array('id'=>$id));
			redirect('blog');
		}}