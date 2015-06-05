<?php

//Function for make pretty urls...

//If active fancy urls...
	
//Url don't have final slash!!
/**
* Function used for create pretty urls. The configuration for this urls are created on urls.php in the module selected.
*
*
* @param $url The base url, normally is PhangoVar::$base_url
* @param $folder_url The folder url.
* 
*/

function make_fancy_url($url, $folder_url, $ident_url, $arr_params=array(), $arr_get_params=array())
{
	
	$index_php='/index.php';
	
	if(defined('NO_INDEX_PHP'))
	{
	
		$index_php='';
	
	}
	
	if( isset( PhangoVar::$urls[$folder_url][$ident_url] ) )
	{
	
		$part_url=PhangoVar::$urls[$folder_url][$ident_url]['url'];
		
		//$parameters=PhangoVar::$urls[$folder_url][$ident_url]['url'];
		
		$parameters='';
		
		if(count(PhangoVar::$urls[$folder_url][$ident_url]['parameters'])>0)
		{
		
			$parameters='/'.implode('/', $arr_params);
		
		}
		
		$extra_params='';

		if(count($arr_get_params)>0)
		{
		
			foreach($arr_get_params as $key => $value)
			{

				$arr_get[]=$key.'/'.$value;

			}
		
			$extra_params='/get/'.implode('/', $arr_get);
		
		}
		
		return $url.$index_php.$part_url.$parameters.$extra_params;

	}
	else
	{
	
		show_error('Url not exists', 'url['.$folder_url.']['.$ident_url.'] not exists', $output_external='');
	
	}
		
}

/**
* Function for create direct links to controllers.
*
* @param string $base_url The base url of the phango system
* @param string $module The module used
* @param string $controller_folders
*/

function make_direct_url($base_url, $module, $controller_folders, $parameters_func=array(), $extra_parameters=array())
{

	$index_php='/index.php';
	
	if(defined('NO_INDEX_PHP'))
	{
	
		$index_php='';
	
	}

	$arr_get=array();
	
	$url_direct='';
	
	foreach($parameters_func as $key => $value)
	{

		$arr_get[]=$key.'/'.$value;

	}
	
	foreach($extra_parameters as $key => $value)
	{

		$arr_get[]=$key.'/'.$value;

	}

	$url_direct=$base_url.$index_php.'/'.$module.'/'.$controller_folders;
	
	if(count($arr_get)>0)
	{
	
		$url_direct.='/get/'.implode('/', $arr_get);
	
	}
	
	return $url_direct;

}

/**
* Function for create direct links to controllers adding old style description.
*
* @param string $base_url The base url of the phango system
* @param string $module The module used
* @param string $controller_folders
* @param string $description_text A descriptive text about the url
*/

function make_description_url($base_url, $module, $controller_folders, $description_text, $parameters_func=array(), $extra_parameters=array())
{

	$description_text=slugify($description_text);
	
	$extra_parameters['description']=$description_text;
	
	return make_direct_url($base_url, $module, $controller_folders, $parameters_func, $extra_parameters);

}

/**
* Function used for add get parameters to a well-formed url based on make_fancy_url, make_direct_url and others.
*
* @param string $url_fancy well-formed url
* @param string $arr_data Hash with format key => value. The result is $_GET['key']=value
*/

function add_extra_fancy_url($url_fancy, $arr_data)
{

	$arr_get=array();

	foreach($arr_data as $key => $value)
	{

		$arr_get[]=$key.'/'.$value;

	}

	$get_final=implode('/', $arr_get);

	$sep='/get/';

	if(preg_match('/\/$/', $url_fancy))
	{

		$sep='get/';

	}
	
	
	if(preg_match('/\/get\//', $url_fancy))
	{

		$sep='/';

	}

	return $url_fancy.$sep.$get_final;

}

/**
* A function for load beauty urls array from modules. 
*
*/

function load_urls()
{

	foreach(PhangoVar::$activated_modules as $module)
	{
		
		if(is_file(PhangoVar::$base_path.'modules/'.$module.'/urls.php'))
		{
		
			include(PhangoVar::$base_path.'modules/'.$module.'/urls.php');
		
		}
	
	}

}

/*
function controller_fancy_url($func_name, $description_text, $arr_data=array(), $respect_upper=0)
{

	return make_fancy_url(PhangoVar::$base_url, PhangoVar::$script_module, $func_name, $description_text, $arr_data, $respect_upper);

}
*/

?>