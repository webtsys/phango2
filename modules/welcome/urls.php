<?php

//First key, "module", the indicator that what PhangoVar::$urls to search, second key, controller.
//The array have the action, and values. 
//Example: PhangoVar::urls['url_first_directory']['controller']=array('pattern' => '^module_name\/(.*)', 'module' => 'module', 'controler' => 'index', 'action' => 'index', 'parameters' => array('$1' => 'integer', '$2' => 'slugify'));

PhangoVar::$urls['welcome']['arguments']=array('pattern' => '/^welcome\/([0-9]+)\/(\w+)$/', 'url' => '/welcome', 'module' => 'welcome', 'controller' => 'index', 'action' => 'index', 'parameters' => array('$1' => 'integer', '$2' => 'string'));

PhangoVar::$urls['welcome']['index']=array('pattern' => '/^welcome$/', 'url' => '/welcome', 'module' => 'welcome', 'controller' => 'index', 'action' => 'index', 'parameters' => array());

?>