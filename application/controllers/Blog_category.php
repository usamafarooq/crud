<?php
		    class Blog_category extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Blog_category_model');
	        $this->module = 'blog_category';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Blog_category';
			if ( $this->permission['view_all'] == '1'){$this->data['blog_category'] = $this->Blog_category_model->all_rows('blog_category');}
			elseif ($this->permission['view'] == '1') {$this->data['blog_category'] = $this->Blog_category_modelget_rows('blog_category',array('user_id'=>$this->id));}
			$this->data['permission'] = $this->permission;
			$this->load->template('blog_category/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Blog_category';$this->load->template('blog_category/create',$this->data);
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

					                if ( $this->upload->do_upload('Icon'))
					                {
					                        $data['Icon'] = '/uploads/'.$this->upload->data('file_name');
					                }
					                $id = $this->Blog_category_model->insert('blog_category',$data);
			if ($id) {
				redirect('blog_category');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Blog_category';
			$this->data['blog_category'] = $this->Blog_category_model->get_row_single('blog_category',array('id'=>$id));$this->load->template('blog_category/edit',$this->data);
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

					                if ( $this->upload->do_upload('Icon'))
					                {
					                        $data['Icon'] = '/uploads/'.$this->upload->data('file_name');
					                }
					                $id = $this->Blog_category_model->update('blog_category',$data,array('id'=>$id));
			if ($id) {
				redirect('blog_category');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Blog_category_model->delete('blog_category',array('id'=>$id));
			redirect('blog_category');
		}}