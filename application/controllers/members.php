<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load auth en check, session
		$this->load->library('Slug');
		$this->load->library('Auth');
		$this->auth->check('1');
		$this->load->library('session');
		//Load url_helper
		$this->load->helper('url_helper');
		$this->load->model('members_model');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$query['members'] = $this->members_model->getMembers();
		//  //render view projects
		render('members/overview', $query);
	}

	public function addMember($table = "members")
	{
		$this->load->library('Slug');
		$this->load->helper('form');
    	$this->load->library('form_validation');

		$data['data'] = $this->members_model->getMembers();
		render('members/addMembers', $data);
		
	}
	public function addMemberAction($table = "members")
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Voornaam', 'required');
		$this->form_validation->set_rules('lastname', 'Achternaam', 'required');
		$this->form_validation->set_rules('ovnumber', 'Ovnummer', 'required');

		if ($this->form_validation->run()) {

			$save = Array(
				"ovnumber" => $this->input->post('ovnumber'),
				"name" => $this->input->post('name'),
				"slug" => $this->slug->slug_exists(url_title($this->input->post('name'), 'dash', TRUE)),
				"insertion" => $this->input->post('insertion'),
				"lastname" => $this->input->post('lastname')
			);
			$this->members_model->addMember($save);
			redirect('members/');
		} else {
			redirect('members/addMember');
		}
		
	}
	public function editMember($slug = null)
	{
		$this->load->helper('form');
    	$this->load->library('form_validation');
		
		$query['member'] = $this->members_model->getMember($slug);
		
		if (empty($query['member'])) {
			show_404();
		} 

		render('members/editMember', $query);

	}

	public function editMemberAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Voornaam', 'required');
		$this->form_validation->set_rules('lastname', 'Achternaam', 'required');
		$this->form_validation->set_rules('ovnumber', 'Ovnummer', 'required');
		$this->form_validation->set_rules('slug', '', 'required');

		if ($this->form_validation->run()) {

			$data = Array(
				"ovnumber" => $this->input->post('ovnumber'),
				"name" => $this->input->post('name'),
				"insertion" => $this->input->post('insertion'),
				"slug" => $this->input->post('slug'),
				"active" => $this->input->post('active'),
				"lastname" => $this->input->post('lastname')
			);		
			$this->members_model->editMember($data);
		} else if ($this->input->post('slug')) {
			redirect('members/editMember/'.$this->input->post('slug'));
		}
		redirect('members/');
		
	}

	public function import()
	{
		$this->members_model->import();
		redirect('members/');
	}
}
