<?php
	if (!function_exists('calculateToHour')) {
	  function calculateToHour($value) 
	  {
	  	$hours  = floor($value/60); 
		$minutes = $value % 60;
		if (strlen($minutes)< 2) {
			$minutes = "0" . $minutes;
		}
		return $hours . ":" . $minutes;
	  }
	}

	if (!function_exists('addFeeback')) {
		function addFeeback(array $feedback, $type = "positive")
		{
			$CI =& get_instance();
			$CI->load->library('session');

			if ($type === "positive") {
				$CI->session->set_userdata('feedbackPositive', $feedback);
			} else if ($type === "negative") {
				$CI->session->set_userdata('feedbackNegative', $feedback);
			} 
		}
	}

	if (!function_exists('feedback')) {
		function feedback()
		{
			$CI =& get_instance();
			$CI->load->library('session');

			$html = "";

			if ($CI->session->userdata('feedbackNegative') !== null) {

				$html .= "<div class=\"box box-solid box-danger\">
						      <div class=\"box-header\">
						          <h3 class=\"box-title\">Error</h3>
						          <div class=\"box-tools pull-right\">
								      <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"remove\">
								        <i class=\"fa fa-times\"></i>
								      </button>
								  </div>
						      </div>	
					      <div class=\"box-body\">";

				foreach ($CI->session->userdata('feedbackNegative') as $feedbackNegative) {
					$html .= "<p>".$feedbackNegative."</p>";
				}

				$html .= "</div></div>";
				$CI->session->unset_userdata('feedbackNegative');
			} 

			if ($CI->session->userdata('feedbackPositive') !== null) {
				$html .= "<div class=\"box box-solid box-success\">
							<div class=\"box-header\">
								<h3 class=\"box-title\">Succes</h3>
									<div class=\"box-tools pull-right\">
								      <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"remove\">
								        <i class=\"fa fa-times\"></i>
								      </button>
								  </div>
							</div>
							<div class=\"box-body\">";

				foreach ($CI->session->userdata('feedbackPositive') as $feedbackPositive) {
					$html .= "<p>".$feedbackPositive."</p>";
				}

				$html .= "</div></div>";
				$CI->session->unset_userdata('feedbackPositive');
			}

			return $html;
		}
	}

	if (!function_exists('RenderBreadCrum')) {
		function RenderBreadCrum($customs = null)
	    {
	    	$CI =& get_instance();
	    	$breadCrums = $CI->breadcrums->BreadCrum();

	    	$url = '';
	    	$html = '';
	    	$html .=  '<ol class="breadcrumb">';
	    		foreach($breadCrums as $breadcrumb) {
	    			$html .=  '<li><a href="/'.$url. $breadcrumb .'">'. $breadcrumb .'</a></li>';
	    			$url .= $breadcrumb.'/';
	    		}
	    		if (!empty($customs)) {
	    			foreach($customs as $custom)
	    			{
	    				$html .=  '<li>'.$custom.'</li>';
	    			}
	    		}

	    	$html .=  '</ol>';
	    	return $html;
	    }
	}

	if (!function_exists('displayTime')) {
		function displayTime($time) {
			if ($time === '0000-00-00 00:00:00') {
				return 'Niks ingepland';
			} else if (date('Ymd') == date('Ymd', strtotime($time))) {
				return date('l G:i', strtotime($time));
			} else if (date('Ymd', strtotime("+1 week")) == date('Ymd', strtotime($time))) {
				return date('l G:i', strtotime($time));
			} 
			return $time;
		}
	}

	if (!function_exists('compareTime')) {
		function compareTime(array $times) {
			$class = 'green';
			foreach ($times as $time) {
				if (strtotime(date('Ymd')) > strtotime($time) && $time !== '0000-00-00 00:00:00' || $class === 'red') {
					$class = 'red';
				} else if (date('Ymd') == date('Ymd', strtotime($time)) && $time !== '0000-00-00 00:00:00' || $class === 'orange') {
					$class = 'orange';
				}				
			}
			return $class;
		}
	}

	if (!function_exists('render')) {
		function render($view = false, $data = false)
		{
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