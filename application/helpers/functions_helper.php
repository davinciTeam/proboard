<?php
	if (!function_exists('echo_json')) {
		function echo_json($data) {
			header('Content-type:application/json');
	        header('access-control-allow-origin: *');

	        echo json_encode($data);
	        exit;
		}
	}