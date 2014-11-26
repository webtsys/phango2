<?php

function LoginFormView($model_user, $model_login)
{
	
	$model_user->forms['no_expire_session']=new ModelForm('form_login', 'no_expire_session', 'CheckBoxForm', PhangoVar::$lang['users']['automatic_login'], new BooleanField(), $required=1, $parameters='');

	$arr_fields_login=array($model_login->field_user, $model_login->field_password, 'no_expire_session');
	
	$model_user->forms['no_expire_session']->label_class='expire_button';
	
	?>
	<form method="post" action="<?php echo $model_login->url_login; ?>">
	<?php
		set_csrf_key();
		
		echo load_view(array($model_user->forms, $arr_fields_login), 'common/forms/modelform');

	?>
	<p><a href="<?php echo $model_login->url_recovery; ?>"><?php echo PhangoVar::$lang['users']['remember_password']; ?></a></p>
	<p><input type="submit" value="<?php echo PhangoVar::$lang['common']['login']; ?>" /></p>
	</form>
	<?php

}

?>
