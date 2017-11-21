<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Projects extends CI_Controller {

  	private static $_validationRules = array(
		array(
			'field' => 'name', 
			'label' => 'Naam',
            'rules' => 'required|max_length[100]|regex_match[/^[\w !?.]*$/]',
            'errors' => array(
				'required' => 'Vul een naam in voor het project',
				'max_length' => 'De naam van het project mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			),
		),
		array(
			'field' => 'client', 
			'label' => 'Client',
            'rules' => 'required|max_length[100]|regex_match[/^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$/]',
            'errors' => array(
				'required' => 'Vul een naam in van de client',
				'max_length' => 'De naam van de client mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			)
		),
		array(
			'field' => 'teacher', 
			'label' => 'Leraar',
            'rules' => 'required|max_length[100]|regex_match[/^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$/]',
            'errors' => array(
				'required' => 'Vul een leraar in',
				'max_length' => 'De naam van de client mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			)
		),
		array(
			'field' => 'description', 
			'label' => 'Beschrijving',
            'rules' => 'required|max_length[500]',
            'errors' => array(
				'required' => 'U moet een ovnummer invullen',
				'max_length' => 'De beschrijving mag maximaal 500 karakters lang zijn'
			)
		)
	);

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
		redirect('projects/overview');
	}
	
	public function overview($page = null)
	{
		$this->load->library('pagination');

		$query['projects'] = $this->projects_model->getProjects($page);
		
		$config['base_url'] = 'http://project-beheer/projects/overview';
		$config['total_rows'] =  $this->projects_model->AmountOfProjects();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		
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

		$this->form_validation->set_rules('projectSlug', '', 'required', 
			array('required' => 'Er is een onbekende fout opgetreden'));
		$this->form_validation->set_rules('MemberSlug', 'Naam', 'required', 
			array('required' => 'Selecteer een naam'));
		
		if ($this->form_validation->run()) {
			$this->projects_model->deleteMember($this->input->post('projectSlug'), $this->input->post('MemberSlug'));
		}
        redirect('projects/Members/'.$this->input->post('projectSlug'));
	}

	public function Tags($slug = null)
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

		render('projects/addTags', $query);
	}


	public function addTagsAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('slug', '', 'required', 
			array('required' => 'Er is een onbekende fout opgetreden'));
		$this->form_validation->set_rules('name', 'Naam', 'required', 
			array('required' => 'Selecteer een naam'));
		
		if ($this->form_validation->run()) {
  	      $this->projects_model->addTags($this->input->post('slug'), $this->input->post('name'));
    	}
        redirect('projects/Tags/'.$this->input->post('slug'));
	}

	public function deleteTagsAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('projectSlug', '', 'required', 
			array('required' => 'Er is een onbekende fout opgetreden'));
		$this->form_validation->set_rules('tagSlug', 'Naam', 'required', 
			array('required' => 'Selecteer een naam'));
		
		if ($this->form_validation->run()) {
			$this->projects_model->deleteTag($this->input->post('projectSlug'), $this->input->post('tagSlug'));
		}
        redirect('projects/Tags/'.$this->input->post('projectSlug'));
	}



	// ----------------


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

		$this->form_validation->set_rules(self::$_validationRules);
		$this->form_validation->set_rules('slug', '', 'required');

		if ($this->form_validation->run()) {
			$data = Array(
				"name" => $this->input->post('name'),
				"slug" => $this->input->post('slug'),
				"client" => $this->input->post('client'),
				'teacher' => $this->input->post('teacher'),
            	'git_url' => $this->input->post('git_url'),
            	'trello_url' => $this->input->post('trello_url'),
            	'project_url' => $this->input->post('project_url'),
            	'bug_url' => $this->input->post('bug_url'),
            	"active" => $this->input->post('active'),
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

	public function regex_check()
	{

		$urls = array($this->input->post('git_url'),
			$this->input->post('trello_url'),
			$this->input->post('bug_url'),
			$this->input->post('project_url')
	);

		$validate_error = array();
		foreach ($urls as $url) {
			
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)){			
				$this->form_validation->set_message('regex_check', 'Voer een geldige url in');
				// echo "false";
				array_push($validate_error,1);
			}else{
				// echo "true";
				array_push($validate_error,0);
				// return true;
			}
		}//end foreach
		// var_dump($validate_error);
		if( in_array( "1" ,$validate_error)){
		    $this->form_validation->set_message('regex_check', 'Voer een geldige url in');
		    return false;
		}
	}

	public function addProjectAction()
	{
		$this->load->library('form_validation');
		$this->load->library('Slug');
		$this->form_validation->set_rules(self::$_validationRules);

		$this->form_validation->set_rules('git_url','Git url' ,'callback_regex_check');
		
		

		if ($this->form_validation->run()) {

			$save = Array(
				"name" => $this->input->post('name'),
				"client" => $this->input->post('client'),
				'slug' => $this->slug->slug_exists(url_title($this->input->post('name'), 'dash', TRUE), 'projects'),
				"teacher" => $this->input->post('teacher'),
				'teacher' => $this->input->post('teacher'),
            	'git_url' => $this->input->post('git_url'),
            	'trello_url' => $this->input->post('trello_url'),
            	'project_url' => $this->input->post('project_url'),
            	'bug_url' => $this->input->post('bug_url'),
				"description" => $this->input->post('description')
			);
			$this->projects_model->addProject($save);
			redirect('projects/');
		} else {
			redirect('projects/addProject');
		}
	}
}