<?php

function RecoveryPassFormView($model_login, $login)
{

	?>
		<h3><?php echo PhangoVar::$lang['users']['remember_password_explain']; ?></h3>
		<form method="post" action="<?php echo $login->url_recovery_send; ?>">
			<?php set_csrf_key(); ?>
			<label for="email"></label>
			<?php
				echo TextForm('email', '');
			?>
			<p><input type="submit" value="<?php echo PhangoVar::$lang['users']['remember_password']; ?>" /></p>
		</form>

	<?php

}

?>