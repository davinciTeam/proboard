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
		$this->load->model('Appointment_model');
	}
	
	public function index()
	{
		show_404();
	}

	public function addAppointmentAction()
	{
		$type = $this->input->post('type');
		if ($type === 'iteration' || $type === 'code_review') {
		 	$data = Array(
				"start_date" => $this->input->post('iteration_or_code_review_start').':00',
				"end_date" => $this->input->post('iteration_or_code_review_end').':00',
				"slug" => $this->input->post('slug'),
			);
			if ($this->Appointment_model->addAppointment($data, $type)) {
				header('Content-type:application/json');
				echo json_encode(array('succes' => 'true'));
				exit;
			}
 		}
 		header('Content-type:application/json');
		echo json_encode(array('succes' => 'false'));
	}
}