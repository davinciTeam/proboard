<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Slug {


	function slug_exists($slug, $table="members")
	{
		$CI =& get_instance();
		$CI->load->database();
	    $int = 1;
        while($CI->db->where('slug', $slug)->get($table)->result())
        {
            $slug .= (string)$int;
            $int++;
        }
    	return $slug;       
	}
}	        