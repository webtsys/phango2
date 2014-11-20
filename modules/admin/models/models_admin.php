<?php

load_lang('admin');
load_libraries(array('fields/passwordfield', 'models/userphango'));

PhangoVar::$model['user_admin']=new UserPhangoModel('user_admin');

PhangoVar::$model['user_admin']->set_component('username', 'CharField', array(25), 1);

PhangoVar::$model['user_admin']->set_component('password', 'PasswordField', array(255), 1);

PhangoVar::$model['user_admin']->set_component('email', 'EmailField', array(255), 1);

PhangoVar::$model['user_admin']->set_component('privileges_user', 'ChoiceAdminField', array($size=11, $type='string', $arr_values=array(0, 1), $default_value=1));

PhangoVar::$model['user_admin']->set_component('token_client', 'CharField', array(255));

PhangoVar::$model['user_admin']->set_component('token_recovery', 'CharField', array(255));

PhangoVar::$model['login_tried_admin']=new Webmodel('login_tried_admin');

PhangoVar::$model['login_tried_admin']->set_component('ip', 'CharField', array(255));
PhangoVar::$model['login_tried_admin']->set_component('num_tried', 'IntegerField', array(11));
PhangoVar::$model['login_tried_admin']->set_component('time', 'IntegerField', array(11));

class ChoiceAdminField extends ChoiceField {

	static public $arr_options_formated;
	
	static public $arr_options_select;

	public function show_formatted($value)
	{
	
		return ChoiceAdminField::$arr_options_formated[$value];
	
	}

}

ChoiceAdminField::$arr_options_formated=array(0 => PhangoVar::$lang['admin']['administrator'], 1 => PhangoVar::$lang['admin']['moderator']);

ChoiceAdminField::$arr_options_select=array(1, PhangoVar::$lang['admin']['administrator'], 0, PhangoVar::$lang['admin']['moderator'], 1);

class ModuleAdmin {

	//Example: 'admin' => array('admin', 'admin')

	static public $arr_modules_admin=array();

}

?>