<?php

function SelectWindowForm($name="", $class='', $value='', $module='', $model_name='', $field='', $category_field='', $category_model='', $category_model_field='')
{
	
	settype($value, 'integer');
	
	$url_choose_option=make_fancy_url(PhangoVar::$base_url, 'jscript', 'browser_list_field', 'browser_list_field', array('module' => $module, 'model' => $model_name, 'field' => $field, 'field_fill' => $name, 'category_field' => $category_field, 'category_model' => $category_model, 'category_model_field' => $category_model_field ));

	if($value==0)
	{
	
		//$value=PhangoVar::$lang['common']['no_element_chosen'];
		return '<span id="select_window_form_'.$name.'"></span><input type="hidden" name="'.$name.'" class="'.$class.'" id="'.$name.'_field_form" value="'.$value.'"/> <a href="#" onclick="window.open(\''.$url_choose_option.'\', \'\', \'width=800,height=600,scrollbars=yes\'); return false;">'.PhangoVar::$lang['common']['any_option_chosen'].'</a>';
	
	}
	else
	{
	
		$arr_model=PhangoVar::$model[$model_name]->select_a_row( $value, array($field) );
		
		if(isset($arr_model[$field]))
		{
			
			//window.open('','','width=200,height=100');
		
			return '<span id="select_window_form_'.$name.'">'.$arr_model[$field].'</span><input type="hidden" name="'.$name.'" class="'.$class.'" id="'.$name.'_field_form" value="'.$value.'"/> <a href="#" onclick="window.open(\''.$url_choose_option.'\', \'\', \'width=900,height=700,scrollbars=yes\'); return false;">'.PhangoVar::$lang['common']['any_option_chosen'].'</a>';
		
		}
	
	}

	return $value;


}

function SelectWindowFormSet($post, $value)
{

	settype($value, 'integer');
	
	return $value;

}

?>