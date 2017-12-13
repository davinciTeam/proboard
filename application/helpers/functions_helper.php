<?php
	if (!function_exists('echo_json')) {
		function echo_json($data) {
			header('Content-Type: text/json');
	        header('Access-Control-Allow-Headers: content-type');
	        header('Access-Control-Allow-Origin: *');

	        echo json_encode($data);
	        exit;
		}
	}