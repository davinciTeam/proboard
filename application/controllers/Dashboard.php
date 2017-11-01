<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
      $data['projects'] = $this->projects_model->getProjects($page, true);
      $data['today'] = date('Y-m-d');

      render('dashboard/overview', $data);
    }
}