<?php

//First key, "module", the indicator that what PhangoVar::$urls to search, second key, controller.
//The array have the action, and values. 
//Example: PhangoVar::urls['url_first_directory']['controller']=array('pattern' => '^module_name\/(.*)', 'module' => 'module', 'controler' => 'index', 'action' => 'index', 'settype' => array('first_element' => 'integer', 'second_element' => 'slugify'));

PhangoVar::$urls['welcome'][]=array('pattern' => '/^welcome$/', 'module' => 'welcome', 'controller' => 'index', 'action' => 'index');

?>