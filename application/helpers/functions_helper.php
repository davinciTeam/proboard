<?php
	if(!function_exists('calculateToHour'))
	{
	  function calculateToHour($value)
	  {
	  	$hours  = floor($value/60); 
		$minutes = $value % 60;
		if(strlen($minutes)< 2){
			$minutes = "0" . $minutes;
		}
		return $hours . ":" . $minutes;
	  }
	}
		
	if(!function_exists('render')){
		function render($view = false, $data = false){
			if (!$view) {
				die("Je moet een view opgeven!");
			}

			$CI =& get_instance();
			$CI->load->library('session');
			$CI->load->model("ConfigModel", "config_model");
			
			if (!$data) {
				$data = [];
			}

			$data['admin'] = $CI->session->permision === '1'; 
			
			$CI->load->view('common/header', $data);
			$CI->load->view('common/menu', $data);
			$CI->load->view($view, $data);
			$CI->load->view('common/footer');
		}
	}