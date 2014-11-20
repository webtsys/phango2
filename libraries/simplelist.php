<?php

class SimpleList
{

	public $arr_options=array();
	public $yes_options=1;
	public $arr_fields=array();
	public $arr_fields_no_showed=array();
	public $arr_extra_fields=array();
	public $arr_extra_fields_func=array();
	public $arr_cell_sizes=array();
	public $model_name;
	public $where_sql='';
	public $options_func='BasicOptionsListModel';
	public $url_options='';
	public $separator_element='<br />';
	public $limit_rows=10;
	public $raw_query=1;
	public $yes_pagination=1;
	public $num_by_page=20;
	public $begin_page=0;
	public $initial_num_pages=20;
	public $variable_page='begin_page';
	
	function __construct($model_name)
	{
	
		$this->model_name=$model_name;
		
		$this->begin_page=$_GET['begin_page'];
		
		if( count(PhangoVar::$model[$this->model_name]->forms)==0)
		{	
			PhangoVar::$model[$this->model_name]->create_form();
		}
	
	}
	
	public function show()
	{
		
		load_libraries(array('table_config'));
		
		$arr_fields_show=array();
		
		if(count($this->arr_fields)==0)
		{
			
			$this->arr_fields=array_keys(PhangoVar::$model[$this->model_name]->components);
		
		}
		
		if(!in_array(PhangoVar::$model[$this->model_name]->idmodel, $this->arr_fields))
		{
		
			$this->arr_fields[]=PhangoVar::$model[$this->model_name]->idmodel;
			$this->arr_fields_no_showed[]=PhangoVar::$model[$this->model_name]->idmodel;
		
		}
		
		$arr_fields_showed=array_diff($this->arr_fields, $this->arr_fields_no_showed);
		
		foreach($arr_fields_showed as $field)
		{
		
			$arr_fields_show[$field]=PhangoVar::$model[$this->model_name]->forms[$field]->label;
		
		}
		
		//Extra fields name_field
		
		foreach($this->arr_extra_fields as $extra_key => $name_field)
		{
		
			$arr_fields_show[$extra_key]=$name_field;
		
		}
		
		$options_method='no_add_options';
		
		if($this->yes_options)
		{
		
			$arr_fields_show[]=PhangoVar::$lang['common']['options'];
			$options_method='yes_add_options';
		
		}
		/*
		if($this->limit_rows>0)
		{
		
			$this->where_sql=$this->where_sql.' limit '.$this->limit_rows;
		
		}*/
		
		$this->where_sql=$this->where_sql.' limit '.$this->begin_page.', '.$this->num_by_page;
		
		up_table_config($arr_fields_show, $this->arr_cell_sizes);
		
		$query=PhangoVar::$model[$this->model_name]->select($this->where_sql, $this->arr_fields, $this->raw_query);
		
		while($arr_row=webtsys_fetch_array($query))
		{
		
			$arr_row_final=array();
		
			foreach($arr_fields_showed as $field)
			{
			
				$arr_row_final[$field]=PhangoVar::$model[$this->model_name]->components[$field]->show_formatted($arr_row[$field]);
			
			}
			
			//Extra arr_extra_fields
			
			foreach($this->arr_extra_fields_func as $name_func)
			{
				
				$arr_row_final[]=$name_func($arr_row);
				
			}
			
			$arr_row_final=$this->$options_method($arr_row_final, $arr_row, $this->options_func, $this->url_options, $this->model_name, PhangoVar::$model[$this->model_name]->idmodel, $this->separator_element);
		
			middle_table_config($arr_row_final, $cell_sizes=array());
		
		}
		
		down_table_config();
		
		if($this->yes_pagination==1)
		{
		
			load_libraries(array('pages'));
			
			$total_elements=PhangoVar::$model[$this->model_name]->select_count($this->where_sql);
			
			echo '<p>'.PhangoVar::$lang['common']['pages'].': '.pages( $this->begin_page, $total_elements, $this->num_by_page, $this->url_options ,$this->initial_num_pages, $this->variable_page, $label='', $func_jscript='').'</p>';
		
		}
	
	}
	
	private function yes_add_options($arr_row, $arr_row_raw, $options_func, $url_options, $model_name, $model_idmodel, $separator_element)
	{
		
		$arr_row[]=implode($separator_element, $options_func($url_options, $model_name, $arr_row_raw[$model_idmodel], $arr_row_raw) );
		
		return $arr_row;

	}



	private function no_add_options($arr_row, $arr_row_raw, $options_func, $url_options, $model_name, $model_idmodel, $separator_element)
	{

		return $arr_row;

	}


}

?>