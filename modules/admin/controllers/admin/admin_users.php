<?php

function AusersAdmin()
{

	load_model('admin');
	load_libraries(array('admin/generate_admin_class'));
	
	PhangoVar::$model['user_admin']->create_form();
	
	PhangoVar::$model['user_admin']->forms['privileges_user']->parameters=array('privileges_user', '', ChoiceAdminField::$arr_options_select);
	
	$admin=new GenerateAdminClass('user_admin');
	
	$admin->arr_fields=array('username', 'privileges_user');
	
	$admin->arr_fields_edit=array('username', 'password', 'email', 'privileges_user');
	
	$admin->set_url_post(set_admin_link('user_admin', array('ausers')));
	
	$admin->show();

	/*ob_start();
	
	$cont_index=ob_end_clean();
	
	echo load_view(array('title' => PhangoVar::$lang['admin']['users_admin'], 'content' => PhangoVar::$lang['admin']['welcome_text']), 'content');*/

}

?>