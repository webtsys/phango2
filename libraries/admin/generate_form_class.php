<?php

class GenerateModelFormClass {

	public $arr_modelform;
	public $arr_fields;
	public $enctype;
	public $form_html_id;
	public $arr_categories;
	public $url_post;

	public __construct($arr_modelform, $arr_fields, $url_post, $enctype='', $form_html_id='', $arr_categories=array())
	{
	
		//($model_form, $arr_fields=array(), $url_post, $enctype='', $form_html_id='', $arr_categories=array())
		$this->arr_modelform=$model_form;
		$this->arr_fields=$arr_fields;
		$this->url_post=$url_post;
		$this->enctype=$enctype;
		
	
	}
	
	public function show_form()
	{
	
		
	
	}
	
	public function show_form_ajax()

}

?>