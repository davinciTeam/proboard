<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class Dashboard extends CI_Controller {
    public function __construct()
    {
     		parent::__construct();
        $this->load->library('Auth');
      	$this->auth->check('0');
        $this->load->library('session');
    }
    
    public function index()
    {
        render('dashboard/overview');
    }
}