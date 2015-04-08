<?php

function AdminIndexAdmin()
{
	
	echo load_view(array('title' => admin_l('Welcome to admin'), 'content' => admin_l('In this place you can edit the elements of your site')), 'content');

}

?>