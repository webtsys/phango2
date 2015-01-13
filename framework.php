<?php
//Basic framework

ob_start();

include('../classes/webmodel.php');

//Adding config...

if(!include("config.php")) 
{


	PhangoVar::$base_path=str_replace('application/index.php', '', $_SERVER['SCRIPT_FILENAME']);

	$port=':'.$_SERVER['SERVER_PORT'];

	if($port==':80')
	{

		$port='';

	}

	$http='http://';

	if(isset($_SERVER['HTTPS']))
	{

		$http='https://';

	}

	PhangoVar::$cookie_path=str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

	PhangoVar::$base_url=$http.$_SERVER['SERVER_NAME'].$port.''.str_replace('/index.php', '', PhangoVar::$cookie_path);

	PhangoVar::$cookie_path=PhangoVar::$cookie_path.'/';

	//If no config error message
	//This site is no configured...
	
	$error=ob_get_contents();
	
	ob_clean();
	
	echo load_view(array('Phango Framework is installed', '<p>Phango Framework is installed, but you need create config.php</p><p>Copy config_sample.php  to config.php and edit the file</p>'), 'common/common');
	
	die();

}

if(PhangoVar::$THEME_MODULE==1) 
{

	PhangoVar::$arr_func_media=array('get_url_image' => 'get_url_image_dynamic', 'load_css_view' => 'load_css_view_dynamic', 'load_jscript_view' => 'load_jscript_view_dynamic', 'get_base_url_media' => 'get_base_url_media_dynamic');

}

//start session

//Check session_id, if exists $_COOKIE[COOKIE_NAME], change id to COOKIE_NAME id...

if(isset($_COOKIE[COOKIE_NAME]))
{

	session_id($_COOKIE[COOKIE_NAME]);

}

session_name(COOKIE_NAME.'_session');

session_set_cookie_params(0, PhangoVar::$cookie_path);

session_start();

if(!isset($_SESSION['csrf_token']))
{

	$_SESSION['csrf_token']=sha1(uniqid("", true));

}

PhangoVar::$key_csrf=$_SESSION['csrf_token'];

//Timezone

date_default_timezone_set (PhangoVar::$timezone);

DateTimeNow::update_datetime();

//Add ip

//We need the ip


if ( getenv( "HTTP_X_FORWARDED_FOR" ) )
{
	PhangoVar::$ip = trim( nl2br( htmlentities( getenv( "HTTP_X_FORWARDED_FOR" ), ENT_QUOTES) ) );
} 
else
{
	PhangoVar::$ip = trim( nl2br( htmlentities( getenv( "REMOTE_ADDR" ), ENT_QUOTES) ) );
}

load_lang('common', 'error_model');

//Check for csrf attacks and obtain posts if debug.

if(count($_POST)>0)
{

	//Check csrf_token

	settype($_POST['csrf_token'], 'string');

	//If no isset $_POST['csrf_token'] check $_GET['csrf_token']

	if($_POST['csrf_token']!=PhangoVar::$key_csrf)
	{

		//Check if csrf_token in variable basic_csrf for anonymous connect, necessary for gateways payment for example...

		$arr_error_sql[0]='Post denied';
		$arr_error_sql[1]='Post denied. Error in csrf_token';

		show_error($arr_error_sql[0], $arr_error_sql[1], $output_external='');

		die;

	}
	
	unset($_POST['csrf_token']);
	
	//Convert $_POST values
	
	if(!DEBUG)
	{
	
		$arr_post_keys=array_keys($_POST);
		
		$arr_unset_post=array();
		
		foreach($arr_post_keys as $post_key)
		{
			
			if(isset($_SESSION['fields_check'][$post_key]))
			{
				
				$real_name_field=$_SESSION['fields_check'][$post_key];
			
				$_POST[$real_name_field]=&$_POST[$post_key];
						
			}
			
			/*@unset($_SESSION['fields_check'][$post_key]);
			@unset($_SESSION['fields_check'][$real_name_field]);*/
		
		}
		
		if(count($_FILES)>0)
		{
			$arr_files_keys=array($_FILES);
			
			foreach($arr_file_keys as $file_key)
			{
			
				if(isset($_SESSION['fields_check'][$file_key]))
				{
					
					$real_name_field=$_SESSION['fields_check'][$file_key];
				
					$_FILES[$real_name_field]=&$_FILES[$file_key];
				
				}
			
			}
			
		}
		
		unset($_SESSION['fields_check']);
	
	}

}

//Check begin_page variable

settype($_GET['begin_page'], 'integer');

if($_GET['begin_page']<0)
{

	$_GET['begin_page']=0;
	
	PhangoVar::$begin_page=$_GET['begin_page'];

}

load_controller();

ob_end_flush();

?>
