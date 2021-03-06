<?php

class Browser_list_fieldSwitchClass extends ControllerSwitchClass {

	public function index()
	{

		//global $model, PhangoVar::$base_path, PhangoVar::$base_url, PhangoVar::$config_data, $user_data, $lang, $arr_block, PhangoVar::$arr_cache_header, PhangoVar::$arr_cache_jscript, PhangoVar::$arr_module_list_form;
		
		load_model('admin');
		
		load_lang('forms', 'common');
		
		load_libraries(array('login', 'generate_admin_ng', 'simplelist', 'forms/selectmodelformbyorder', 'forms/selectmodelform'));
		
		$login=new LoginClass('user_admin', 'username', 'password', 'token_client', $arr_user_session=array('IdUser_admin', 'privileges_user', 'username', 'token_client'), $arr_user_insert=array('username', 'password', 'repeat_password', 'email'));
		
		settype($_GET['op'], 'integer');
		
		$_GET['op_edit']=0;
		
		$original_theme=PhangoVar::$dir_theme;

		//PhangoVar::$dir_theme=$original_theme.'/admin';

		//$arr_block='admin/admin_none';
		
		$headers='';
		
		//http://localhost/phangodev/index.php/jscript/show/browser_list_field/browser_list_field/module/descuentos/model/codigos_postales/field/codigo_postal/field_fill/cp_id
		
		/*if(check_admin($user_data['IdUser']))
		{*/
		
		PhangoVar::$arr_cache_jscript[]='jquery.min.js';
		
		$module=@slugify($_GET['module']);
		$model_name=@slugify($_GET['model']);
		$field_ident=@slugify($_GET['field']);
		$field_fill=@slugify($_GET['field_fill']);
		$category_model=@slugify($_GET['category_model']);
		$category_model_field=@slugify($_GET['category_model_field']);
		$category_field=@slugify($_GET['category_field']);
		$field_parent_category=@slugify($_GET['field_parent_category']);
		
		$yes_go=0;
		
		if(!$login->check_login())
		{
			
			//Check if permitted...
			
			//module/descuentos/model/codigos_postales/field/codigo_postal/field_fill/cp_id
			
			if(isset(PhangoVar::$arr_module_list_form[$module]))
			{
				
				if(PhangoVar::$arr_module_list_form[$module]['model']==$model_name && PhangoVar::$arr_module_list_form[$module]['field']==$field_ident && PhangoVar::$arr_module_list_form[$module]['field_fill']==$field_fill)
				{
				
					$yes_go=1;
				
				}
			
			}
		
		}
		else
		{
		
			$yes_go=1;
		
		}
		
		if($yes_go==0)
		{
		
			die;
		
		}
		
			ob_start();

			?>
			<script language="javascript">
			
				parent_window=window.parent;
				
				$(document).ready( function () {
				
					$('.select_id').click( function () {
						
						var form_modify = $('#<?php echo $field_fill; ?>_field_form', window.opener.document);
						var form_text_modify = $('#select_window_form_<?php echo $field_fill; ?>', window.opener.document);
						
						//Obtain class
						
						var class_id=$(this).attr('class').replace('select_id select_id_', '');
						
						form_modify.val(class_id).change();
						
						//alert(form_text_modify.attr('id'));
						
						var name_id=$('#text_field_'+class_id).html();
						
						form_text_modify.html(name_id);
						
						window.close();
						
						return false;
						
						//alert(window.opener.$('#form_generate_admin'));
						/*var form_admin=window.parent.document;
						
						alert(JSON.stringify(form_admin));*/
					
					});
			
				
				});
			
			</script>
			<?php
			
			PhangoVar::$arr_cache_header[]=ob_get_contents();
			
			ob_end_clean();
			
			load_model($module);
			
			ob_start();
			
			//Load model if exists...
			
			if(isset(PhangoVar::$model[$model_name]) && isset(PhangoVar::$model[$model_name]->components[$field_ident]))
			{
				
					
				$arr_fields=array($field_ident);
				$arr_fields_edit=array();
				
				$url_options=make_direct_url(PhangoVar::$base_url, 'forms', 'browser_list_field', array('module' => $module, 'model' => $model_name, 'field' => $field_ident, 'field_fill' => $field_fill, 'category_model' => $category_model, 'category_model_field' => $category_model_field, 'category_field' => $category_field));
				
				$where_sql='';
				
				if($category_model!='' && isset(PhangoVar::$model[$category_model]) && isset(PhangoVar::$model[$category_model]->components[$category_model_field]) && isset(PhangoVar::$model[$model_name]->components[$category_field]) )
				{
					
					settype($_GET['category_id'], 'integer');
					
					/*if(isset(PhangoVar::$model[$model_name]->components[$field_parent_category]))
					{
						echo load_view(array('title' => i18n_lang('common', 'filter_by_category', 'Filter by category'), SelectModelFormByOrder('category_id', '', $_GET['category_id'], $model_name, $category_model, $field_parent_category, $where='', $null_yes=1) ), 'content');
					}
					else
					{*/
						
					
					$form_html='<form method="get" action="'.$url_options.'/">'.SelectModelForm('category_id', '', $_GET['category_id'], $category_model, $category_model_field, '').'<input type="submit" value="'.i18n_lang('common', 'send', 'Send').'"/></form>';
					
					echo load_view(array('title' => i18n_lang('common', 'filter_by_category', 'Filter by category'),  $form_html), 'content');
					
					if($_GET['category_id']>0)
					{
						$where_sql='where '.$category_field.'="'.$_GET['category_id'].'"';
					}
					
					//}
				
				}
				
				$list=new SimpleList($model_name);
				
				$list->arr_fields=$arr_fields;
				
				$list->url_options=$url_options;
				
				$list->options_func='ChooseOptionsListModel';
				
				$list->where_sql=$where_sql;
				
				$list->show();
				
				//ListModel($model_name, $arr_fields, $url_options, $options_func='ChooseOptionsListModel', $where_sql, $arr_fields_form=array(), $type_list='Basic');
				
				
			
			}
			else
			{
			
				echo 'Check that <strong>'.$model_name.' model </strong> and <strong> field '.$field_ident.'</strong> is loaded';
			
			}
			
			$content=ob_get_contents();
			
			ob_end_clean();
			
			$title=''; //i18n_lang('forms', 'search_on_table', 'Search on table');
				
			echo load_view(array($title, $content, $block_title=array(), $block_content=array(), $block_urls=array(), $block_type=array(), $block_id=array(), $headers), 'admin/admin_none');
		//}

	}
	
}

function ChooseOptionsListModel($url_options, $model_name, $id, $arr_row)
{
	
	$field_ident=slugify($_GET['field']);
	
	$arr_options[]='<a href="#" class="select_id select_id_'.$id.'"><span style="display:none;" id="text_field_'.$id.'">'.$arr_row[$field_ident].'</span>'.i18n_lang('common', 'select', 'select').'</a>';
	
	return $arr_options;

}


?>
