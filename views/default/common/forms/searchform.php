<?php

function SearchFormView($arr_search_field, $arr_order_field, $arr_order_select, $url_options)
{

	$form_search='<form method="get" action="'.add_extra_fancy_url( $url_options, array() ).'">';
	$form_search.=set_csrf_key();
	$form_search.=common_l('Order by').': '.SelectForm('order_field', '', $arr_order_field).' '.common_l('By order').': '.SelectForm('order_desc', '', $arr_order_select);

	$arr_order_field[0]=$_GET['search_field'];

	$form_search.='<p>'.common_l('Search').': '.TextForm('search_word', '', $_GET['search_word']).' '.common_l('Search by').': '.SelectForm('search_field', '', $arr_search_field).'</p><p><input type="submit" value="'.common_l('Send').'"/> <input type="button" value="'.common_l('Reset').'" onclick="javascript:location.href=\''.$url_options.'\'"/>';

	$form_search.='</form></p>';
	
	echo load_view(array(common_l('Order and search'), $form_search), 'content');

}

?>