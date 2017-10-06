<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Projects extends CI_Controller {

  	private static $_validationRules = array(
		array(
			'field' => 'name', 
			'label' => 'Naam',
            'rules' => 'required|max_length[100]',
            'errors' => array(
				'required' => 'Vul een naam in voor het project',
				'max_length' => 'De naam van het project mag maximaal 100 karakters lang zijn'
			),
		),
		array(
			'field' => 'client', 
			'label' => 'Client',
            'rules' => 'required|max_length[100]',
            'errors' => array(
				'required' => 'Vul een naam in van de client',
				'max_length' => 'De naam van de client mag maximaal 100 karakters lang zijn'
			)
		),
		array(
			'field' => 'teacher', 
			'label' => 'Leraar',
            'rules' => 'required|max_length[100]',
            'errors' => array(
				'required' => 'Vul een leraar in'
				'max_length' => 'De naam van de client mag maximaal 100 karakters lang zijn'
			)
		),
		array(
			'field' => 'ovnumber', 
			'label' => 'Ovnummer',
            'rules' => 'required|max_length[500]',
            'errors' => array(
				'required' => 'U moet een ovnummer invullen',
				'max_length' => 'De ovnummer kan maximaal 8 karakters lang zijn',
				'is_numeric' => 'Vul een geldig nummer in'
			)
		)
	)

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
		$query = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash(),
	        'project' => $this->projects_model->getProject($slug)
		);

		if (empty($query['project'])) {
			show_404();
		} 
		$this->load->helper('form');

		render('projects/addMembers', $query);
	}


	public function addMembersAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('slug', '', 'required', 
			array('required' => 'Er is een onbekende fout opgetreden'));
		$this->form_validation->set_rules('name', 'Naam', 'required', 
			array('required' => 'Selecteer een naam'));
		
		if ($this->form_validation->run()) {
  	      $this->projects_model->addMember($this->input->post('slug'), $this->input->post('name'));
    	}
        redirect('projects/Members/'.$this->input->post('slug'));
	}

	public function deleteMembersAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('slug', '', 'required', 
			array('required' => 'Er is een onbekende fout opgetreden'));
		$this->form_validation->set_rules('name', 'Naam', 'required', 
			array('required' => 'Selecteer een naam'));
		
		if ($this->form_validation->run()) {
			$this->projects_model->deleteMember($this->input->post('slug'), $this->input->post('name'));
		}
        redirect('projects/Members/'.$this->input->post('slug'));
	}


	public function editProject($slug = null)
	{
		$this->load->helper('form');
		
		$query['project'] = $this->projects_model->getProject($slug);
		
		if (empty($query['project'])) {
			show_404();
		} 

		render('projects/editProject', $query);

	}

	public function editProjectAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('slug', '', 'required');

		if ($this->form_validation->run()) {
			$data = Array(
				"name" => $this->input->post('name'),
				"slug" => $this->input->post('slug'),
				"client" => $this->input->post('client'),
				"teacher" => $this->input->post('teacher'),
				"description" => $this->input->post('description')
			);
			$this->projects_model->editProject($data);
		} else if ($this->input->post('slug')) {
			redirect('projects/editProject/'.$this->input->post('slug'));
		} 
		redirect('projects/');
	}

	public function addProject()
	{
		$this->load->helper('form');
		
		$data['data'] = $this->projects_model->getProjects();
		render('projects/addProject', $data);
		
	}

	public function addProjectAction()
	{
		$this->load->library('form_validation');
		$this->load->library('Slug');
		
		if ($this->form_validation->run()) {

			$save = Array(
				"name" => $this->input->post('name'),
				"client" => $this->input->post('client'),
				'slug' => $this->slug->slug_exists(url_title($this->input->post('name'), 'dash', TRUE), 'projects'),
				"teacher" => $this->input->post('teacher'),
				"description" => $this->input->post('description')
			);
			$this->projects_model->addProject($save);
			redirect('projects/');
		} else {
			redirect('projects/addProject');
		}
	}
}