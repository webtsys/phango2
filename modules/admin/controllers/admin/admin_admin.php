<?php

function AdminIndexAdmin()
{
	
	echo load_view(array('title' => PhangoVar::$lang['admin']['welcome_to_admin'], 'content' => PhangoVar::$lang['admin']['welcome_text']), 'content');

}

?>