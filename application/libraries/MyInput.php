<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MYInput extends CI_Input {

public function __construct() {
    $this->_POST_RAW = $_POST; //clone raw post data 
    parent::__construct(); 
}

public function post($index = null, $xss_clean = TRUE) { 
    if(!$xss_clean){ //if asked for raw post data -eg. post('key', false)-, return raw data. Use with caution.
        return $this->_POST_RAW[$index];
    }
    return parent::post($index, $xss_clean); 
    }
}
?>

