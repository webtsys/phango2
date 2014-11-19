<?php

function HomeView($title, $content)
{

?>
<!DOCTYPE html>
<html>
	<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<?php 
		echo load_jscript_view();
		echo load_css_view();
		echo load_header_view();
	?>
	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>

<?php

}

?>