<?php

load_libraries(array('fields/passwordfield'));

PhangoVar::$model['user_group']=new Webmodel('user_group');

PhangoVar::$model['user_group']->set_component('name', 'CharField', array(255));
PhangoVar::$model['user_group']->set_component('permissions', 'SerializeField', array());

PhangoVar::$model['user']=new Webmodel('user');

PhangoVar::$model['user']->set_component('username', 'CharField', array(25));

PhangoVar::$model['user']->set_component('password', 'PasswordField', array(25));

PhangoVar::$model['user']->set_component('email', 'EmailField', array(255));

PhangoVar::$model['user']->set_component('group', 'ForeignKeyField', array('user_group'));

PhangoVar::$model['user']->set_component('token_client', 'CharField', array(255), 1);

PhangoVar::$model['user']->set_component('token_recovery', 'CharField', array(255), 1);

PhangoVar::$model['login_tried']=new Webmodel('login_tried');

PhangoVar::$model['login_tried']->components['ip']=new CharField(255);
PhangoVar::$model['login_tried']->components['num_tried']=new IntegerField(11);
PhangoVar::$model['login_tried']->components['time']=new IntegerField(11);

?>