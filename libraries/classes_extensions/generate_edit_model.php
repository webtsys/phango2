<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package Core/ModelExtraMethods
*
*
*/

/**
* A method for create forms for edit models
*
* @deprecated Use GenerateAdminClass for this tasks
*/

function generate_edit_model_method_class($class, $idrow, $arr_fields, $url_admin, $url_back, $yes_insert=1, $where_sql='')
{

	//global $lang, PhangoVar::$base_url;

	settype($_GET['op_update'], 'integer');
	settype($_GET['success'], 'integer');
	settype($idrow, 'integer');
	
	$url_post=add_extra_fancy_url($url_admin, array('op_update' =>1));
	
	$label=i18n_lang('common', 'add_new_item', 'Add new element').' - '.$class->label;
	
	$update_method='insert';
	
	if($where_sql!='')
	{
	
		$where_sql=str_replace('WHERE', ' and', $where_sql);
		
		$where_sql=str_replace('where', ' and', $where_sql);
	
	}
	
	if($class->element_exists($idrow))
	{
	
		$query=$class->select('where '.$class->idmodel.'='.$_GET[$class->idmodel], $arr_fields, true);
		
		$post=webtsys_fetch_array($query);
		
		ModelForm::set_values_form($post, $class->forms, 0);
		
		$update_method='update';
		
		$label=i18n_lang('common', 'edit', 'Edit').' - '.$class->label;
	
	}
	else 
	if($yes_insert==0)
	{
	
		echo i18n_lang('common', 'cannot_update_insert_in_model', 'Cannot insert or update this item in the database');
	
		return '';
	
	}
	
	switch($_GET['op_update'])
	{
	
		default:
	
		ob_start();
		
		echo load_view(array($class->forms, $arr_fields, $url_post, $class->enctype, '_generate_admin_'.$class->name), 'common/forms/updatemodelform');

		$cont_index=ob_get_contents();

		ob_end_clean();

		echo load_view(array($label, $cont_index), 'content');
		
		?>
		<p><a href="<?php echo $url_back; ?>"><?php echo i18n_lang('common', 'go_back', 'Go back'); ?></a></p>
		<?php
		
		break;
		
		case 1:
			
			$post=filter_fields_array($arr_fields, $_POST);
			
			if($class->$update_method($post, 'where '.$class->idmodel.'='.$idrow.$where_sql))
			{
			
				load_libraries(array('redirect'));
				simple_redirect( $url_back, i18n_lang('common', 'redirect', 'Redirect'), i18n_lang('common', 'success', 'Success'), i18n_lang('common', 'press_here_redirecting', 'Press here for redirecting'));
			
			}
			else
			{
			
				ob_start();
					
				echo '<p class="error">'.i18n_lang('common', 'cannot_update_insert_in_model', 'Cannot insert or update this item in the database').' '.$class->name.': '.$class->std_error.'</p>';

				$post=filter_fields_array($arr_fields, $_POST);
				
				set_values_form($post, $class->forms);

				echo load_view(array($class->forms, $arr_fields, $url_post, $class->enctype), 'common/forms/updatemodelform');

				$cont_index=ob_get_contents();

				ob_end_clean();

				echo load_view(array($label, $cont_index), 'content');
			
			}
			
		
		break;
		
		case 2:
		
			if($yes_insert==1)
			{
			
				if($class->delete('where `'.$class->name.'`.'.$class->idmodel.'='.$idrow.$where_sql))
				{
				
					load_libraries(array('redirect'));
					simple_redirect( $url_back , i18n_lang('common', 'redirect', 'Redirect'), i18n_lang('common', 'success', 'Success'), i18n_lang('common', 'press_here_redirecting', 'Press here for redirecting'));
				
				}
			
			}
		
		break;
		
	}
	
}

?>