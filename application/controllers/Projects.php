<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Projects extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//Load projectmodel
		$this->load->model('projects_model');
		//load auth en check, session
		$this->load->library('Auth');
		$this->auth->check('1');
		$this->load->library('session');
		//Load url_helper
		$this->load->helper('url_helper');
	}
	
	public function index(){
		$this->load->model('projects_model');
		$query['test'] = $this->projects_model->getProjects();
		//  //render view projects
		render('projects/overview' , $query);
		
	}

	public function add_project(){
		$this->load->helper('form');
    	$this->load->library('form_validation');
		$this->load->model('projects_model');
		$data['data'] = $this->projects_model->getProjects();
		// get data from form

		$post = Array(
			"posted" => $this->input->post('posted')
		);
		//Check if form is posted before inserting data 
		if ($post['posted'] == 1) {
			$save = Array(
				"name" => $this->input->post('name'),
				"client" => $this->input->post('client'),
				"teacher" => $this->input->post('teacher'),
				"description" => $this->input->post('description'),
				"members" => $this->input->post('members')
			);
			$this->projects_model->add_project($save);
		}
		//  //render view projects
		render('projects/add_project' , $data);
		
	}
}