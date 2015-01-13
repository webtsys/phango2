<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package Core/ModelExtraMethods
*
*
*/

function select_a_row_where_method_class($class, $where, $arr_select=array(), $raw_query=0, $assoc=0)
{

	settype($idrow, 'integer');
	
	$query=$class->select($where, $arr_select, $raw_query);
	
	return webtsys_fetch_array($query, $assoc);

}

?>