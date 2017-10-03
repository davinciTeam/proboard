<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Slug {


	function slug_exists($slug)
	{
		$CI =& get_instance();
		$CI->load->database();
	        $string = 1;
	        while($CI->db->where('slug', $slug)->get('members')->result())
	        {
	            $slug .= (string)$string;
	            $string++;
	        }
        		return $slug;       
	}
}	        