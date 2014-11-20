<?php

class IndexSwitchClass extends ControllerSwitchClass {

	private $theme;
	private $container_theme;
	private $module_theme_loaded;

	public function __construct()
	{
	
		$this->module_theme_loaded=''; //$config_data['module_theme'];
		
		$this->theme=PhangoVar::$dir_theme;
		
		$this->container_theme=PhangoVar::$module_theme;
		
		parent::__construct();
	
	}
	
	public function check_module_theme($module)
	{
	
		if($module!='none')
		{
		
			$this->module_theme_loaded=slugify(basename($module), 1).'/';
		
		}
	
	
	}


	public function image($module, $image)
	{
	
		$this->check_module_theme($module);
		
		$image=check_path(base64_decode($image));
		
		$check_file=0;
			
		$ext_info=pathinfo($image);
		
		settype($ext_info['extension'], 'string');
		
		//$image=check_path($image);
		
		//theme path, can be a module theme. If module_theme_loaded exists, rewrite.
		
		$file_path=PhangoVar::$base_path.$this->container_theme.'views/'.$this->theme.'/media/'.$this->module_theme_loaded.'images/'.$image;
		
		$file_path_old='';
		
		if($ext_info['extension']=='gif' || $ext_info['extension']=='jpg' || $ext_info['extension']=='png')
		{
			
			$check_file=0;
			
			//First on normal theme or module theme.
			
			if(!file_exists($file_path))
			{
			
				//Second on module directly.
			
				$file_path_old=$file_path;
			
				$file_path=PhangoVar::$base_path.'modules/'.$this->module_theme_loaded.'media/images/'.$image;
			
				if(file_exists($file_path))
				{
				
					$check_file=1;
				
				}
				else
				{
				
					show_error('Don\'t exists the image', 'Don\'t exists the image with path: '.$file_path.' and '.$file_path_old, $output_external='');
				
				}
				
				
			
			}
			else
			{
			
				$check_file=1;
			
			}
			
			if($check_file==1)
			{
			
			
				header('Content-Type: image/'.$ext_info['extension']);
			
				readfile($file_path);
			
			}
			else
			{
			
				show_error('Don\'t exists the image', 'Don\'t exists the image with path: '.$file_path, $output_external='');
			
			}
			
		}
		else
		{
		
			show_error('Don\'t exists the image', 'Don\'t exists the image with path: '.$file_path, $output_external='');
		
		}
		
		ob_end_flush();
		
		die;
	
	}
	
	public function css($module, $css)
	{
		
		$this->check_module_theme($module);
	
		$css=check_path(base64_decode($css));
	
		$ext_info=pathinfo($css);
			
		settype($ext_info['extension'], 'string');
		
		$file_path=PhangoVar::$base_path.$this->container_theme.'views/'.$this->theme.'/media/'.$this->module_theme_loaded.'css/'.$css;
		
		if($ext_info['extension']=='css')
		{
			$check_file=0;
		
			//First, theme or module theme
			echo 'pepe';

			if(!file_exists($file_path))
			{
			
				//Second on module.
				
				//$file_path=PhangoVar::$base_path.$config_data['module_theme'].'views/'.$config_data['dir_theme'].'/media/css/'.$css;
			
				$file_path_old=$file_path;
			
				$file_path=PhangoVar::$base_path.'modules/'.$this->module_theme_loaded.'media/css/'.$css;
				
				if(file_exists($file_path))
				{
				
					$check_file=1;
				
				}
				
			
			}
			else
			{
			
				$check_file=1;
			
			}
			
			if($check_file==1)
			{
			
				header('Content-Type: text/css');
			
				readfile($file_path);
			
			}
			else
			{
			
				show_error('Don\'t exists the css file', 'Don\'t exists the css file with path: '.$file_path.' and '.$file_path_old, $output_external='');
			
			}
			
		}
		else
		{
		
			show_error('Don\'t exists the css', 'Don\'t exists the css with path: '.$file_path, $output_external='');
		
		}
		
		ob_end_flush();
		
		die;
	
	}
	
	public function font($module, $font)
	{
	
		$this->check_module_theme($module);
	
		$font=check_path(base64_decode($font));
	
		$ext_info=pathinfo($font);
			
		settype($ext_info['extension'], 'string');
		
		$file_path=PhangoVar::$base_path.$this->container_theme.'views/'.$this->theme.'/media/'.$this->module_theme_loaded.'fonts/'.$font;
		
		$file_path_old='';
		
		if($ext_info['extension']=='ttf')
		{
			$check_file=0;
			
			//normal theme or module theme
			
			if(!file_exists($file_path))
			{
			
				//Second on module.
			
				//$file_path=PhangoVar::$base_path.$config_data['module_theme'].'views/'.$config_data['dir_theme'].'/media/fonts/'.$font;
				
				$file_path_old=$file_path;
			
				$file_path=PhangoVar::$base_path.'modules/'.$this->module_theme_loaded.'media/fonts/'.$font;
			
				if(file_exists($file_path))
				{
				
					$check_file=1;
				
				}
				else
				{
				
					show_error('Don\'t exists the font', 'Don\'t exists the font with path: '.$file_path.' and '.$file_path_old, $output_external='');
				
				}
				
			
			}
			else
			{
			
				$check_file=1;
			
			}
			
			if($check_file==1)
			{
				
				header('Content-Type: application/x-font-woff');
			
				readfile($file_path);
			
			}
			
		}
		else
		{
		
			show_error('Don\'t exists the font', 'Don\'t exists the font with path: '.$file_path, $output_external='');
		
		}
		
		ob_end_flush();
		
		die;
	
	}
	
	public function jscript($module, $jscript)
	{
	
		$this->check_module_theme($module);
	
		$jscript=check_path(base64_decode($jscript));
	
		$ext_info=pathinfo($jscript);
		
		$file_path=PhangoVar::$base_path.$this->container_theme.'views/'.$this->theme.'/media/'.$this->module_theme_loaded.'jscript/'.$jscript;
		
		settype($ext_info['extension'], 'string');
		
		if($ext_info['extension']=='js')
		{
			$check_file=0;
			
			//normal theme or module theme
			
			if(!file_exists($file_path))
			{
			
				//Second on module.
			
				//$file_path=PhangoVar::$base_path.$config_data['module_theme'].'views/'.$config_data['dir_theme'].'/media/fonts/'.$_GET['font'];
				
				$file_path_old=$file_path;
			
				$file_path=PhangoVar::$base_path.'modules/'.$this->module_theme_loaded.'media/jscript/'.$jscript;
			
				if(!file_exists($file_path))
				{
				
					//$check_file=1;
					
					//last look on application/media/jscript, jscript can be standard, images, css, or fonts, not.
					
					$file_path_old.=' and '.$file_path;
			
					$file_path=PhangoVar::$base_path.'application/media/jscript/'.$jscript;
					
					if(file_exists($file_path))
					{
					
						$check_file=1;
					
					}
					else
					{
					
						show_error('Don\'t exists the jscript', 'Don\'t exists the jscript with path: '.$file_path.' and '.$file_path_old, $output_external='');
					
					}
				
				}
				else
				{
				
					$check_file=1;
				
				}
				
			
			}
			else
			{
			
				$check_file=1;
			
			}
			
			if($check_file==1)
			{
				
				header('Content-Type: application/javascript');
			
				readfile($file_path);
			
			}
			else
			{
			
				show_error('Don\'t exists the jscript', 'Don\'t exists the jscript with path: '.$file_path, $output_external='');
			
			}
			
		}
		
		ob_end_flush();
		
		die;
	
	}

}

function check_path($file)
{

	$arr_file=explode('/', $file);
	
	$arr_file_final=array();
	
	/*foreach($arr_file as $file_part)
	{*/
	
	$c=count($arr_file)-1;
	
	for($x=0;$x<$c;$x++)
	{
		if($arr_file[$x]!='')
		{
			$arr_file_final[]=slugify(basename($arr_file[$x]), 1, '-', 1);
			
		}
	
	}
	
	$arr_file_final[]=slugify(basename($arr_file[$x]), 1);
	
	return implode('/', $arr_file_final);

}
/*
function format_media_type($type)
{
	
	$final=urldecode_redirect($_GET[$type]);
	
	if(!$final)
	{
	
		$_GET[$type]=slugify($_GET[$type], 1);
		
	}
	else
	{
	
		$_GET[$type]=$final;
	
	}
	
	$_GET[$type]=str_replace('./', '', form_text($_GET[$type]));

}*/

?>