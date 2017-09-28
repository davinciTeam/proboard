<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load auth en check, session
		$this->load->library('Auth');
		$this->auth->check('1');
		$this->load->library('session');
		//Load url_helper
		$this->load->helper('url_helper');
		$this->load->model('members_model');
	}
	
	public function index()
	{
		$query['members'] = $this->members_model->getMembers();
		//  //render view projects
		render('members/overview', $query);
	}

	public function addMember()
	{
		$this->load->helper('form');
    	$this->load->library('form_validation');
		// $this->load->helper('url_helper');
		$data['data'] = $this->members_model->getMembers();
		render('members/addMembers', $data);
		
	}
	public function addMemberAction()
	{
		$save = Array(
			"ovnumber" => $this->input->post('ovnumber'),
			"name" => $this->input->post('name'),
			"insertion" => $this->input->post('insertion'),
			"lastname" => $this->input->post('lastname')
		);
		$this->members_model->addMember($save);
		redirect('members/');
		
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
		$data = Array(
			"ovnumber" => $this->input->post('ovnumber'),
			"name" => $this->input->post('name'),
			"insertion" => $this->input->post('insertion'),
			"slug" => $this->input->post('slug'),
			"lastname" => $this->input->post('lastname')
		);
		// die($data['slug'] . $data['name'] . $data['insertion'] . $data['lastname']);
		$this->members_model->editMember($data);
		redirect('members/');

	}
}

?>