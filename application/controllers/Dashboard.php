<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  use PHPMailer\PHPMailer\PHPMailer;
  class Dashboard extends CI_Controller {
    public function __construct()
    {
   		parent::__construct();
      $this->load->library('Auth');
    	$this->auth->check('0');
      $this->load->library('session');
      $this->load->model('projects_model');    
    }
    
    public function index($page = null)
    {
      //Create a new PHPMailer instance

      $mail = new PHPMailer;
      $mail->setFrom('proboard@ws.dvc-icta.nl');

      $mail->addAddress('remcodezwart1997@gmail.com');
      $mail->Subject = 'PHPMailer mail() test';
      $mail->msgHTML('<html><head></head><body><h1>test</h1></body>');
      $mail->AltBody = 'This is a plain-text message body';
      //$mail->send();
     
      $data['projects'] = $this->projects_model->getProjects($page, true);
      $data['today'] = date('Y-m-d');

      render('dashboard/overview', $data);
    }
}