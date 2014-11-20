<?php

load_model('admin');
load_lang('users');
load_libraries(array('admin/generate_admin_class'));

function AusersAdmin()
{

	settype($_GET['op'], 'integer');
	
	switch($_GET['op'])
	{
	
		default:
			
			PhangoVar::$model['user_admin']->create_form();
			
			PhangoVar::$model['user_admin']->forms['privileges_user']->parameters=array('privileges_user', '', ChoiceAdminField::$arr_options_select);
			
			PhangoVar::$model['user_admin']->insert_after_field_form('password', 'repeat_password', new ModelForm('repeat_password', 'repeat_password', 'PasswordForm',  PhangoVar::$lang['users']['repeat_password'], new PasswordField(), $required=1, $parameters=''));
			
			$admin=new GenerateAdminClass('user_admin');
			
			$admin->arr_fields=array('username', 'privileges_user');
			
			$admin->arr_fields_edit=array('username', 'password', 'repeat_password', 'email', 'privileges_user');
			
			$admin->set_url_post(set_admin_link('user_admin', array('ausers')));
			
			$admin->options_func='UserOptionsListModel';
			
			$admin->show();
		
		break;
		
		case 1:
		
			
		
		break;
		
	}

}

function UserOptionsListModel($url_options, $model_name, $id, $arr_row)
{

	$arr_options=BasicOptionsListModel($url_options, $model_name, $id, $arr_row);
	
	if($arr_row['privileges_user']==1)
	{
	
		$arr_options[]='<a href="'.set_admin_link('ausers', array('op' => 1)).'">'.PhangoVar::$lang['admin']['change_user_modules'].'</a>';
	
	}
	
	return $arr_options;

}

?>