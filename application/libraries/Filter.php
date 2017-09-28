<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filter {
	/*
	|--------------------------------------------------------------------------
	| filter class any filter functions need to be placed here
    | this class is autoloaded 
	|--------------------------------------------------------------------------
	*/

	public function xssFilter($value)
    {
        if (is_string($value)) {
            return htmlentities($value, ENT_QUOTES, 'UTF-8');
        } else if (is_array($value) || is_object($value)) {
            foreach ($value as $key => $valueInValue) {
                if (is_array($value)) {
                    $this->xssFilter($valueInValue);
                } else if (is_object($value)) {
                    $value->{$key} = $this->xssFilter($valueInValue);
                } 
            }
        }
        return $value;
    }
}

	