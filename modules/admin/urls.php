<?php

PhangoVar::$urls[ADMIN_FOLDER]['index']=array('pattern' => '/^'.ADMIN_FOLDER.'$/', 'url' => '/'.ADMIN_FOLDER, 'module' => 'admin', 'controller' => 'index', 'action' => 'index', 'parameters' => array());

PhangoVar::$urls[ADMIN_FOLDER]['login']=array('pattern' => '/^'.ADMIN_FOLDER.'\/login$/', 'url' => '/'.ADMIN_FOLDER.'/login', 'module' => 'admin', 'controller' => 'login', 'action' => 'index', 'parameters' => array());

PhangoVar::$urls[ADMIN_FOLDER]['logout']=array('pattern' => '/^'.ADMIN_FOLDER.'\/logout$/', 'url' => '/'.ADMIN_FOLDER.'/logout', 'module' => 'admin', 'controller' => 'login', 'action' => 'logout', 'parameters' => array());

PhangoVar::$urls[ADMIN_FOLDER]['login_check']=array('pattern' => '/^'.ADMIN_FOLDER.'\/login_check$/', 'url' => '/'.ADMIN_FOLDER.'/login_check', 'module' => 'admin', 'controller' => 'login', 'action' => 'login', 'parameters' => array());

PhangoVar::$urls[ADMIN_FOLDER]['register']=array('pattern' => '/^'.ADMIN_FOLDER.'\/register$/', 'url' => '/'.ADMIN_FOLDER.'/register', 'module' => 'admin', 'controller' => 'login', 'action' => 'register', 'parameters' => array());

PhangoVar::$urls[ADMIN_FOLDER]['register_insert']=array('pattern' => '/^'.ADMIN_FOLDER.'\/register\/([0-9])$/', 'url' => '/'.ADMIN_FOLDER.'/register', 'module' => 'admin', 'controller' => 'login', 'action' => 'register', 'parameters' => array('$1' => 'integer'));

PhangoVar::$url_module_requires[]='lang';
PhangoVar::$url_module_requires[]='media';

?>