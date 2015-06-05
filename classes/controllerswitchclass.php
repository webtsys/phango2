<?php

/**
* A New class for use methods and not switchs for complex controllers different to old methods in older versions of phango. 
*
* This class is the base for create controllers and actions directed by a PhangoVar::$urls.
*
* @example
*
* class MyAppSwitchClass extends ControllerSwitchClass {
*
*   public function index($argument_from_url) 
* 	{
*
*		echo 'This is a content';
*
*	}
*}
*/

class ControllerSwitchClass {

	public $op_var='action';
	public $controller;
	//public $model, $ip, $lang, $base_path, $base_url, $cookie_path, $arr_block, $prefix_key, $block_title, $block_content, $block_urls, $block_type, $block_id, $text_url, $key_csrf;
	
	/*public function __construct()
	{
	
	
		//$this->user_data=&PhangoVar::$user_data;
		$this->model=&PhangoVar::$model;
		$this->ip=&PhangoVar::$ip;
		$this->lang=&PhangoVar::$lang;
		$this->base_path=&PhangoVar::$base_path;
		$this->base_url=&PhangoVar::$base_url;
		$this->cookie_path=&PhangoVar::$cookie_path;
		$this->prefix_key=&PhangoVar::$prefix_key;
		$this->key_csrf=&PhangoVar::$key_csrf;
		$this->controller=&PhangoVar::$script_controller;
	
	}*/
	
	/**
	* A simple method for obtain an url in the acual controller
	*
	*/
	
	public function get_method_url($method, $arr_parameters=array(), $arr_extra_parameters=array())
	{
		
		/*$my_controller=strtolower(str_replace('SwitchClass', '', get_class($this)));
		
		$arr_parameters[$this->op_var]=$method_controller;*/
		
		return make_fancy_url(PhangoVar::$base_url, PhangoVar::$actual_url[0], $method, $arr_parameters, $arr_extra_parameters);
	
	}
	
	/**
	* A method for make a redirect based on a theme
	*
	*/
	
	public function redirect($direction,$l_text,$text,$ifno)
	{
		
		load_libraries(array('redirect'));
		die( redirect_webtsys( $direction, $l_text, $text, $ifno ) );
	
	}
	
	/**
	* A method for make a redirect based on a theme
	*
	*/
	
	public function load_theme($title, $cont_index)
	{
		
		echo load_view(array($title, $cont_index),'home');
	
	}
	
	/**
	* A method for make a silenced redirect
	* 
	* 
	*/
	
	public function simple_redirect($url)
	{
	
		header('Location: '.$url);
	
		die;
	
	}

}

/**
* Function for load the controller, first, load the urls, and check. With this info, load the controller from the module X and finally, the action.
*
* A very important function used in framework.php, the file used for show webpages rendered using phango. This method process normal and pretty urls and load the controllers.Also make a preview check
*
*/

function load_controller()
{

	//First, load and check urls. 
	
	//$server_host_php='http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	
	//Load urls, you need load this for make_fancy_url
	
	load_urls();
	
	$request_uri=$_SERVER['REQUEST_URI'];
	
	if(PhangoVar::$cookie_path!='/')
	{
		
		$pos=strpos($request_uri, PhangoVar::$cookie_path);
		
		$len=strlen(PhangoVar::$cookie_path);
		
		$request_uri=substr($request_uri, $len);
		
	}
	else
	{
	
		$request_uri=substr($request_uri, 1);
	
	}
	
	$request_uri=str_replace('index.php/', '', $request_uri);
	
	$arr_extra_get=explode('/get/', $request_uri);
	
	//Load Get variables from url
	
	$arr_name_get=array();
	
	if(isset($arr_extra_get[1]))
	{
	
		$arr_variables=explode('/', $arr_extra_get[1]);
	
		$cget=count($arr_variables);

		if($cget % 2 !=0 ) 
		{

			$arr_variables[]='';
			$cget++;
		}

		if($cget % 2 ==0 )
		{
			//Get variables

			for($x=0;$x<$cget;$x+=2)
			{
				
				//Cut big variables...

				$_GET[$arr_variables[$x]]=form_text(urldecode(substr($arr_variables[$x+1], 0, 255)));
				
				$arr_name_get[]=$arr_variables[$x];

			}

		}
	
	}
	
	//Checking get variables.
	
	$arr_key_get=array_keys($_GET);
	
	$arr_set_get=array_diff($arr_key_get, $arr_name_get);
	
	foreach($arr_set_get as $key_check)
	{
		
		$_GET[$key_check]=form_text(urldecode(substr($_GET[$key_check], 0, 255)));
	
	}
	
	//Check begin_page variable

	settype($_GET['begin_page'], 'integer');

	if($_GET['begin_page']<0)
	{

		$_GET['begin_page']=0;
		
		PhangoVar::$begin_page=$_GET['begin_page'];

	}
	
	//Delete $_GET elements.
	
	$request_uri=preg_replace('/\/\?.*$/', '', $request_uri);
	
	//Delete get elements.
	
	$request_uri=preg_replace('/\/get\/.*$/', '', $request_uri);
	
	//Create url for index, used by link generators.
	
	//PhangoVar::$urls['']['']=array('pattern' => '/\/$/', 'url' => '/', 'module' => PhangoVar::$app_index, 'controller' => 'index', 'action' => 'index', 'parameters' => array());
	
	PhangoVar::$urls['']['']=array('action' => 'index', 'parameters' => array());
	
	if($request_uri=='' || $request_uri=='index.php')
	{
		
		PhangoVar::$script_module=PhangoVar::$app_index;
		
		PhangoVar::$script_controller='index';
		
		PhangoVar::$script_action='index';
		
		PhangoVar::$actual_url=array('', '');
	
	}
	else
	{
	
		//Search in 
		
		if($request_uri[strlen($request_uri)-1]=='/')
		{
		
			$request_uri=substr($request_uri, 0, -1);
		
		}
		
		$arr_uri=explode('/', $request_uri);
		
		//Cjeck arr_uri
		
		foreach($arr_uri as $key_uri => $uri)
		{
		
			$arr_uri[$key_uri]=basename(slugify($uri, 1));
		
		}
		
		$search_in=$arr_uri[0];
		
		$yes_match=0;
		
		if(isset(PhangoVar::$urls[$search_in]))
		{
			
			foreach(PhangoVar::$urls[$search_in] as $ident_url => $arr_url)
			{
				
				$pattern=$arr_url['pattern'];
			
				$module=$arr_url['module'];
			
				$controller=$arr_url['controller'];
				
				$action=$arr_url['action'];
				
				if($yes_match==0)
				{
			
					if(preg_match($pattern, $request_uri))
					{
					
						PhangoVar::$script_module=$module;
			
						PhangoVar::$script_controller=$controller;
						
						PhangoVar::$script_action=$action;
						
						//Obtain get parameters.
						
						//Prepare string
						
						$arr_param['string']='slugify_get';
						$arr_param['integer']='integer_get';
						
						$str_param=implode('|', array_keys($arr_url['parameters']));
						
						$str_parameters=preg_replace($pattern, $str_param, $request_uri);
						
						PhangoVar::$get=explode('|', $str_parameters);
						
						$z=0;
						
						foreach($arr_url['parameters'] as $key => $value)
						{
						
							$check_param_func=$arr_param[ $value ];
							
							PhangoVar::$get[$z]=$check_param_func(PhangoVar::$get[$z]);
						
							$z++;
						
						}
						
						PhangoVar::$actual_url=array($search_in, $ident_url);
						
						$yes_match=1;
					
					}
					
				}
			
			}
			
		}
		
		if($yes_match==0)
		{
		
			//Format without pretty urls
			//Url example: https://www.example.com/index.php/wserver2/debian/wheezy/webserver/apache -> /home/repos/wserver2/modules/wserver2/controllers/debian/wheezy/webserver/controller_apache.php
			//For action you need add https://www.example.com/index.php/wserver2/debian/wheezy/webserver/apache/get/action/action_method
			
			PhangoVar::$script_module=$arr_uri[0];
			
			if(!isset($arr_uri[1]))
			{
			
				PhangoVar::$script_controller='index';
			
			}
			else
			{
				
				$arr_get_controller=array_slice($arr_uri, 1, count($arr_uri));
				
				PhangoVar::$script_controller=implode('/', $arr_get_controller);
				
			}
			
			if(!isset($_GET['action']))
			{
			
				$_GET['action']='index';
			
			}
			
			PhangoVar::$script_action=$_GET['action'];
			
		}
	
	}
	
	//Check if all url module dependencies is loaded.
	
	$arr_keys_urls=array_keys(PhangoVar::$urls);
	
	$arr_no_loaded_urls=array_diff(PhangoVar::$url_module_requires, $arr_keys_urls);
	
	foreach($arr_no_loaded_urls as $url_no_loaded)
	{
	
		$output=ob_get_contents();

		ob_clean();

		$arr_no_controller[0]='<p>Don\'t loaded necessary urls..</p>';
		$arr_no_controller[1]='<p>Don\'t loaded necessary urls '.$url_no_loaded.'</p>';

		echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
		
		die;
	
	}
	
	$folder_controller='';
	
	if(preg_match('/^.*\/.*$/', PhangoVar::$script_controller))
	{
		
		$arr_controller=explode('/', PhangoVar::$script_controller);
		
		$c_controller=count($arr_controller)-1;
		
		$folder_controller=implode('/', array_slice($arr_controller, 0, $c_controller)).'/';
		
		PhangoVar::$script_controller=$arr_controller[$c_controller];
	
	}
	
	if(in_array(PhangoVar::$script_module, PhangoVar::$activated_modules)) 
	{
		
		$path_script_controller=PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/controllers/'.$folder_controller.'controller_'.PhangoVar::$script_controller.'.php';
		
		$script_class_name=ucfirst(PhangoVar::$script_controller).'SwitchClass';
		
		//$script_class='index';
		
		if(include($path_script_controller))
		{
			if(class_exists($script_class_name))
			{
				
				//print_r($p->getParameters());
				
				$num_parameters=0;
				
				if(isset(PhangoVar::$get[0]))
				{	
					if(PhangoVar::$get[0]=='')
					{
					
						PhangoVar::$get=array();
					
					}
				}
				else
				{
				
					$p = new  ReflectionMethod($script_class_name, PhangoVar::$script_action); 
					
					$num_parameters=$p->getNumberOfRequiredParameters();
				
					foreach($p->getParameters() as $parameter)
					{
						
						if(isset($_GET[$parameter->name]))
						{
						
							PhangoVar::$get[$parameter->name]=$_GET[$parameter->name];
						
						}
					
					}
				}
				
				$script_class=new $script_class_name();
				
				if(count(PhangoVar::$get)>=$num_parameters)
				{
				
					if(call_user_func_array(array($script_class, PhangoVar::$script_action), PhangoVar::$get)===false)
					{
					
						$output=ob_get_contents();

						ob_clean();

						$arr_no_controller[0]='<p>Don\'t exist controller method</p>';
						$arr_no_controller[1]='<p>Don\'t exist '.PhangoVar::$script_action.' on <strong>'.$path_script_controller.'</strong></p>';

						echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
						
						die;
					
					}
			
				}
				else
				{
				
					$output=ob_get_contents();

						ob_clean();

						$arr_no_controller[0]='<p>Incorrent num of parameters</p>';
						$arr_no_controller[1]='<p>Incorrent num of parameters in '.PhangoVar::$script_action.' from <strong>'.$path_script_controller.'</strong></p>';

						echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
						
						die;
				
				}
			
			}
			else 
			{

				$output=ob_get_contents();

				ob_clean();

				$arr_no_controller[0]='<p>Don\'t exist controller class</p>';
				$arr_no_controller[1]='<p>Don\'t exist '.$script_class_name.' <strong>'.PhangoVar::$script_controller.' folder</strong></p>';

				echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
				
				die;

			}
			
		}
		else
		{
		
			$output=ob_get_contents();

			ob_clean();

			$arr_no_controller[0]='<p>Don\'t exist controller file</p>';
			$arr_no_controller[1]='<p>Don\'t exist '.$path_script_controller.'</p>';

			echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
			
			die;
		
		}
		
	}
	else
	{
	
		$output=ob_get_contents();

		ob_clean();

		$arr_no_controller[0]='<p>Don\'t exist module</p>';
		$arr_no_controller[1]='<p>Don\'t exist module '.PhangoVar::$script_module.' on PhangoVar::$activated_modules or not exists url ['.$search_in.'][]</p></p>';

		echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
		
		die;
	
	}
	
	
	

}

?>