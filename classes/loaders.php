<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package loaders
*
*/


/**
* Function for load config for modules.
*
*
* @param $module Name of the module
* @param $name_config Name of the config file, optional. Normally load config.php file on folder config.
*/

function load_config($module, $name_config='config_module')
{

	//load_libraries(array($name_config), PhangoVar::$base_path.'/modules/'.$module.'/config/');
	
	if(is_file(PhangoVar::$base_path.'/modules/'.$module.'/config/'.$name_config.'.php'))
	{
		include(PhangoVar::$base_path.'/modules/'.$module.'/config/'.$name_config.'.php');
	}
	
}

/**
* Function used for load models on controllers (or where you like, ;) ).
*
* When you call load_model with a name, or many names, phango look if exists a folder on modules called how $name_model. If find this, try open a file called "models_$name_model.php". If not exists, you obtain a phango exception error. If you want load a model file with other name, you can use this format: module_name/other_model_name being module_name, the name of the module an other_model_name the name of the model.
*
* Remember that the models can have a name distinct to the name of the file model.
*
* @param $name_model A serie of names of the models. 
*
*/

function load_model($name_model='')
{
	
	$names=func_get_args();
	
	//Load a source file only	
	
	foreach($names as $my_model)
	{

		$arr_file=explode('/', $my_model);

		$my_path=$arr_file[0];

		if(count($arr_file)>1)
		{

			$my_model=$arr_file[1];

		}

		
		if( !isset(PhangoVar::$cache_model[$my_model]) )
		{

			$path_model=PhangoVar::$base_path.'modules/'.$my_path.'/models/models_'.$my_model.'.php';
		
			if(!include($path_model)) 
			{

				$arr_error_sql[0]='<p>Error: Cannot load a file model.</p>';    
				$arr_error_sql[1]='<p>Error: Cannot load '.$my_model.' file model.</p>';
				
				$output=ob_get_contents();

				$arr_error_sql[1].='<p>Output: '.$output.'</p>';

				ob_clean();
			
				echo load_view(array('Phango site is down', $arr_error_sql[DEBUG]), 'common/common');

				die();
			
			}
			else
			{
				
				PhangoVar::$cache_model[$my_model]=1;

			}
			
			//Now, load extension if necessary
			
			if(isset(PhangoVar::$arr_extension_model[$my_model]))
			{
				
				load_extension($my_model);
			
			}
			

		}

	
	}
	//Check if model and db is synced

	//check_model_exists();

}

/**
* Internal function used for load_model for load extensions to the models. You can specific your extensions using PhangoVar::$arr_extension_model array. The name of an extension file is extension_name.php where name is the name given how PhangoVar::$arr_extension_model item.
*
*/

function load_extension()
{
	
	$names=func_get_args();
	
	foreach($names as $my_model)
	{

		$arr_file=explode('/', $my_model);

		$my_path=$arr_file[0];

		if(count($arr_file)>1)
		{

			$my_model=$arr_file[1];

		}
		
	}
	
	if( !isset(PhangoVar::$cache_model['extension_'.$my_model]) )
	{
		
		$path_model=PhangoVar::$base_path.'modules/'.$my_path.'/models/extension_'.$my_model.'.php';
		
		if(!include($path_model)) 
		{
		
			$arr_error_sql[0]='<p>Error: Cannot load a file extension model.</p>';    
			$arr_error_sql[1]='<p>Error: Cannot load '.$my_model.' file extension model.</p>';
			
			$output=ob_get_contents();

			$arr_error_sql[1].='<p>Output: '.$output.'</p>';

			ob_clean();
		
			echo load_view(array('Phango site is down', $arr_error_sql[DEBUG]), 'common/common');

			die();
		
		}
		else
		{
		
			PhangoVar::$cache_model['extension_'.$my_model]=1;
		
		}
	
	}

}

/**
* Load libraries, well, simply an elegant include
*
* Very important function used for load the functions and method necessaries on your projects. Is simple, you create a file php and put in a libraries folder. Use the name without php used in file and magically the file is loaded. You can use this function in many places, phango use a little cache for know who file is loaded.
*
* @param string $names The name of php file without .php extension. If you want specific many libraries you can use an array 
* @param string $path The base path where search the library if is not in standard path. By default the path is on PhangoVar::$base_path/libraries/ or PhangoVar::$base_path/modules/$module/libraries/
*
*/ 

function load_libraries($names, $path='')
{
	
	if(gettype($names)!='array')
	{
		
		$arr_names[]=$names;

	}
	else
	{
	
		$arr_names=&$names;
	
	}

	if($path=='')
	{

		$path=PhangoVar::$base_path.'/modules/'.PhangoVar::$script_module.'/libraries/';

	}
	
	foreach($arr_names as $library) 
	{
		

		if(!isset(PhangoVar::$cache_libraries[$library]))
		{
		
			$old_path=$path;
		
			if(is_file($path.$library.'.php'))
			{
				include($path.$library.'.php');
				
				PhangoVar::$cache_libraries[$library]=1;
				
			}
			else
			{
				//Libraries path
				$path=PhangoVar::$base_path.'libraries/';
				
				if(!include($path.$library.'.php')) 
				{
			
					$output=ob_get_contents();

					$check_error_lib[1]='Error: Don\'t exists '.$library.' on path '.$path.' and path '.$old_path.'<p>Output: '.$output.'</p>';
					$check_error_lib[0]='Error loading library.';

					ob_end_clean();
				
			
					echo load_view(array('Load libraries error', $check_error_lib[DEBUG]), 'common/common');
					die();
					
				}
				else
				{

					PhangoVar::$cache_libraries[$library]=1;

				}
								
			}

		}

	}

	return true;

}

/**
* Load a language file...
* 
* Other elegant include function for load language files used by internacionalization. Use multiple files how arguments and search this files on i18n/$lang_code/ and i18n/modules/$name_module/i18n. You can create your files easily use check_language.php command.
*
* @param string $lang_file A list of lang files
*/
/*
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
		
		$lang_file=basename($lang_file);

		if(!isset(PhangoVar::$cache_lang[$lang_file]))
		{

			//First search in module, after in root i18n.

			//echo PhangoVar::$base_path.'modules/'.$lang_file.'/i18n/'.PhangoVar::$language.'/'.$lang_file.'.php';

			//ob_start();

			$module_path=$lang_file;
				
			$pos=strpos($module_path, "_");
			
			if($pos!==false)
			{

				$arr_path=explode('_', $module_path);

				$module_path=$arr_path[0];
				
			}
			
			$path=PhangoVar::$base_path.'modules/'.$module_path.'/i18n/'.PhangoVar::$language.'/';
			
			$file_path=$path.$lang_file.'.php';
			
			if(is_file($file_path))
			{
				include($file_path);
			}
			else
			{

				$path=PhangoVar::$base_path.'i18n/'.PhangoVar::$language.'/';
				$file_path=PhangoVar::$base_path.'i18n/'.PhangoVar::$language.'/'.$lang_file.'.php';
			
				if(!include($file_path)) 
				{
					
					$output=ob_get_contents();
				
					ob_end_clean();
					//'.$output_error_lang.' '.$output.'
					$check_error_lang[1]='Error: Don\'t exists PhangoVar::$lang['.$lang_file.']variable. Do you execute <strong>check_language.php</strong>?.';
					$check_error_lang[0]='Error: Do you execute <strong>check_language.php</strong>?.';

					show_error($check_error_lang[0], $check_error_lang[1], $output);
					die;
				
				}

			}
			
			PhangoVar::$l_[$lang_file]=new PhaLang($lang_file);

			//ob_end_clean();

			PhangoVar::$cache_lang[$lang_file]=1;

		}

	}

}

class PhaLang {

	public $name_lang='';

	public function __construct($name_lang)
	{
	
		$this->name_lang=$name_lang;
	
	}

	public function lang($code_lang, $txt)
	{

		if(!isset(PhangoVar::$lang[$this->name_lang][$code_lang]))
		{
		
			PhangoVar::$lang[$this->name_lang][$code_lang]=$txt;
		
		}
		
		return PhangoVar::$lang[$this->name_lang][$code_lang];

	}

}*/

?>
