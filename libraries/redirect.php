<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils
*
*
*/

function redirect_webtsys($direction,$l_text,$text,$ifno, $arr_block='')
{

	//include_once($base_path."themes/".$config_data['dir_theme']."/$arr_block.php");

	$redirect="<meta http-equiv=\"refresh\" content=\"2;URL=$direction\">";

	ob_start();
	
	echo load_view(array(PhangoVar::$portal_name.' / '.$l_text,'<p>'.$text.'<br><a href="'. $direction.'">'.$ifno.'</a>'), 'content');

	$cont_index=ob_get_contents();

	ob_end_clean();
	
	echo load_view(array(PhangoVar::$portal_name.' / '.$l_text, $cont_index), 'home');

	die();

}

function simple_redirect($url_return, $l_text, $text, $ifno, $content_view='content')
{
	
	PhangoVar::$arr_cache_header[]="<meta http-equiv=\"refresh\" content=\"2;URL=$url_return\">";
	
	echo load_view(array(PhangoVar::$portal_name.' / '.$l_text,'<p>'.$text.'<br><a href="'. $url_return.'">'.$ifno.'</a>'), $content_view);

}

?>