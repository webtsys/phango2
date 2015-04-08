<?php

function InsertUserFormView($model_user, $model_login)
{
	
	?>
	<form method="post" action="<?php echo $model_login->url_insert; ?>">
	<?php
	
	set_csrf_key();
	
	
	echo load_view(array($model_user->forms, $model_login->arr_user_insert), 'common/forms/modelform');
		

	?>
	<p><input type="submit" value="<?php echo users_l('Register in the web'); ?>"/></p>
	</form>
	<?php

}

?>