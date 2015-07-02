<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package i18n
*
*/

/**
* Function used for load a lang file from a module
*
* @param string $multiple A multiple string params with the name of the module where search the lang. If module not exists, phango search the file in i18n/ directory
* @example load_lang('shop', 'common'); Load the lang files from module shop. Common don't have any module, and will be loaded from i18n/ folder
*/
	
function load_lang()
{

	if(isset($_SESSION['language']))
	{
	
		if(in_array($_SESSION['language'], PhangoVar::$arr_i18n))
		{

			PhangoVar::$language=$_SESSION['language'];
			
		}
		else
		{
		
			$_SESSION['language']=PhangoVar::$language;
		
		}

	}
	else
	{
	
		$_SESSION['language']=PhangoVar::$language;
	
	}
	
	$arg_list = func_get_args();
	
	foreach($arg_list as $lang_file)
	{
	
		$base_path=PhangoVar::$base_path;

		$module_path=$lang_file;
			
		$pos=strpos($module_path, "/");
		
		if($pos!==false)
		{

			$arr_path=explode('/', $module_path);

			$module_path=$arr_path[0];
			
			$lang_file=$arr_path[1];
			
		}

		if(!isset(PhangoVar::$cache_lang[$lang_file]))
		{

			//First search in module, after in root i18n.
			
			$path=$base_path.'modules/'.$module_path.'/i18n/'.PhangoVar::$language.'/';
			
			$file_path=$path.$lang_file.'.php';
			
			if(is_file($file_path))
			{
				include($file_path);
			}
			else
			{
				
				$path=$base_path.'i18n/'.PhangoVar::$language.'/';
				
				$file_path=$base_path.'i18n/'.PhangoVar::$language.'/'.$lang_file.'.php';
				
				if(is_file($file_path))
				{
					include($file_path);
				}

			}

			//ob_end_clean();

			PhangoVar::$cache_lang[$lang_file]=1;

		}

	}

}

/**
* Function that return the value of the code_lang
*
* @param string $app The module where search the code lang
* @param string $code_lang Code lang to return the value
* @param string $default_lang The module where search the code lang
*/

function i18n_lang($app, $code_lang, $default_lang) 
{

	return isset(PhangoVar::$lang[$app][$code_lang]) ? PhangoVar::$lang[$app][$code_lang] : $default_lang;

}

?>
