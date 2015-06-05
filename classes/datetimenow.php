<?php

/**
* Simple class for save datetime of the script.
*
* With this class you have a global timedates statement for use in your functions 
*/

class DateTimeNow {

	/**
	*
	* Actual timestamp
	*
	*/

	static public $now='';

	/**
	*
	* Actual timestamp
	*
	*/

	static public $today='';

	/**
	*
	* Timestamp today to 00:00:00 hours
	*
	*/
	
	static public $today_first='';

	/**
	*
	* Timestamp today to 23:59:59 hours
	*
	*/
	
	static public $today_last='';

	/**
	*
	* Timestamp today in this hour
	*
	*/
	
	static public $today_hour='';
	
	/**
	*
	* Method for update properties of this class if the timezone is changed.
	*
	*/
	
	static public function update_datetime()
	{
	
		DateTimeNow::$today=mktime( date('H'), date('i'), date('s') );
		DateTimeNow::$now=DateTimeNow::$today;
		DateTimeNow::$today_first=mktime(0, 0, 0);
		DateTimeNow::$today_last=mktime(23, 59, 59);
		DateTimeNow::$today_hour=mktime(date('H'), 0, 0);
	
	}
	
}

?>