<?php

function ShowListModel($model_name, $arr_fields, $url_options, $where_sql='', $yes_id=0, $yes_options=0, $func_options='')
{

	load_libraries(array('generate_admin_ng'));

	settype($_GET['op_edit'], 'integer');

	if( count(PhangoVar::$model[$model_name]->forms)==0)
	{

		$model[$model_name]->create_form();

	}

	$arr_label_fields=array();
	$cell_sizes=array();

	list($where_sql, $arr_where_sql, $location, $arr_order)=SearchInField($model_name, $arr_fields, $arr_fields, $where_sql, $url_options, $yes_id);

	BasicList($model_name, $where_sql, $arr_where_sql, $location, $arr_order, $arr_fields, $cell_sizes, $func_options, $url_options, $yes_id, $yes_options);

}

?>