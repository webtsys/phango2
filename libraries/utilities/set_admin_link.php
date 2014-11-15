<?php

function set_admin_link($text_admin, $parameters)
{
	
	/*if(!isset($parameters['IdModule']))
	{
		$parameters['IdModule']=$_GET['IdModule'];
	}*/
	
	base_url/ADMIN_FOLDER/module_name/other_parameters
	
	return make_fancy_url(PhangoVar::$base_url, ADMIN_FOLDER, 'index', $parameters);

}

?>
