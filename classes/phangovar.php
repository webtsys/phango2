<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package phangovar
*
*/


// First, define basic variables

/**
* Class for basic variables for phango. 
*
* This variables are used for basic configuration of phango
* 
*/

class PhangoVar {

	/**
	* Variable for save ip
	*/

	static public $ip='';
	
	/**
	* Database hosts array.
	*/
	
	static public $host_db=array();

	/**
	* Database hosts array.
	*/
	
	static public $db=array();
	
	static public $login_db=array();
	
	static public $pass_db=array();
	
	/**
	* Connection to db.
	*/
	
	static public $connection=array();
	
	/**
	* Variable for cache the connections.
	*/

	static public $connection_func=array();
	
	/**
	* Array where the select_db's are saved.
	*
	*/
	
	static public $select_db=array();
	
	/**
	* String where save the query if error.
	*/
	
	static public $save_query=array();
	
	/**
	* Variable for the db prefix. For security, change this always.
	*/
	
	static public $prefix_db='';
	
	/**
	* Variable for the cookie path. Normally the value is /, but if you install is in a subdirectory you need fill this value with the value of the subdirectory. For example, for a folder called phango you can use a value how this: '/phango/'
	*/
	
	static public $cookie_path='';
	
	/**
	* base url, without last slash. Put here tipically, the url of home page of your site.
	*/
	
	static public $base_url='';
	
	/**
	* base url for media, if you want put this on other server, without last slash. Put here tipically, the same value thar $base_url.
	*/
	
	static public $media_url='';
	
	/**
	* base path, the REAL PATH where you have installed phango. Example: /home/username/phango_folder/. With last slash.
	*/
	
	static public $base_path='../';
	
	/**
	* media path, the REAL PATH where you want install the media files.
	*/
	
	static public $media_path='../';
	
	/**
	* Path where the application path is installed.
	*/
	
	static public $application_path='';
	
	/**
	* Path where addons based on composer are installed.
	*/
	
	static public $addons_composer_path='';
	
	/**
	* Default i18n language used by the framework.
	*/
	
	static public $language='';
	
	/**
	* An array where the language strings are saved. The format is, first key is the module where the string is and second key is the codename of the string.
	*/
	
	static public $lang=array();
	
	/**
	* An array used for show the strings with an agnostic method. When you use load_lang, a new element is saved in this array with the name of the lang file and you show the message string using static method from PhangoVar $l_['name_lang']->lang('code_lang', 'txt default lang');
	*/
	
	static public $l_=array();
	
	/**
	* An array where provided languages are saved
	*/
	
	static public $arr_i18n=array();
	
	/**
	* An array where provided ckeditor languages are saved
	*/
	
	static public $arr_i18n_ckeditor=array();
	
	/**
	* An array where provided tinycme languages are saved
	*/
	
	static public $arr_i18n_tinycme=array();
	
	/**
	* The value of this property is used how the home module. When not module will be specified on url, phango use this value how module base, with controller_index how controller and index how action method.
	*/
	
	static public $app_index='';

	/**
	* Array where you define activated modules. An activated module is the module that you can access via http.
	*/

	static public $activated_modules=array('media');

	/**
	* Variable for define the theme, by default is 'default'
	*/

	static public $dir_theme='default';

	/**
	* Is theme are in a module, define the module here.
	*/
	
	static public $module_theme='';
	
	/**
	* This "constant" define that the media are in a module or view if is set to 1. If 0, phango search the media in a normal url.
	*/
	
	static public $THEME_MODULE=1;

	/**
	* A key use for fuzzy tokens and secret keys.
	*/

	static public $prefix_key='';	
	
	/**
	* Global variable used for padmin and modules module for insert sql sentences when you install or add a new module or model
	*/

	static public $arr_module_sql=array();
	
	
	/**
	* Global variable used for padmin and modules module for insert a new module on database.
	*/

	static public $arr_module_insert=array();
	
	/**
	* Global variable used for padmin and modules module for remove a module of the database.
	*/

	static public $arr_module_remove=array();
	
	/**
	* Internal variable used for things how cli.php script
	*/

	static public $utility_cli=0;
	
	/**
	*This variable is needed for add new fields to models without lost when you execute load_model without extension. Is saved in optional file added_fields.php
	*/

	static public $arr_models_loading=array();
	
	/**
	* Define the website name, can be used for general titles on home or for example admin
	*/
	
	static public $portal_name='';
	
	/**
	* Variable that define a global email used for communications of phango
	*/
	
	static public $portal_email='';
	
	/**
	* Variable that define a global date format for use with format date functions
	*/
	
	static public $date_format='';
	
	/**
	* Variable that define a global time format for use with format time functions
	*/
	
	static public $time_format='';
	
	/**
	* Variable that define the timezone of the application
	*/
	
	static public $timezone='';
	
	/**
	*
	* Variable that define if time format will be with amp/pm format or 24h format. With time_format and date format edited directly, don't need this method anymore. 
	*/
	
	static public $ampm='';
	
	/**
	* Variable used for set the textbb_type for textarea elements
	*
	*/
	
	static public $textbb_type='';
	
	/**
	* Variable used for set the captcha type used for internal libraries.
	*
	*/
	
	static public $captcha_type='';
	
	/**
	* Variable used for set the mailer class type, used for internal library send_email
	*
	*/
	
	static public $mailer_type='';
	
	/**
	* Model, in this array you have access to the all models registered on your system with load_model
	*/
	
	static public $model=array();
	
	/**
	* Global Internal Array for save the field codified for use in public forms.
	*/

	static public $arr_form_public=array();
	
	/** 
	* Array for check if a model exists searching in arr_check_table array created in framework.php file.
	*/
	
	static public $arr_check_table=array();
	
	/**
	* An internal variable used for internal cache for load_view.
	*/

	static public $cache_template=array();

	/**
	* An internal variable used for save the actual module that is used for construct the base directory for controllers.
	*
	* A module CANNOT use underscores. If you need have i18n files for distinct identifier on the same module, check_language.php use underscores for detect father ident and children ident.
	*/
	
	static public $script_module='';
	
	/**
	* An internal variable used for save the actual controller that is used for set the name of controller file
	*
	*/
	
	static public $script_controller='';
	
	/**
	* An internal variable used for save the actual controller that is used for set the name of controller file
	*
	*/
	
	static public $script_action='';
	
	/**
	* Internal global variable used for load_model for cache loaded models.
	*/

	static public $cache_model=array();
	
	/**
	* Internal variable used for load model extensions.
	*/
	
	static public $arr_extension_model=array();
	
	/**
	* An array used for control the loaded libraries previously.
	*/

	static public $cache_libraries=array();

	/**
	* Array used for know about language filed loaded.
	*/
	
	static public $cache_lang=array();
	
	/**
	* Array used for load contents for html headers on home views...
	*/
	
	static public $arr_cache_header=array();
	
	/**
	* Global variable that control the css cache
	*/

	static public $arr_cache_css=array();
	
	/**
	* Variable used for load the jscript files.
	*/

	static public $arr_cache_jscript=array();
	
	/**
	*This variable is used for save general errors. 
	*/

	static public $std_error=''; 
	
	/**
	* This variable is used for save the urls of different modules
	*/
	
	static public $urls=array();
	
	static public $rurls=array();
	
	/**
	* This variable is used for save the actual url
	*/
	
	static public $actual_url=array();
	
	/**
	* This variable is used for save the csrf token.
	*/
	
	static public $key_csrf='';
	
	/**
	* This array save the get obtained from url phango format.
	*/
	
	static public $get=array();
	
	/**
	* This array is used for check that urls need the module for use. Use this on urls.php. If you load only urls, you don't need 
	*/
	
	static public $url_module_requires=array();
	
	/**
	* Simple internal variable used for pagination functions.
	*/
	
	static public $begin_page=0;
	
	/**
	* Array where phango save the actual functions used for load media files
	*
	*/
	
	static public $arr_func_media=array();
	
	/**
	* Array for check if a normal user can read a list on selectwindowform
	*
	*/
	
	static public $arr_module_list_form=array();
	
}

/**
* Initial variables setting
*/

PhangoVar::$arr_i18n_ckeditor = array('es-ES' => 'es.js','en-US' => 'en.js');
PhangoVar::$arr_i18n_tinycme = array('es-ES' => 'es.js','en-ES' => 'en.js');

?>
