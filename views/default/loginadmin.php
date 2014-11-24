<?php

function LoginAdminView($content)
{

?>
<!DOCTYPE html>
<html>
	<head>
	<title><?php echo PhangoVar::$lang['users']['login']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<?php 
		PhangoVar::$arr_cache_css[]='login.css';
	
		echo load_jscript_view();
		echo load_css_view();
		echo load_header_view();
	?>
	</head>
	<body>
		<div id="logo_phango"></div>
		<div id="login_block">
			<?php echo $content; ?>
		</div>
	</body>
</html>

<?php

}

?>