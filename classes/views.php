<?php

/**
* Very important function used for load views. Is the V in the MVC paradigm. Phango is an MVC framework and has separate code and html.
*
* load_view is used for load the views. Views in Phango are php files with a function that have a special name with "View" suffix. For example, if you create a view file with the name blog.php, inside you need create a php function called BlogView(). The arguments of this function can be that you want, how on any normal php function. The view files need to be saved on a "view" folders inside of a theme folder, or a "views/module_name" folder inside of a module being "module_name" the name of the module.
*
* @param array $arr_template Arguments for the view function of the view.
* @param string $template Name of the view. Tipically views/$template.php or modules/name_module/views/name_module/$template.php
* @param string $module_theme If the view are on a different theme and you don't want put the view on the theme, use this variable for go to the other theme.
* @param string $load_if_no_cache Variable used if you want the view wasn't if used a first time.
*/

function load_view($arr_template, $template, $module_theme='', $load_if_no_cache=0)
{

	//First see in controller/view/template, if not see in /views/template
	
	$theme=PhangoVar::$dir_theme;
	
	$container_theme=PhangoVar::$module_theme;
	
	$view='';
	
	if(!isset(PhangoVar::$cache_template[$template])) 
	{
		
		//Search view first on an theme
		
		$theme_view=PhangoVar::$base_path.$container_theme.'views/'.$theme.'/'.strtolower($template).'.php';
		
		//Search view on the real module
		
		$script_module_view=PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/views/'.strtolower($template).'.php';
		
		//Search view on other module specified.
		
		$module_view=PhangoVar::$base_path.'modules/'.$module_theme.'/views/'.strtolower($template).'.php';
		
		if(!is_file($theme_view))
		{
		
			if(!is_file($script_module_view))
			{
			
				if(!is_file($module_view))
				{
				
					$output=ob_get_contents();

					ob_clean();
					
					/*include(PhangoVar::$base_path.'views/default/common/common.php');
				
					$template=@form_text($template);

					CommonView('Phango Framework error','<p>Error while loading template <strong>'.$template.'</strong>, check config.php or that template exists... </p><p>Output: '.$output_error_view.'<p>'.$output.'</p>');*/
					
					$check_error_lang[0]='Error while loading template, check that the view exists...';
					$check_error_lang[1]='Error while loading template library '.$template.' in path '.$theme_view.' ,'.$script_module_view.' and '.$module_view.', check config.php or that template library exists... ';

					show_error($check_error_lang[0], $check_error_lang[1], $output);
					
					ob_end_flush();
					
					die;
				
				}
				else
				{
				
					include($module_view);
				
				}
			
			}
			else
			{
			
				include($script_module_view);
			
			}
		
		}
		else
		{
		
			include($theme_view);
		
		}

		//If load view, save function name for call write the html again without call include view too
		
		PhangoVar::$cache_template[$template]=basename($template).'View';

	}
	else 
	if($load_if_no_cache!=0)
	{
			
		return  '';
		
	
	}
	
	ob_start();

	$func_view=PhangoVar::$cache_template[$template];
	
	//Load function from loaded view with his parameters

	call_user_func_array($func_view, $arr_template);

	$out_template=ob_get_contents();

	ob_end_clean();
	
	return $out_template;

}

/**
* Function for load multiple views for a only source file.
* 
* Useful for functions where you need separated views for use on something, When you use load_view for execute a view function, the names used for views are in $func_views array.
*
* @param string $template of the view library. Use the same format for normal views. 
* @param string The names of templates, used how template_name for call views with load_view.
*/

function load_libraries_views($template, $func_views=array())
{
	
	$theme=PhangoVar::$dir_theme;

	$container_theme=PhangoVar::$module_theme;
	
	$view='';

	//Load views from a source file...
	
	//Check func views...
	
	$no_loaded=0;

	foreach($func_views as $template_check)
	{

		if(isset(PhangoVar::$cache_template[$template_check]))
		{
			//Function view loaded, return because load_view load the function automatically.
		
			$no_loaded++;
		
		}

	}
	
	if($no_loaded==0)
	{	
		if(!include_once(PhangoVar::$base_path.$container_theme.'views/'.$theme.'/'.strtolower($template).'.php')) 
		{
			
			$output_error_view=ob_get_contents();

			ob_clean();

			if(!include_once(PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/views/'.strtolower($template).'.php')) 
			{

				$output=ob_get_contents();

				ob_clean();
				
				$check_error_lang[0]='Error while loading template library, check config.php or that template library exists... <p></p>';
				$check_error_lang[1]='<p>Error while loading template library <strong>'.$template.'</strong>, check config.php or that template library exists... </p><p>Output: '.$output_error_view.$output;

				show_error($check_error_lang[0], $check_error_lang[1], $output);
				
				die;

			}

		}
		
	}
	
	//Forever register views if the code use different functions in a same library.
	
	foreach($func_views as $template)
	{

		PhangoVar::$cache_template[$template]=basename($template).'View';

	}


}

/**
* Function used for create code in a home view from a children view. You can include javascript or load directly css with this utility
*
* This function use the static array called PhangoVar::$arr_cache_header. 
*
* For example, you have a view that need a javascript code on <head> html code for work. You can create a new array item in PhangoVar::$arr_cache_header with the javascript code and phango load the code in home view (if home view have call to this function, of course).
*/

function load_header_view()
{

	//Delete repeat scripts...

	PhangoVar::$arr_cache_header=array_unique(PhangoVar::$arr_cache_header, SORT_STRING);
	
	ksort(PhangoVar::$arr_cache_header);

	return implode("\n", PhangoVar::$arr_cache_header)."\n";

}

/**
* A function for load all files into media folder, on application, theme view, or module.
* 
* The files are in media folders into application folder, themes or modules.
*
* @param string $name_media The name of the file, you can use a relative path.
* @param string $module If the media are in a module, put here the module name.
* 
*/

function get_url_media($name_media, $module='none')
{

	if($module=='')
	{
	
		$module='none';
		
	}

	return make_fancy_url(PhangoVar::$media_url, 'media', 'show', array('module' => $module, 'media' => $name_media));

}

/**
* A function for get the base url of a static media file placed into media folder under application. 
*
* @param string $module If the media are in a module, put here the module name.
* @param string $directory The relative path to the folder with media.
* 
*/

function get_base_url_media_static($module, $directory)
{

	return PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$module.'/'.$directory;

}

/**
* A function for get the url of a dynamic media file placed into media folder on a module, . 
*
* @param string $module If the media are in a module, put here the module name.
* @param string $directory The relative path to the folder with media. 
*
*/

function get_base_url_media_dynamic($module, $directory)
{

	return make_fancy_url(PhangoVar::$media_url, 'media', 'show', array('module' => $module, 'directory' => $directory));

}

/**
* A function for get the url of a static image file placed into media/images folder under application. 
*
* @param string $img_name The name of image, you can use a relative path. Example: myfolderimage/image.jpg
* @param string $module If the media are in a module, put here the module name.
* 
*/

function get_url_image_static($img_name, $module='')
{
	
	//$module.='/';
	$arr_module[$module]=$module.'/';
	$arr_module['']='';
	$arr_module['none']='';
	
	
	return PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$arr_module[$module].'images/'.$img_name;
	
}

/**
* A function for get the url of a dynamic image file placed into media/images folder under theme or module folders. 
*
* @param string $img_name The name of image, you can use a relative path. Example: myfolderimage/image.jpg
* @param string $module If the media are in a module, put here the module name.
* 
*/

function get_url_image_dynamic($img_name, $module='')
{
	
	return get_url_media('images/'.$img_name, $module);
	
}

/**
* Internal function for load static css files based in info found on array PhangoVar::$arr_cache_css
*/

function load_css_view_static()
{

	//Delete repeat scripts...

	PhangoVar::$arr_cache_css=array_unique(PhangoVar::$arr_cache_css, SORT_REGULAR);
	$arr_final_css=array();

	foreach(PhangoVar::$arr_cache_css as $idcss => $css)
	{
	
			if(gettype($css)=='array') {
			
					foreach($css as $css_item)
					{
					
							$arr_final_css[]='<link href="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$idcss.'/css/'.$css_item.'" rel="stylesheet" type="text/css"/>'."\n";
					
					}
			
			}
			else
			{
					$arr_final_css[]='<link href="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/css/'.$css.'" rel="stylesheet" type="text/css"/>'."\n";
			}
	}

	return implode("\n", $arr_final_css)."\n";

}

/**
* Internal function for load dynamic css files based in info found on array PhangoVar::$arr_cache_css
*/

function load_css_view_dynamic()
{

	//Delete repeat scripts...

	PhangoVar::$arr_cache_css=array_unique(PhangoVar::$arr_cache_css, SORT_REGULAR);
	$arr_final_css=array();

	foreach(PhangoVar::$arr_cache_css as $idcss => $css)
	{
			
		$module_css='none';
		
		if(gettype($css)=='array') {
				
			$module_css=$idcss;
				
			$css=array_unique($css, SORT_REGULAR);
				
			foreach($css as $css_item)
			{
				
				$url=get_url_media('css/'.$css_item, $module_css);
				
				$arr_final_css[]='<link href="'.$url.'" rel="stylesheet" type="text/css"/>'."\n";
			}
		}
		else
		{
				
			$url=get_url_media('css/'.$css, $module_css);
			
			$arr_final_css[]='<link href="'.$url.'" rel="stylesheet" type="text/css"/>'."\n";

		}
	}

	return implode("\n", $arr_final_css)."\n";

}

/**
* Internal function for load static jscript (AKA javascript) files based in info found on array PhangoVar::$arr_cache_jscript
*/

function load_jscript_view_static()
{
	//Delete repeat scripts...

	PhangoVar::$arr_cache_jscript=array_unique(PhangoVar::$arr_cache_jscript, SORT_REGULAR);
	
	$arr_final_jscript=array();

	foreach(PhangoVar::$arr_cache_jscript as $idjscript => $jscript)
	{
	
			if(gettype($jscript)=='array') {
			
					foreach($jscript as $jscript_item)
					{
					
							$arr_final_jscript[]='<script language="javascript" src="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$idjscript.'/jscript/'.$jscript_item.'"></script>'."\n";
					
					}
			
			}
			else
			{
					$arr_final_jscript[]='<script language="Javascript" src="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/jscript/'.$jscript.'"></script>'."\n";
			}
	}

	return implode("\n", $arr_final_jscript)."\n";
}

/**
* Internal function for load dynamic jscript (AKA javascript) files based in info found on array PhangoVar::$arr_cache_jscript
*/

function load_jscript_view_dynamic()
{
	//Delete repeat scripts...

	PhangoVar::$arr_cache_jscript=array_unique(PhangoVar::$arr_cache_jscript, SORT_REGULAR);
	
	$arr_final_jscript=array();

	foreach(PhangoVar::$arr_cache_jscript as $idjscript => $jscript)
	{
			
			$module_jscript='none';
			
			if(gettype($jscript)=='array') {
					
					$module_jscript=$idjscript;
					
					$jscript=array_unique($jscript, SORT_REGULAR);
					
					foreach($jscript as $jscript_item)
					{
							
							$url=get_url_media('jscript/'.$jscript_item, $module_jscript);
							
							$arr_final_jscript[]='<script language="javascript" src="'.$url.'"></script>'."\n";
					}
			}
			else
			{
					
					$url=get_url_media('jscript/'.$jscript, $module_jscript);
					
					$arr_final_jscript[]='<script language="javascript" src="'.$url.'"></script>'."\n";

			}
	}
	
	return implode("\n", $arr_final_jscript)."\n";
}

/**
* Default values for make media functions 
*
*/

PhangoVar::$arr_func_media=array('get_url_image' => 'get_url_image_static', 'load_css_view' => 'load_css_view_static', 'load_jscript_view' => 'load_jscript_view_static', 'get_base_url_media' => 'get_base_url_media_static');

/**
* Function for obtain an url of an image file. 
*
* The images can be load statically or dinamically.
*
* When you load dinamically, obtain a url that point to media module. The files are placed in a module or in a theme. If the file is in a module the path will be PhangoVar::$base_path/modules/name_module/medua/images/image_name.jpg, if not the path will be $base_path/views/theme_name/media/images/image_name.jpg
*
* When you load statically, obtain an url based on PhangoVar::$base_url. The images are saved on the chosen theme, into of PhangoVar::$base_url/media/theme_name/images. If you have specified a $module variable, the image file will be found in PhangoVar::$base_url/media/theme_name/images
*
* @param $img_name The name of image file. You can use a relative path. Example: icons/icon.jpg
* @param $module The module where the image is searched
*
*/

function get_url_image($img_name, $module='')
{

	$func=PhangoVar::$arr_func_media['get_url_image'];

	return $func($img_name, $module);

}

/**
* Function for obtain an url of a css file. 
*
* The css can be load statically or dinamically.
*
* When you load dinamically, obtain a url that point to media module. The files are placed in a module or in a theme. If the file is in a module the path will be PhangoVar::$base_path/modules/name_module/media/css/file.css, if not the path will be $base_path/views/theme_name/media/css/file.css
*
* When you load statically, obtain an url based on PhangoVar::$base_url. The css are saved on the chosen theme, into of PhangoVar::$base_url/media/theme_name/css. If you have specified a $module variable, the css file will be found in PhangoVar::$base_url/media/theme_name/css
*
* The function don't have parameters, for load the css you can use an static array property called PhangoVar::$arr_cache_css, 
* Example: PhangoVar::$arr_cache_css[]='file.css' If you use a css from a module you can use PhangoVar::$arr_cache_css['module_name'][]='file.css' where module_name is the name of the module
*
*/

function load_css_view()
{

	$func=PhangoVar::$arr_func_media['load_css_view'];

	return $func();

}

/**
* Function for obtain an url of a jscript file (AKA jscript=javascript file). 
*
* The jscript can be load statically or dinamically.
*
* When you load dinamically, obtain a url that point to media module. The files are placed in a module or in a theme. If the file is in a module the path will be PhangoVar::$base_path/modules/name_module/media/jscript/file.jscript, if not the path will be $base_path/views/theme_name/media/jscript/file.jscript
*
* When you load statically, obtain an url based on PhangoVar::$base_url. The jscript are saved on the chosen theme, into of PhangoVar::$base_url/media/theme_name/jscript. If you have specified a $module variable, the jscript file will be found in PhangoVar::$base_url/media/theme_name/jscript
*
* The function don't have parameters, for load the jscript you can use an static array property called PhangoVar::$arr_cache_jscript, 
* Example: PhangoVar::$arr_cache_jscript[]='file.jscript' If you use a jscript from a module you can use PhangoVar::$arr_cache_jscript['module_name'][]='file.jscript' where module_name is the name of the module
*
*/

function load_jscript_view()
{

	$func=PhangoVar::$arr_func_media['load_jscript_view'];

	return $func();

}

/**
* Function used for create a base url used for media urls
*
* @param string $module The module where find the media files
* @param string $directory Base directory
*/

function get_base_url_media($module, $directory)
{
		
	$func=PhangoVar::$arr_func_media['get_base_url_media'];
		
	return $func($module, $directory);

}

function set_flash($text)
{

	$_SESSION['flash_txt']=$text;

}
	
function show_flash()
{

	if(isset($_SESSION['flash_txt']))
	{
		if($_SESSION['flash_txt']!='')
		{
			$text=$_SESSION['flash_txt'];
			
			$_SESSION['flash_txt']='';
		
			return load_view(array($text), 'common/utilities/flash');
			
		}
	}
	
	return '';

}

?>