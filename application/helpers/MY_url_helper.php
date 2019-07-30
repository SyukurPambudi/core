<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_urlToPage'))
{
	function _url_module($url) {
		$array = explode('/',$url);
		if( count($array) > 2 ) {
			$page = $array[1];
			unset($array[0]);
			unset($array[1]);
			$page.= '/'.implode('_',$array).'/output';
			
		} else {
			$page = $array[1].'/output';
		}
		
		return $page;
	}
}
