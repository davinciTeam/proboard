<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Projects extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load auth en check, session
		$this->load->library('Auth');
		$this->auth->check('1');
		$this->load->library('session');
		//Load url_helper
		$this->load->helper('url_helper');
		$this->load->model('projects_model');
	}
	
	public function index()
	{
		$query['projects'] = $this->projects_model->getProjects();
		//  //render view projects
		render('projects/overview', $query);
	}

	public function Members($slug = null)
	{
		$query['project'] = $this->projects_model->getProject($slug);
		
		if (empty($query['project'])) {
			show_404();
		} 
		$this->load->helper('form');

		render('projects/addMembers', $query);
	}


	public function addMembersAction()
	{
        $this->projects_model->addMember($this->input->post('slug'), $this->input->post('name'));
        redirect('projects/Members/'.$this->input->post('slug'));
	}

	public function deleteMembersAction()
	{
		$this->projects_model->deleteMember($this->input->post('slug'), $this->input->post('name'));
        redirect('projects/Members/'.$this->input->post('slug'));
	}

	public function editMembersAction()
	{
		$this->projects_model->editMember($this->input->post('slug'), $this->input->post('old_member'), $this->input->post('new_member'));
        redirect('projects/Members/'.$this->input->post('slug'));
    }

	public function editProject($slug = null)
	{
		$this->load->helper('form');
    	$this->load->library('form_validation');
		
		$query['project'] = $this->projects_model->getProject($slug);
		
		if (empty($query['project'])) {
			show_404();
		} 

		render('projects/editProject', $query);

	}

	public function editProjectAction()
	{
		$data = Array(
			"name" => $this->input->post('name'),
			"slug" => $this->input->post('slug'),
			"client" => $this->input->post('client'),
			"teacher" => $this->input->post('teacher'),
			"description" => $this->input->post('description')
		);
		$this->projects_model->editProject($data);
		redirect('projects/');

	}

	public function addProject()
	{
		$this->load->helper('form');
    	$this->load->library('form_validation');
		$data['data'] = $this->projects_model->getProjects();
		render('projects/addProject', $data);
		
	}

	public function addProjectAction()
	{
		$save = Array(
			"name" => $this->input->post('name'),
			"client" => $this->input->post('client'),
			"teacher" => $this->input->post('teacher'),
			"description" => $this->input->post('description')
		);
		$this->projects_model->addProject($save);
		redirect('projects/');
		
	}
}