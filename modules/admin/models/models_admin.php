<?php

load_libraries(array('fields/passwordfield'));

PhangoVar::$model['user_admin']=new Webmodel('user_admin');

PhangoVar::$model['user_admin']->set_component('username', 'CharField', array(25), 1);

PhangoVar::$model['user_admin']->set_component('password', 'PasswordField', array(255), 1);

PhangoVar::$model['user_admin']->set_component('email', 'EmailField', array(255), 1);

PhangoVar::$model['user_admin']->set_component('privileges_user', 'IntegerField', array(11));

PhangoVar::$model['user_admin']->set_component('token_client', 'CharField', array(255));

PhangoVar::$model['user_admin']->set_component('token_recovery', 'CharField', array(255));

PhangoVar::$model['login_tried_admin']=new Webmodel('login_tried_admin');

PhangoVar::$model['login_tried_admin']->components['ip']=new CharField(255);
PhangoVar::$model['login_tried_admin']->components['num_tried']=new IntegerField(11);
PhangoVar::$model['login_tried_admin']->components['time']=new IntegerField(11);

class ModuleAdmin {

	//Example: 'admin' => array('admin', 'admin')

	static public $arr_modules_admin=array();

}

?>