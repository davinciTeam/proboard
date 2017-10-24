<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class BreadCrums {
    function breadCrum()
    {
    	$CI =& get_instance();
        $i = 1;
        $breadCrums = array();
        while($CI->uri->segment($i) !== null)
        {
            $breadCrums[] = $CI->uri->segment($i);
            $i++;
        }
        return $breadCrums;
    }
}