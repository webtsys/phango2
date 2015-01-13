<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils
*
*
*/

function form_date( $date )
{

	return date( PhangoVar::$date_format, $date );

} 

?>