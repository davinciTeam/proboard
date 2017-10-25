<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Appointment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load auth en check, session
		$this->load->library('Auth');
		$this->auth->check('1');
		$this->load->library('session');
		//Load url_helper
		$this->load->helper('url_helper');
		$this->load->model('Appointment_model');
		$this->load->model('projects_model');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$query['projects'] = $this->projects_model->getProjects();
		//  //render view projects
		render('appointment/overview',$query);
	}

	public function addAppointment($slug = null)
	{
		$this->load->helper('form');
    	$this->load->library('form_validation');

    	$query['projects'] = $this->projects_model->getProject($slug);
		render('appointment/addAppointment', $query);
	}

	public function addAppointmentAction()
	{
		$this->load->library('form_validation');

		// $this->form_validation->set_rules('name', 'Voornaam', 'required');
		// $this->form_validation->set_rules('lastname', 'Achternaam', 'required');
		// $this->form_validation->set_rules('ovnumber', 'Ovnummer', 'required');

		// if ($this->form_validation->run()) {

			$save = Array(
				"iteration_start" => $this->input->post('iteration_start'),
				"iteration_end" => $this->input->post('iteration_end'),
				"iteration_date" => $this->input->post('iteration_date'),
				"slug" => $this->input->post('slug'),
				"code_date" => $this->input->post('code_date'),
				"code_start" => $this->input->post('code_start'),
				"code_end" => $this->input->post('code_end')
			);
			$this->Appointment_model->addAppointment($save);
			
			redirect('appointment/');
		// } else if($this->input->post('slug')) {
		// 	redirect('appointment/addAppointment'.$this->input->post('slug'));
		// } else {
		//	redirect('appointment/addAppointment')
		//}
		
	}
}