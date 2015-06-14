<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package utilities
*
*/


/**
* Function used for add slashes from _POST and _GET variables.
*
*
* @param string $string String for add slashes
*/

function make_slashes( $string )
{
	return addslashes( $string );
} 

/**
* Function used for strip slashes from _POST and _GET variables.
*
*
* @param string $string String for strip slashes
*/

function unmake_slashes( $string )
{
	return stripslashes( $string );
}



/**
* This function is used to clean up the text of undesirable elements
* @param string $text Text to clean
* @param string $br Boolean variable used for control if you want br tags or \n symbon on input text
*/

function form_text( $text ,$br=1)
{

    settype( $text, "string" );

    $text = trim( $text );

    $arr_tags=array('/</', '/>/', '/"/', '/\'/', "/  /");
    $arr_entities=array('&lt;', '&gt;', '&quot;', '&#39;', '&nbsp;');
	
    if($br==1)
    {

	$text = preg_replace($arr_tags, $arr_entities, $text);
	
	$arr_text = explode("\n\r\n", $text);

	$c=count($arr_text);

	if($c>1)
	{
		for($x=0;$x<$c;$x++)
		{

			$arr_text[$x]='<p>'.trim($arr_text[$x]).'&nbsp;</p>';

		}
	}


	$text=implode('', $arr_text);

	$arr_text = explode("\n", $text);

	$c=count($arr_text);

	if($c>1)
	{
		for($x=0;$x<$c;$x++)
		{

			$arr_text[$x]=trim($arr_text[$x]).'<br />';

		}
	}

	$text=implode('', $arr_text);
	
    }
    
	
    $text = make_slashes( $text );
    
    return $text;
}

/**
* This function is used to clean up the text of undesirable html tags
*
* @param string $text Input text for clean undesirable html tags
* @param array $allowedtags An array with allow tags on the text.
*/

function form_text_html( $text , $allowedtags=array())
{

	settype( $text, "string" );
	
	//If no html editor \r\n=<p>

	/*$text=preg_replace("/<br.*?>/", "\n", $text);*/
	
	if(PhangoVar::$textbb_type!='')
	{
		
		$text=str_replace("\r", '', $text);
		$text=str_replace("\n", '', $text);

	}
	else
	{

		//Make <p>

		$arr_text = explode("\n\r\n", $text);

		$c=count($arr_text);

		if($c>1)
		{
			for($x=0;$x<$c;$x++)
			{

				$arr_text[$x]='<p>'.trim($arr_text[$x]).'&nbsp;</p>';

			}
		}


		$text=implode('', $arr_text);

		$arr_text = explode("\n", $text);

		$c=count($arr_text);

		if($c>1)
		{
			for($x=0;$x<$c;$x++)
			{

				$arr_text[$x]=trim($arr_text[$x]).'<br />';

			}
		}

		$text=implode('', $arr_text);

	}
	/*echo htmlentities($text);
	die;*/
		
	//Check tags

	//Bug : tags deleted ocuppied space.

	//First strip_tags

	$text = trim( $text );

	//Trim html

	$text=str_replace('&nbsp;', ' ', $text);

	while(preg_match('/<p>\s+<\/p>$/s', $text))
	{

		$text=preg_replace('/<p>\s+<\/p>$/s', '', $text);
	
	}

	//Now clean undesirable html tags
	
	if(count($allowedtags)>0)
	{

		$text=strip_tags($text, '<'.implode('><', array_keys($allowedtags)).'>' );
		
		$arr_tags=array('/</', '/>/', '/"/', '/\'/', "/  /");
		$arr_entities=array('&lt;', '&gt;', '&quot;', '&#39;', '&nbsp;');
		
		$text=preg_replace($arr_tags, $arr_entities, $text);
		
		$text=str_replace('  ', '&nbsp;&nbsp;', $text);
		
		$arr_tags_clean=array();
		$arr_tags_empty_clean=array();

		//Close tags. 

		//Filter tags

		$final_allowedtags=array();
		
		foreach($allowedtags as $tag => $parameters)
		{
			//If mark how recursive, make a loop

			settype($parameters['recursive'], 'integer');

			$c_count=0;
			$x=0;

			if($parameters['recursive']==1)
			{

				$c_count = substr_count( $text, '&lt;'.$tag.'&gt;');

			}
			
			for($x=0;$x<=$c_count;$x++)
			{

				$text=preg_replace($parameters['pattern'], $parameters['replace'], $text);
				
			}
			
			$pos_=strpos($tag, '_');
			
			if($pos_!==false)
			{

				$tag=substr($tag, 0, $pos_);

			}
			
			$final_allowedtags[]=$tag.'_tmp';

			//Destroy open tags.
			
			$arr_tags_clean[]='/&lt;(.*?)'.$tag.'(.*?)&gt;/';
			
			$arr_tags_empty_clean[]='';
			$arr_tags_empty_clean[]='';

		}
		
		$text=preg_replace($arr_tags_clean, $arr_tags_empty_clean, $text);
	}

	//With clean code, modify <tag_tmp
	
	$text=str_replace('_tmp', '', $text);
	
	//Close tags
	
	$text = unmake_slashes( $text );
	
	return $text;

}

/**
* function for clean newlines
* 
* @param string $text Text to clean.
*/

function unform_text( $text )
{

	$text = preg_replace( "/<p>(.*?)<\/p>/s", "$1\n\r\n", $text );
	$text = str_replace( "<br />", "", $text );

	return $text;

}

/**
*  Simple function for replate real quotes for quote html entities.
* 
* @param string $text Text to clean.
*/

function replace_quote_text( $text )
{

	$text = str_replace( "\"", "&quot;", $text );

	return $text;

}

/**
* Function for normalize texts for use on urls or other things...
*
* This function is used for convert text in a format useful for cleaning and beauty urls or cleaning text
*
* @param string $text String for normalize
* @param boolean $respect_upper If true or 1 respect uppercase, if false or 0 convert to lowercase the $text
* @param string $replace Character used for replace text spaces.
*
*
*/

function slugify($text, $respect_upper=0, $replace_space='-', $replace_dot=0, $replace_barr=0)
{

	$from='àáâãäåæçèéêëìíîïðòóôõöøùúûýþÿŕñÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÝỲŸÞŔÑ¿?!¡()"|#*%,;+&$ºª<>`çÇ{}@~=^:´[]';
	$to=  'aaaaaaaceeeeiiiidoooooouuuybyrnAAAAAACEEEEIIIIDOOOOOOUUUYYYBRN---------------------------------';
	
	if($replace_dot==1)
	{
	
		$from.='.';
		$to.='-';
	
	}
	
	if($replace_barr==1)
	{
	
		$from.="/";
		$to.="-";
	
	}

	$text=trim(str_replace(" ", $replace_space, $text));

	$text = utf8_decode($text);    
	$text = strtr($text, utf8_decode($from), $to);
	
	//Used for pass base64 via GET that use upper, for example.
	
	if($respect_upper==0)
	{
	
		$text = strtolower($text);
		
	}

	return utf8_encode($text); 

}

/**
* Set raw variables from a array
*
* @param $arr_variables array Hash with contents, for example a $_POST array with values
* @param $fields Array with the fields to check
*/

function check_variables($arr_variables, $fields=array())
{

	if(count($fields)==0)
	{

		$fields=array_keys($arr_variables);

	}

	$arr_final=array();

	foreach($fields as $field) 
	{
		settype($arr_variables[$field], 'string');
		$arr_final[$field]=unmake_slashes( form_text( urldecode( $arr_variables[$field] ) ) );

	}

	return $arr_final;

}

//Fill arr_check_table for check if exists model

/**
* Function for strip values with keys inside $array_strip
*
* @param array $array_strip The array with key values for delete
* @param array $array_source The array that i want to clean of undesirable values
*/

function strip_fields_array($array_strip, $array_source)
{

	$array_source=array();

	foreach($array_strip as $field_strip)
	{

		unset($array_source[$field_strip]);

	}

	return $array_source;

}

/**
* Internal function for set array values without keys inside $array_strip
* 
* @param array $array_strip The array with key values for set
* @param array $array_source The array that i want fill with default values 
*
*/

function filter_fields_array($array_strip, $array_source)
{

	$array_final=array();
	
	if(count($array_strip)>0)
	{
		foreach($array_strip as $field_strip)
		{

			$array_final[$field_strip]=@$array_source[$field_strip];

		}

		return $array_final;

	}
	else
	{
	
		return $array_source;
	
	}
}

/**
* Function used for show on stdout a csrf_token used by POST phango controllers for check if is a real POST from phango.
*
*/

function set_csrf_key()
{

        echo "\n".HiddenForm('csrf_token', '', PhangoVar::$key_csrf)."\n";

}

/**
* Function used for return a csrf_token used by POST phango controllers for check if is a real POST from phango.
*
*/

function get_csrf_key_form()
{

        return "\n".HiddenForm('csrf_token', '', PhangoVar::$key_csrf)."\n";

}

/**
* Simple function used for show errors with clean format
*
* A function used for show errors with clean format with a text depending on if debug is enabled or not
*
* @param string $txt_error_normal A string with the error used in no debug mode of phango
*
* @param string $txt_error_debug A string with the error used in debug mode of phango
*
* @param string $output_external if you have catched some php error, put here if you want
* 
*/


function show_error($txt_error_normal, $txt_error_debug, $output_external='')
{

	$arr_pre[0]=array('<p>', '</p>');
	$arr_pre[1]=array('', '');

	
	$arr_error[0]=$arr_pre[PhangoVar::$utility_cli][0].$txt_error_normal.$arr_pre[PhangoVar::$utility_cli][1];    
	$arr_error[1]=$arr_pre[PhangoVar::$utility_cli][0].$txt_error_debug.$arr_pre[PhangoVar::$utility_cli][0];
	
	$output=ob_get_contents();

	$arr_error[1].="\n\n".'Output: '.$output."\n".$output_external.'';

	$arr_view[0]='common';
	$arr_view[1]='commontxt';
	
	if(PhangoVar::$utility_cli==0)
	{

		ob_clean();

	}
	else
	{
	
		$txt_error_normal=strip_tags($txt_error_normal);
		$txt_error_debug=strip_tags($txt_error_debug);
	
	}

	echo load_view(array('Phango site is down', $arr_error[DEBUG]), 'common/'.$arr_view[PhangoVar::$utility_cli]);

	die();

}

/**
* Function for encode an url in base64 for use on normalized get parameters.
*
* @param string $url Url for encode in base64
*
*/

function urlencode_redirect($url)
{

	$base64_url=base64_encode( $url );
	
	$arr_char_ugly='+/=';
	$arr_char_cool='-_.';
	
	$replace=strtr($base64_url, $arr_char_ugly, $arr_char_cool);
	
	return $replace;

}

/**
* Function for decode an url in base64 for use on normalized get parameters.
*
* @param string $url Url for decode in base64
*
*/

function urldecode_redirect($url_encoded)
{

	$arr_char_cool='-_.';
	$arr_char_ugly='+/=';

	$url_encoded=strtr($url_encoded, $arr_char_cool, $arr_char_ugly);
	
	$url=base64_decode( $url_encoded , true);
	
	return $url;

}

/**
* A internal helper function 
*
* @param string $name Name for process
*
*/

function set_name_default($name)
{

	return ucfirst(str_replace('_', ' ', $name));

}

/**
* A function for generate a rand token used on sessions.
*
*/

function get_token()
{

	$rand_prefix=generate_random_password();
	
	return sha1( uniqid($rand_prefix, true) );

}

/**
* Simple internal function used for filter get parameters using slugify
*
* @param string $value The value for filter
*/

function slugify_get($value)
{

	$value=preg_replace('/\?.*$/', '', $value);

	return slugify($value, 1);

}

/**
* Simple internal function used for filter get integer parameters using settype
*
* @param string $value The value for filter
*
*/

function integer_get($value)
{

	settype($value, 'integer');
	
	return $value;

}

/**
* Function used for generate a simple random password. Have two random process for shuffle the string.
*
* @param string $length_pass A variable used for set the character's length the password. More length, password more secure
*
*/

function generate_random_password($length_pass=14)
{

	$x=0;
	$z=0;

	$abc = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '*', '+', '!', '-', '_', '@', '%', '&');
	
	shuffle($abc);
	
	$c_chars=count($abc)-1;

	$password_final='';

	for($x=0;$x<$length_pass;$x++)
	{

		$z=mt_rand(0, $c_chars);
		
		$password_final.=$abc[$z];

	}
	
	$password_final=str_shuffle($password_final);

	return $password_final;

}

?>
