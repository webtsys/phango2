<?php

function AdminIndexAdmin()
{
	
	echo load_view(array('title' => i18n_lang('admin', 'welcome_to_admin', 'Welcome to admin'), 'content' => PhangoVar::$l_['admin']->lang('welcome_text', 'Welcome text')), 'content');

}

?>