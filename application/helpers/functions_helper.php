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

if (!function_exists('get_input_params')) {
	function get_input_params() {
        $result = NULL;
        if(function_exists('json_decode')) {
            $jsonData = json_decode(trim(file_get_contents('php://input')), true);
            $result = $jsonData;
        }
        return $result;
    }
}