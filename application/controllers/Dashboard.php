<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  use PHPMailer\PHPMailer\PHPMailer;
  class Dashboard extends CI_Controller {
    public function __construct()
    {
   		parent::__construct();
      $this->load->library('Auth');
    	// $this->auth->check('0');
      $this->load->model('projects_model');    
      $this->load->model('appointment_model');    
    }
    
    public function index($page = null)
    {

      $data['projects'] = $this->projects_model->getProjects($page, true);
      $data['today'] = date('Y-m-d');
      $data['amount_of_items'] = $this->projects_model->AmountOfProjects();
      // $data['admin'] = $this->session->permision; 
      $data['project_items'] = $this->appointment_model->getTodayAppointment($page, true);

      echo_json($data);
    }

    public function activation($hash = null)
    {
      $this->load->library('Auth');
      $this->auth->doLogout();

      $this->load->model("ConfigModel", "config_model");
      $this->load->helper('form');

      $data['user'] = $this->config_model->getUserByActivationHash($hash);

      if (!$data['user']) {
        redirect('/');
      }
      
      render('config/activation', $data);
    }

    public function activationAction()
    {
      $this->load->model("ConfigModel", "config_model");

      $this->load->library('form_validation');
      $this->form_validation->set_rules('password', 'wachtwoord', 'required',
        array('required' => 'Vul een watchwoord in'));

      $this->form_validation->set_rules('password_repeat', 'wachtwoord', 'required|callback_doublePasswordCheck',
        array('required' => 'Vul uw wachtwoord nog een keer in ter bevesteging',
              'doublePasswordCheck' => 'Wachtwoorden komen niet overheen'));

      if ($this->form_validation->run()) {
        
        $data = array(
          'password' => $this->input->post('password'),
          'active' => 1
        );

        $this->config_model->setUserPassword($data, $this->input->post('activation_hash'));

      } else if ($this->input->post('activation_hash')) {
        redirect('dashboard/activation/'.$this->input->post('activation_hash'));
      }
      redirect('dashboard');
    }

    public function doublePasswordCheck()
    {
      return ($this->input->post('password') === $this->input->post('password_repeat'));
    }

    public function newToken()
    {
      header('Content-type:application/json');
      echo json_encode(array('new_token' => $this->security->get_csrf_hash()));
    }
}