<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  //use PHPMailer\PHPMailer\PHPMailer;
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

      //$mail = new PHPMailer;
      //Set who the message is to be sent from
      //$mail->setFrom('remcodezwart1997@gmail.com', 'First Last');

      //$mail->addAddress('remcodezwart1997@gmail.com', 'John Doe');
      //Set the subject line
      //$mail->Subject = 'PHPMailer mail() test';
      //Read an HTML message body from an external file, convert referenced images to embedded,
      //Replace the plain text body with one created manually
      //$mail->msgHTML('<h1>test</h1>');
      //$mail->AltBody = 'This is a plain-text message body';
      //Attach an image file
      //if (!$mail->send()) {
      //   echo "Mailer Error: " . $mail->ErrorInfo;
      //} else {
      //    echo "Message sent!";
      //}

      //exit;
      $data['projects'] = $this->projects_model->getProjects($page, true);
      $data['today'] = date('Y-m-d');

      render('dashboard/overview', $data);
    }
}