<?php

if(!function_exists('mysql_query'))
{

	show_error('Error: database don\'t supported by php', 'Error: Mysql database don\'t supported by php', $output_external='');

}

if(DEBUG==1)
{

	function print_sql_fail($sql_fail, $server_data='default')
	{

		$error=mysqli_error(PhangoVar::$connection[$server_data]);
		
		if($error!='')
		{
			throw new Exception('Error: '.$sql_fail.' -> '.$error);
			
		}

	}

}
else
{

	function print_sql_fail($sql_fail)
	{

		return '';

	}

}


function webtsys_query( $sql_string , $server_data='default')
{

	
	$query = mysqli_query(PhangoVar::$connection[$server_data], $sql_string );
	
	print_sql_fail($sql_string, $server_data);

	PhangoVar::$save_query++;
	
	return $query;
} 

function webtsys_affected_rows( $idconnection , $server_data='default')
{

	$num_rows = mysqli_affected_rows(PhangoVar::$connection[$server_data], $idconnection );

	return $num_rows;
} 

function webtsys_close( $idconnection )
{

	mysqli_close( $idconnection );

	return 1;
} 

function webtsys_fetch_array( $query ,$assoc_type=0)
{
	
	$arr_assoc[0]=MYSQL_ASSOC;
	$arr_assoc[1]=MYSQL_NUM;
	
	$arr_final = mysqli_fetch_array( $query ,$arr_assoc[$assoc_type]);

	return $arr_final;
} 

function webtsys_fetch_row( $query )
{	
	$arr_final = mysqli_fetch_row( $query );

	return $arr_final;
} 

function webtsys_get_client_info($server_data='default')
{

	$version = mysqli_get_client_info(PhangoVar::$connection[$server_data]);

	return $version;
} 

function webtsys_get_server_info($server_data='default')
{

	$version = mysqli_get_server_info(PhangoVar::$connection[$server_data]);

	return $version;
} 

function webtsys_insert_id($server_data='default')
{

	$idinsert = mysqli_insert_id(PhangoVar::$connection[$server_data]);

	return $idinsert;
} 

function webtsys_num_rows( $query )
{
    $num_rows = mysqli_num_rows( $query );

    return $num_rows;
} 

/*function connection_database( $host_db, $login_db, $contra_db, $db )
{
    global $con_persistente;

    PhangoVar::$connection = $con_persistente( $host_db, $login_db, $contra_db );

    webtsys_select_db( $db );

    return PhangoVar::$connection;
}*/

function webtsys_connect( $host_db, $login_db, $contra_db , $server_data='default')
{

	PhangoVar::$connection[$server_data]=mysqli_init();
	
	if ( !( mysqli_real_connect(PhangoVar::$connection[$server_data], $host_db, $login_db, $contra_db ) ) )
	{
		
		return false;
		
	} 
	
	return true;
	
	//return PhangoVar::$connection;
} 

function webtsys_pconnect( $host_db, $login_db, $contra_db, $server_data='default' )
{

    if ( !( PhangoVar::$connection[$server_data] = @mysql_pconnect( $host_db, $login_db, $contra_db ) ) )
    {
	return false;
    } 

    return PhangoVar::$connection;
} 

function webtsys_select_db( $db , $server_data='default')
{

	$result_db=mysqli_select_db(PhangoVar::$connection[$server_data], $db);
	
	if($result_db==false)
	{

		return 0;

	}
	
	return 1;
} 

function webtsys_escape_string($sql_string, $server_data='default')
{

	return mysqli_real_escape_string(PhangoVar::$connection[$server_data], $sql_string);

}

function webtsys_error($server_data='default')
{

	return mysqli_error(PhangoVar::$connection[$server_data]);

}

//Specific sql querys for this db...

define('SQL_SHOW_TABLES', 'show tables');

?>
