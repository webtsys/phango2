<?php

PhangoVar::$urls['media']['image']=array('pattern' => '/^media\/image\/(\w+)\/([a-zA-Z0-9+]+\.{0,2})$/', 'url' => '/media/image', 'module' => 'media', 'controller' => 'index', 'action' => 'image', 'parameters' => array('$1' => 'string', '$2' => 'string'));

PhangoVar::$urls['media']['css']=array('pattern' => '/^media\/css\/(\w+)\/([a-zA-Z0-9+]+\.{0,2})$/', 'url' => '/media/css', 'module' => 'media', 'controller' => 'index', 'action' => 'css', 'parameters' => array('$1' => 'string', '$2' => 'string'));

PhangoVar::$urls['media']['image_css']=array('pattern' => '/^media\/css\/images\/(\w+\.png|gif|jpg)$/', 'url' => '/media/css', 'module' => 'media', 'controller' => 'index', 'action' => 'image_css', 'parameters' => array('$1' => 'string'));

PhangoVar::$urls['media']['font']=array('pattern' => '/^media\/font\/(\w+)\/([a-zA-Z0-9+]+\.{0,2})$/', 'url' => '/media/font', 'module' => 'media', 'controller' => 'index', 'action' => 'font', 'parameters' => array('$1' => 'string', '$2' => 'string'));

PhangoVar::$urls['media']['jscript']=array('pattern' => '/^media\/jscript\/(\w+)\/([a-zA-Z0-9+]+\.{0,2})$/', 'url' => '/media/jscript', 'module' => 'media', 'controller' => 'index', 'action' => 'jscript', 'parameters' => array('$1' => 'string', '$2' => 'string'));

?>