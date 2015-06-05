<?php

//Loading libraries with includes, don't need more sofisticated methods...

ob_start();

ini_set('html_errors', 0);

include(__DIR__.'/classes/phangovar.php');
include(__DIR__.'/classes/datetimenow.php');
include(__DIR__.'/classes/webmodel.php');
include(__DIR__.'/classes/controllerswitchclass.php');
include(__DIR__.'/classes/utilities.php');
include(__DIR__.'/classes/urls.php');
include(__DIR__.'/classes/views.php');
include(__DIR__.'/classes/loaders.php');

include('config.php');

load_libraries(array('database/'.TYPE_DB), PhangoVar::$base_path);

load_lang('common');

//Load extra libraries

load_libraries(array('fields/corefields'));
load_libraries(array('forms/coreforms'));

load_urls();

date_default_timezone_set (MY_TIMEZONE);

$utility_cli=1;

//load_lang('common', 'user');

$model=array();

//Check arguments

define('OPTS', 'm:c:');

$longopts=array();

$options = getopt(OPTS, $longopts);

if(!isset($options['m']) && !isset($options['c']))
{

	die("Use: php cli.php -m=module -c=cli_controller [more arguments for daemon]\n");

}

$module=@form_text(basename($options['m']));

$cli_controller=@form_text(basename($options['c']));

//Include cli_controller

if(include(PhangoVar::$base_path.'modules/'.$module.'/cli/controller_'.$cli_controller.'.php'))
{

	$script_base_controller=$module;

	$function_cli=$cli_controller.'Cli';

	if( function_exists($function_cli) )
	{
	
		$function_cli();
	
	}

}
else
{

	die("Error: Don't exists the controller for cli statement...\n");

}

function get_opts_cli($my_opts, $arr_opts=array())
{

	return getopt(OPTS.$my_opts, $arr_opts);

}

?>