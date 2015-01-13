<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils\DateTime
*
*
*/

function form_time( $time )
{
    return date( PhangoVar::$ampm, $time );
} 

?>