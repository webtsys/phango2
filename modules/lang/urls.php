<?php

	PhangoVar::$urls['lang']['index']=array('pattern' => '/^welcome\/(\w+)$/', 'url' => '/lang', 'module' => 'lang', 'controller' => 'index', 'action' => 'index', 'parameters' => array('$1' => 'string'));

?>