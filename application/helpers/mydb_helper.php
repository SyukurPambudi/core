<?php
function set_db($name,$boolean) {
	$_ci =& get_instance();
	$_ci->db->close();
	return $_ci->load->database($name,$boolean);
}