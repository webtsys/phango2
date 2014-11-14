<?php

class IndexSwitchClass extends ControllerSwitchClass {


	public function index()
	{
		ob_start();

		//global $model, $lang, PhangoVar::$base_url, PhangoVar::$base_path, $user_data, $arr_module_admin, $config_data, $arr_block, $original_theme, $module_admin, $header;
		
		$header='';
		$content='';
		
		load_lang('admin');
		load_libraries(array('check_admin', 'utilities/set_admin_link'));

		settype($_GET['IdModule'], 'integer');

		$original_theme=PhangoVar::$dir_theme;

		PhangoVar::$dir_theme=$original_theme;

		$arr_block='admin/admin_none';
		
		$extra_urls=array();

		//Make menu...
		//Admin was internationalized
		
		if(check_admin($user_data['IdUser']) || $user_data['privileges_user']==1)
		{

			//variables for define titles for admin page

			$title_admin=PhangoVar::$lang['admin']['admin'];
			$title_module=PhangoVar::$lang['admin']['home'];
			
			$content='';

			$name_modules=array();

			$urls=array();
			
			$arr_permissions_admin=array();
			$arr_permissions_admin[0]=1;

			$module_admin=array();

			$arr_admin_script[0]=array('admin', 'admin');
			
			//Define $module_admin[$_GET['IdModule']] for check if exists in database the module

			$module_admin[$_GET['IdModule']]='AdminIndex';

			PhangoVar::$lang[$module_admin[$_GET['IdModule']].'_admin']['AdminIndex_admin_name']=ucfirst(PhangoVar::$lang['admin']['admin']);

			$query=PhangoVar::$model['module']->select('where admin=\'1\'', array('IdModule', 'name', 'admin_script'));

			while( list($idmodule, $name_module, $ser_admin_script)=webtsys_fetch_row($query) )
			{
		
				$arr_admin_script[$idmodule]=unserialize($ser_admin_script);

				//load little file lang with the name for admin. With this you don't need bloated with biggest files of langs...

				$dir_lang_admin='';

				if($arr_admin_script[$idmodule][0]!=$arr_admin_script[$idmodule][1])
				{

					$dir_lang_admin=$arr_admin_script[$idmodule][0].'_';

				}

				load_lang($dir_lang_admin.$name_module.'_admin');
				
				if(!isset(PhangoVar::$lang[$name_module.'_admin'][$name_module.'_admin_name']))
				{

					$name_modules[$name_module]=ucfirst($name_module);
					PhangoVar::$lang[$name_module.'_admin'][$name_module.'_admin_name']=ucfirst($name_modules[$name_module]);
				
				}
				else
				{
					
					$name_modules[$name_module]=ucfirst(PhangoVar::$lang[$name_module.'_admin'][$name_module.'_admin_name']);

				}

				$urls[$name_module]=set_admin_link($name_module, array('IdModule' => $idmodule)); //(PhangoVar::$base_url, 'admin', 'index', $name_module, array('IdModule' => $idmodule));

				$module_admin[$idmodule]=$name_module;
				
				$arr_permissions_admin[$idmodule]=1;

			}

			$file_include=PhangoVar::$base_path.'modules/'.$arr_admin_script[ $_GET['IdModule'] ][0].'/controllers/admin/admin_'.$arr_admin_script[ $_GET['IdModule'] ][1].'.php';
			
			if($user_data['privileges_user']==1)
			{
			
				$arr_permissions_admin=array();
				//$arr_module_saved=array();
				$arr_module_strip=array();
				
				$arr_permissions_admin[$_GET['IdModule']]=0;
				$arr_permissions_admin[0]=1;
			
				$query=PhangoVar::$model['moderators_module']->select('where moderator='.$user_data['IdUser'], array('idmodule'), 1);
				
				while(list($idmodule_mod)=webtsys_fetch_row($query))
				{
				
					settype($idmodule_mod, 'integer');
					
					$arr_permissions_admin[$idmodule_mod]=1;
					
					$arr_module_saved[]=$module_admin[$idmodule_mod];
					
				}
				
				$arr_module_strip=array_diff( array_keys($name_modules), $arr_module_saved );
				
				foreach($arr_module_strip as $name_module_strip)
				{
					
					unset($name_modules[$name_module_strip]);
					unset($urls[$name_module_strip]);
				
				}
				
				
			}
			
			if(file_exists($file_include) && $module_admin[$_GET['IdModule']]!='' && $arr_permissions_admin[$_GET['IdModule']]==1)
			{
				
				include($file_include);

				$func_admin=$module_admin[$_GET['IdModule']].'Admin';
				
				if(function_exists($func_admin))
				{	

					echo '<h1>'.PhangoVar::$lang[$module_admin[$_GET['IdModule']].'_admin'][$module_admin[$_GET['IdModule']].'_admin_name'].'</h1>';

					$extra_data=$func_admin();

				}
				else
				{

					$arr_error[0]='Error: no exists function for admin application';
					$arr_error[1]='Error: no exists function '.ucfirst($func_admin).' for admin application';
					ob_clean();
					echo load_view(array('title' => 'Phango site is down', 'content' => '<p>'.$arr_error[DEBUG].'</p>'), 'common/common');
					die();

				}

			}
			else if($module_admin[$_GET['IdModule']]!='')
			{

				$arr_error[0]='Error: no exists file for admin application';
				$arr_error[1]='Error: no exists file '.$file_include.' for admin application';
				ob_clean();
				echo load_view(array('title' => 'Phango site is down', 'content' => '<p>'.$arr_error[DEBUG].'</p>'), 'common/common');
				die();


			}

			$content=ob_get_contents();
		
			ob_end_clean();
			
			echo load_view(array('header' => $header, 'title' => PhangoVar::$lang['admin']['admin_zone'], 'content' => $content, 'name_modules' => $name_modules, 'urls' => $urls , 'extra_data' => $extra_data), 'admin/admin');

		}
		else
		{
			$url_admin=set_admin_link('home', array());
			
			die(header('Location: '.make_fancy_url(PhangoVar::$base_url, 'user', 'index', 'login', array('register_page' => urlencode_redirect($url_admin)), true ) ));
			
		}
	
	}
	
}

?>