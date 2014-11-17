<?php

load_libraries(array('fields/passwordfield'));

PhangoVar::$model['group']=new Webmodel('group');

PhangoVar::$model['group']->set_component('name', 'CharField', array(255));
PhangoVar::$model['group']->set_component('permissions', 'SerializeField', array());
/*
PhangoVar::$model['user']=new Webmodel('user');

PhangoVar::$model['user']->set_component('username', 'CharField', array(25));

PhangoVar::$model['user']->set_component('password', 'PasswordField', array(25));

PhangoVar::$model['user']->set_component('group', 'ForeignKeyField', array('group'));

PhangoVar::$model['user']->set_component('email', 'EmailField', array(255));
*/


?>