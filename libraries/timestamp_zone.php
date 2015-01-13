<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils
*
*
*/

/**
* Function for obtain the actual timezone
*/

function obtain_timestamp_zone($timezone, $default_timezone=MY_TIMEZONE)
{

	$dateTimeZone=new DateTimeZone($timezone);
	
	if($dateTimeZone==false)
	{

		$dateTimeZone=new DateTimeZone($default_timezone);

	}

	$dateTimeNow=new DateTime("now", $dateTimeZone);
	return $dateTimeZone->getOffset($dateTimeNow);

}

/**
* Function for obtain timezones list
*/

function timezones_list($timezone_chosen)
{
	
	$list_gmt=array();

	$timezone_identifiers = DateTimeZone::listIdentifiers();

	foreach($timezone_identifiers as $timezone)
	{

		$arr_gmt[]=$timezone;

	}
	
	$list_gmt=array($timezone_chosen);

	foreach($arr_gmt as $key)
	{

		$list_gmt[]=$key;
		$list_gmt[]=$key;

	}

	return $list_gmt;

	
}

/**
* Function for obtain an array with timezones. You can use this array for create values for SelectForm
*/

function timezones_array()
{

	$list_gmt=array();

	$timezone_identifiers = DateTimeZone::listIdentifiers();

	foreach($timezone_identifiers as $timezone)
	{

		$arr_gmt[]=$timezone;

	}

	$list_gmt=array();

	foreach($arr_gmt as $key)
	{

		$list_gmt[]=$key;

	}

	return $list_gmt;

	
}

?>
