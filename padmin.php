<?php

//Loading libraries with includes, don't need more sofisticated methods...
//In the future can update files independently
ob_start();

ini_set('html_errors', 0);

include('classes/webmodel.php');
include('config.php');
//Load extra libraries

load_libraries(array('database/'.TYPE_DB), PhangoVar::$base_path);
load_libraries(array('fields/corefields', 'forms/coreforms', 'update_table'));

load_lang('common', 'error_model');

/*include_once('database/'.TYPE_DB.'.php');
include_once('libraries/update_table.php');*/

load_urls();

$utility_cli=1;

$config_data['dir_theme']='default';

//load_lang('common', 'user');

PhangoVar::$model=array();

//Check arguments

if($argc<2)
{

	die("Use: php padmin.php model [file_model]\n");

}

//Connect to database

$connection='';

$connection=webtsys_connect(PhangoVar::$host_db['default'], PhangoVar::$login_db['default'], PhangoVar::$pass_db['default']);

if(! (  $connection && webtsys_select_db(PhangoVar::$db['default']) ) )
{

	die("Error: ".webtsys_error()." - I can't connect to database\n");

}

//Load cache for can use load_model

$query=webtsys_query(SQL_SHOW_TABLES);

while(list($table)=webtsys_fetch_row($query))
{

	$arr_check_table[$table]=1;

}

//Obtain name file...

$argv[1]=basename($argv[1]);

if(!isset($argv[2]))
{

	$argv[2]=$argv[1];

}

$dir_models='modules/'.$argv[1].'/models/';

$arr_padmin_mod=array();

if(file_exists('modules/'.$argv[1].'/models/models_'.$argv[2].'.php'))
{

	//If is a file, update this file...

	if(!include('modules/'.$argv[1].'/models/models_'.$argv[2].'.php'))
	{
	
		die("Don't exist ".$argv[2]." in modules/".$argv[1]."/models\n");
	
	}
	
	//Now load extensions for this model...
	if(file_exists('modules/'.$argv[1].'/models/extension_'.$argv[2].'.php'))
	{
	
		load_extension($argv[2]);
		
	}

	//Update modules...

	$arr_padmin_mod[$argv[1]]=str_replace('.php', '', $argv[2]);
	
}

//Update/Insert table with primitive function update_table

update_table(PhangoVar::$model);

/*if(!isset($model['module']))
{

	include('modules/modules/models/models_modules.php');
}*/

//Add modules if this model is a base module and don't have module row

//add_module($arr_padmin_mod);

//Here execute a php script with post_install function, for example, populating data.

$post_install_script=PhangoVar::$base_path.'modules/'.$argv[1].'/install/post_install.php';

$post_install_lock=PhangoVar::$base_path.'modules/'.$argv[1].'/install/lock';

if(file_exists($post_install_script) && !file_exists($post_install_lock))
{

	echo "Executing post_install script...\n";

	include($post_install_script);

	if(post_install())
	{
	
		if(!file_put_contents($post_install_lock, 'installed'))
		{
		
			echo "Done, but cannot create this file: ".$post_install_lock.". Check your permissions and create the file if the script executed satisfally \n";
		
		}
		else
		{
		
			echo "Done\n";
		
		}
	
	}
	else
	{
	
		echo "Error, please, check ${post_install_script} file and execute padmin.php again\n";
	
	}

}

echo "All things done\n";

ob_end_flush();

?>
