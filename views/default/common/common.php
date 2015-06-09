<?php

function CommonView($title, $content)
{

PhangoVar::$arr_cache_css[]='admin.css';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title><?php echo $title; ?></title>
	<?php 
	
	echo load_css_view();
	echo load_jscript_view(); 
	echo load_header_view();
		
	?>
	</head>
	<body>

	<div id="center_body">
		<div id="header"><span id="title_phango">Phango</span> <span id="title_framework">Framework!</span></div>
		<div class="content big_content">
			<div class="cont">
				<?php echo $content; ?>
			</div>
		</div>
	</div>

<?php

}

?>
