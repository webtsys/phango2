<?php

function AusersAdmin()
{

	load_model('admin');
	load_lang('users');
	load_libraries(array('admin/generate_admin_class'));
	
	PhangoVar::$model['user_admin']->create_form();
	
	PhangoVar::$model['user_admin']->forms['privileges_user']->parameters=array('privileges_user', '', ChoiceAdminField::$arr_options_select);
	
	PhangoVar::$model['user_admin']->insert_after_field_form('password', 'repeat_password', new ModelForm('repeat_password', 'repeat_password', 'PasswordForm',  PhangoVar::$lang['users']['repeat_password'], new PasswordField(), $required=1, $parameters=''));
	
	$admin=new GenerateAdminClass('user_admin');
	
	$admin->arr_fields=array('username', 'privileges_user');
	
	$admin->arr_fields_edit=array('username', 'password', 'repeat_password', 'email', 'privileges_user');
	
	$admin->set_url_post(set_admin_link('user_admin', array('ausers')));
	
	$admin->show();

	/*ob_start();
	
	$cont_index=ob_end_clean();
	
	echo load_view(array('title' => PhangoVar::$lang['admin']['users_admin'], 'content' => PhangoVar::$lang['admin']['welcome_text']), 'content');*/

}

?>