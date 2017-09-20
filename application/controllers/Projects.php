<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class Projects extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//Load projectmodel
		$this->load->model('projects_model');
		//load auth en check, session
		$this->load->library('Auth');
		$this->auth->check(strtolower(get_class($this)));
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
}