<?php

class ShowMediaSwitchClass extends ControllerSwitchClass {

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

	public function show($module, $media_file)
	{
	
		$media_file=$this->check_path($media_file);

		//theme path, can be a module theme. If module_theme_loaded exists, rewrite.
		
		$file_path=PhangoVar::$media_path.$this->container_theme.'views/'.$this->theme.'/media/'.$this->module_theme_loaded.$media_file;
		
		$file_path_old='';
		
		$check_file=0;
			
		//first on normal theme or module theme.
		
		if(!file_exists($file_path))
		{
		
			//file in module path.
			
			$file_path_old=$file_path;
			
			$file_path=PhangoVar::$media_path.'modules/'.$this->module_theme_loaded.'media/'.$media_file;
			
			if(!file_exists($file_path))
			{
			
				show_error('Don\'t exists the image', 'Don\'t exists the image with path: '.$file_path.' and '.$file_path_old, $output_external='');
				
				die;
			
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
		
		/*$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$type_mime=finfo_file($finfo, $file_path);
		finfo_close($finfo);
		
		if($type_mime=='text/x-c')
		{
		
			$type_mime='text/css';
		
		}*/
		
		$ext_info=pathinfo($media_file);
		
		settype($ext_info['extension'], 'string');
		
		switch($ext_info['extension'])
		{
		
			default:
			
				$type_mime='text/plain';
			
			break;
			
			case 'js':
			
				$type_mime='application/javascript';
			
			break;
			
			case 'css':
			
				$type_mime='text/css';
			
			break;
			
			case 'gif':
			
				$type_mime='image/gif';
			
			break;
			
			case 'png':
			
				$type_mime='image/png';
			
			break;
			
			case 'jpg':
			
				$type_mime='image/jpg';
			
			break;
		
		}
		
		if($check_file==1)
		{
		
			header('Content-Type: '.$type_mime);
		
			readfile($file_path);
		
		}
		else
		{
		
			show_error('Don\'t exists the image', 'Don\'t exists the image with path: '.$file_path, $output_external='');
		
		}
		
		
		

	}

}



?>