<?php

function SearchFormView($arr_search_field, $arr_order_field, $arr_order_select, $url_options)
{

	$form_search='<form method="get" action="'.add_extra_fancy_url( $url_options, array() ).'">';
	$form_search.=set_csrf_key();
	$form_search.=i18n_lang('common', 'order_by', 'Order by').': '.SelectForm('order_field', '', $arr_order_field).' '.i18n_lang('common', 'in_order', 'By order').': '.SelectForm('order_desc', '', $arr_order_select);

	$arr_order_field[0]=$_GET['search_field'];

	$form_search.='<p>'.i18n_lang('common', 'search', 'Search').': '.TextForm('search_word', '', $_GET['search_word']).' '.i18n_lang('common', 'search_by', 'Search by').': '.SelectForm('search_field', '', $arr_search_field).'</p><p><input type="submit" value="'.i18n_lang('common', 'send', 'Send').'"/> <input type="button" value="'.i18n_lang('common', 'reset', 'Reset').'" onclick="javascript:location.href=\''.$url_options.'\'"/>';

	$form_search.='</form></p>';
	
	echo load_view(array(i18n_lang('common', 'order_and_search', 'Order and search'), $form_search), 'content');

}

?>