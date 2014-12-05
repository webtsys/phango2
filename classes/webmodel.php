<?php
/**
* Base file include where basic function and methods for create MVC applications
*
* This file contains principal functions and methods for create models, text formatting, forms creation, definition of basic variables, basic ORM that use on 90% of db searchs, etc...
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package Phango
*
*/

//Variables

// First, define basic variables

//Class for basic variables for phango. 
//This variables is used for internal functions in phango

class PhangoVar {

	/**
	* Variable for save ip
	*
	*/

	static public $ip='';
	
	/**
	* Database hosts array.
	*
	*/
	
	static public $host_db=array();

	/**
	* Database hosts array.
	*
	*/
	
	static public $db=array();
    
	static public $login_db=array();
    
	static public $pass_db=array();
	
	/**
	* Connection to db.
	*
	*/
	
	static public $connection=array();
	
	/**
	* Variable for cache the connection.
	*
	*/

	static public $connection_func=array();
	
	/**
	*
	*
	*/
	
	static public $select_db=array();
	
	/**
	* String where save the query if error.
	*
	*/
	
	static public $save_query=array();
	
	/**
	* Variable for the db prefix. For security, change this always.
	*
	*/
	
	static public $prefix_db='';
    
	static public $cookie_path='';
    
	static public $base_url='';
	
	static public $media_url='';
    
	static public $base_path='../';
	
	static public $media_path='../';
	
	static public $application_path='';
    
	static public $language='';
	
	static public $lang=array();
    
	static public $arr_i18n=array();
    
	static public $arr_i18n_ckeditor=array();
    
	static public $arr_i18n_tinycme=array();
    
	static public $app_index='';
 
	static public $activated_modules=array('media');
 
	/**
	*
	* Variable for define the theme, by default is 'default'
	*/
 
	static public $dir_theme='default';

	/**
	*
	* Is theme are in a module, define the module here.
	*
	*/
	
	static public $module_theme='';
	
	/**
	*
	* This "constant" define that the media are in a module or view if is set to 1. If 0, phango search the media in a normal url.
	*
	*/
	
	static public $THEME_MODULE=1;
 
	static public $prefix_key='';	
	
	/**
	* Global variable used for padmin and modules module for insert sql sentences when you install or add a new module or model
	*/

	static public $arr_module_sql=array();
	
	
	/**
	* Global variable used for padmin and modules module for insert a new module on database.
	*/

	static public $arr_module_insert=array();
	
	/**
	* Global variable used for padmin and modules module for remove a module of the database.
	*/

	static public $arr_module_remove=array();
	
	/**
	* Internal variable used for things how cli.php script
	*
	*/

	static public $utility_cli=0;
	
	/**
	*This variable is needed for add new fields to models without lost when you execute load_model without extension. Is saved in optional file added_fields.php
	*
	*/

	static public $arr_models_loading=array();

	//dir_theme  | module_theme        | portal_name              | portal_email        | x_avatar | y_avatar | date_format | time_format | timezone      | ampm  | accept_bbcode_signature | total_users | total_messages | name_guest | metatags | meta_description | meta_author | meta_copyright | foot           | active_users | ssl_feature | censoring | wait_message | surveys | index_page | user_extra | create_user | textbb_type | captcha_type | mailer_type | cond_register
	
	static public $portal_name='';
	
	static public $portal_email='';
	
	static public $date_format='';
	
	static public $time_format='';
	
	static public $timezone='';
	
	static public $ampm='';
	
	static public $textbb_type='';
	
	static public $captcha_type='';
	
	static public $mailer_type='';
	
	/**
	* Model, in this array you have access to the all models registered on your system with load_model
	* 
	*/
	
	static public $model=array();
	
	/**
	* Global Internal Array for save the field codified for use in public forms.
	*
	*/

	static public $arr_form_public=array();
	
	/** 
	* Array for check if a model exists searching in arr_check_table array created in framework.php file.
	*
	*/

	static public $arr_check_table=array();
	
	/**
	* An internal variable used for internal cache for load_view.
	*/

	static public $cache_template=array();

	/**
	* An internal variable used for save the actual module that is used for construct the base directory for controllers.
	*/
	
	static public $script_module='';
	
	static public $script_controller='';
	
	static public $script_action='';
	
	/**
	* Internal global variable used for load_model for cache loaded models.
	*/

	static public $cache_model=array();
	
	/**
	* Internal variable used for load model extensions.
	*
	*/
	
	static public $arr_extension_model=array();
	
	/**
	* An array used for control the loaded libraries previously.
	*/

	static public $cache_libraries=array();

	/**
	* Array used for know about language filed loaded.
	*
	*/
	
	static public $cache_lang=array();
	
	/**
	* Array used for load contents for html headers on home views...
	*
	*/
	
	static public $arr_cache_header=array();
	
	/**
	*
	* Global variable that control the css cache
	*
	*/

	static public $arr_cache_css=array();
	
	/**
	* Variable used for load the jscript files.
	*
	*/

	static public $arr_cache_jscript=array();
	
	/**
	*This variable is used for save general errors. 
	*/

	static public $std_error=''; 
	
	/**
	* This variable is used for save the urls of different modules
	*
	*/
	
	static public $urls=array();
	
	static public $rurls=array();
	
	/**
	* This variable is used for save the csrf token.
	*
	*/
	
	static public $key_csrf='';
	
	/**
	* This array save the get obtained from url phango format.
	*
	*/
	
	static public $get=array();
	
	static public $url_module_requires=array();
	
	static public $begin_page=0;
	
}


/**
*
* Actual timestamp
*
*/

//define("TODAY", mktime( date('H'), date('i'), date('s') ) );

/**
*
* Timestamp today to 00:00:00 hours
*
*/

//define("TODAY_FIRST", mktime(0, 0, 0));

/**
*
* Timestamp today to 23:59:59 hours
*
*/

//define("TODAY_LAST", mktime(23, 59, 59));

/**
*
* Timestamp today in this hour
*
*/

//define("TODAY_HOUR", mktime(date('H'), 0, 0));

/**
* Simple class for save datetime of the script.
*
*/

class DateTimeNow {

	/**
	*
	* Actual timestamp
	*
	*/

	static public $now='';

	/**
	*
	* Actual timestamp
	*
	*/

	static public $today='';

	/**
	*
	* Timestamp today to 00:00:00 hours
	*
	*/
	
	static public $today_first='';

	/**
	*
	* Timestamp today to 23:59:59 hours
	*
	*/
	
	static public $today_last='';

	/**
	*
	* Timestamp today in this hour
	*
	*/
	
	static public $today_hour='';
	
	/**
	*
	* Method for update properties of this class if the timezone is changed.
	*
	*/
	
	static public function update_datetime()
	{
	
		DateTimeNow::$today=mktime( date('H'), date('i'), date('s') );
		DateTimeNow::$now=DateTimeNow::$today;
		DateTimeNow::$today_first=mktime(0, 0, 0);
		DateTimeNow::$today_last=mktime(23, 59, 59);
		DateTimeNow::$today_hour=mktime(date('H'), 0, 0);
	
	}
	
}

/* property string $name The name of the model.
* property string $label A identifier used for show the name of model for humans.
* property string $idmodel The name of key field of the model.
* property array $components An array where objects of the PhangoField class are saved. This objects are needed for create fields on the table and each of these represents a field on db table.
* property array $forms An array where objects of the ModelForm class are saved. This objects are needed for create html forms based in the models. 
*/

//Classes

//Webmodel is the base class for all models
//This class is the base for construct all models. Models are saved in PhangoVar::$model array

/**
* The most important class for the framework
*
* Webmodel is a class for create objects that represent models. This models are a mirage of SQL tables. You can create fields, add indexes, foreign keys, and more.
*
*
*/

class Webmodel {

	/**
	*
	* With this property, you can define what is the server connection that you have to use for read the source data.
	* If you create a phango loader that balancer where you read the data, you can obtain many flexibility.
	* You can define how table related with a server for example.
	*
	*/

	public $db_selected='default';
	
	/**
	* The name of the model.
	*/
	
	public $name;
	
	/**
	* A identifier used for show the name of model for humans.
	*/
	
	public $label;
	
	/**
	* The name of key field of the model.
	*/
	
	public $idmodel;

	/**
	* An array where objects of the PhangoField class are saved. This objects are needed for create fields on the table and each of these represents a field on db table.
	*/

	public $components;
	
	/**
	*
	* An array where objects of the ModelForm class are saved. This objects are needed for create html forms based in the models.
	*
	*/
	
	public $forms;

	//Components is a array for the fields forms of this model

	//This variables define differents functions for use in automatize functions how generate_admin
	//I prefer this method instead of overloading function methods
	
	/**
	*
	* An string for use on internal tasks of generate automatic admin.
	*
	*/

	public $func_update='basic';

	/**
	* In this variable is store errors using the model...
	*/
	
	public $std_error='';

	/**
	* Variable for indicate to forms that this model have enctype...
	*/
	
	public $enctype='';
	
	/**
	* Array used for inverse foreign keys.
	*
	* This array is used when you need access to a model with a foreignkey key related with its. 
	* Example: array($key1 => array($field_connection, $field1, $field2 ....)) where key is the model name with related foreignkey, and the first element of array for the element is the connection (tipically a foreignkeyfield).
	*/
	
	public $related_models=array();
	
	/**
	* An array where the model save the name of the related models via ForeignKeyField. You need use $this->set_component method for fill this array.
	*/
	
	public $related_models_delete=array();
	
	/**
	*
	* If you checked the values that you going to save on your model, please, put this value to 1 or true.
	*
	*/
	
	public $prev_check=0;
	
	/**
	*
	* Property for set if the next select query have a DISTINCT sentence.
	*
	*/
	
	public $distinct=0;
	
	/**
	* Property for save the required fields where you use reset_require method
	* 
	*/
	
	public $save_required=array();
	
	/**
	* Property for select the fields for update or insert
	* 
	*/
	
	public $arr_fields_updated=array();

	//Construct the model

	/**
	* Basic constructor for model class.
	*
	* Phango is a MVC Framework. The base of a MVC framework are the models. A Model is a representation of a database table and are used for create, update and delete information. With the constructor your initialize variables how the name of model, 
	*
	* @param string $name_model is the name of the model
	* 
	* 
	*/
	
	public function __construct($name_model)
	{

		$this->name=$name_model;
		$this->idmodel='Id'.ucfirst($this->name);
		$this->components[$this->idmodel]=new PrimaryField();
		$this->label=$this->name;
		
		if(!isset(PhangoVar::$connection_func[$this->db_selected]))
		{
		
			PhangoVar::$connection_func[$this->db_selected]='connect_to_db';
		
		}

	}
	
	/**
	* Method for connect to the db
	*
	*/
	
	public function connect_to_db()
	{
		
		include(PhangoVar::$base_path.'database/'.TYPE_DB.'.php');
	
		if(!webtsys_connect( PhangoVar::$host_db[$this->db_selected], PhangoVar::$login_db[$this->db_selected], PhangoVar::$pass_db[$this->db_selected] , $this->db_selected))
		{
		
			$output=ob_get_contents();
			
			ob_clean();

			//$text_error='<p>Output: '.$output.'</p>';

			$arr_error_sql[0]='<p>Error: Cannot connect to MySQL db.</p>';    
			$arr_error_sql[1]='<p>Error: Cannot connect to MySQL db, '.$output.'</p>';
		
			show_error($arr_error_sql[0], $arr_error_sql[1]);
		
		}

		PhangoVar::$select_db[$this->db_selected]=webtsys_select_db( PhangoVar::$db[$this->db_selected] , $this->db_selected);
		
		if(PhangoVar::$select_db[$this->db_selected]!=false && PhangoVar::$connection[$this->db_selected]!=false)
		{
			
			PhangoVar::$connection_func[$this->db_selected]='dummy_connect_to_db';
			
		}
		else
		{
		
			$output=ob_get_contents();
			
			ob_clean();

			//$text_error='<p>Output: '.$output.'</p>';

			$arr_error_sql[0]='<p>Error: Cannot connect to MySQL db.</p>';    
			$arr_error_sql[1]='<p>Error: Cannot connect to MySQL db, '.$output.'</p>';
		
			show_error($arr_error_sql[0], $arr_error_sql[1]);
		
		}
		
	
	}
	
	/**
	* Dummy function for save an if by query.
	*
	*/
	
	public function dummy_connect_to_db()
	{
	
		
	
	}
	
	public function set_phango_connection()
	{
		
		$method_connection=PhangoVar::$connection_func[$this->db_selected];
		
		$this->$method_connection();
	
	}
	
	/**
	* A method for change the name of the id field.
	* 
	* Id Field is the field that in the database is used how basic identifier. By default, this name is Id.ucfirst($this->name) but you can change its name with this method after you have declared a new model instance.
	*
	* @param string $name_id is the name of the id field.
	*/

	public function change_id_default($name_id)
	{

		//Check if i create more components, if create more, die.

		if(count($this->components)>1)
		{

			show_error('<p>Error in a model for use ids.</p>', '<p>Error in model '.$this->name.' for use change_id_default. This method must be used before any component.</p>');

		}
		
		unset($this->components[$this->idmodel]);
		$this->idmodel=$name_id;
		$this->components[$this->idmodel]=new PrimaryField();

	}
	
	/**
	*
	* A method for connect to the db.
	*
	*
	*/

	//This method insert a row in database using model data

	//Method for create a new row in the model.
	//@param $post is a array where each key is referred to a model field. 
	
	/**
	* This method insert a row in database using model how mirage of table.
	* 
	* On a db, you need insert data. If you have created a model that reflect a sql table struct, with this method you can insert new rows easily without write sql directly.
	*
	* @param array $post Is an array with data to insert. You have a key that represent the name of field to fill with data, and the value that is the data for fill.
	*/

	public function insert($post)
	{
	
		$this->set_phango_connection();
		
		//Make conversion from post
		
		$post=$this->unset_no_required($post);
		
		//Check if minimal fields are fill and if fields exists in components.Check field's values.
		
		unset($post[$this->idmodel]);
		
		$arr_fields=array();
		
		if( $fields=$this->check_all($post) )
		{	
			
			//Foreach for create the query that comes from the $post array
			
			foreach($fields as $key => $field)
			{
			
				$quot_open=$this->components[$key]->quot_open;
				$quot_close=$this->components[$key]->quot_close;
			
				if(get_class($this->components[$key])=='ForeignKeyField' && $fields[$key]==NULL)
				{
				
					
					$quot_open='';
					$quot_close='';
					
					if($this->components[$key]->yes_zero==0)
					{
						$fields[$key]='NULL';
					}
				}
			
				$arr_fields[]=$quot_open.$fields[$key].$quot_close;
			
			}
		
			if( !( $query=webtsys_query('insert into '.$this->name.' (`'.implode("`, `", array_keys($fields)).'`) VALUES ('.implode(", ",$arr_fields).') ', $this->db_selected) ) )
			{
			
				$this->std_error.=PhangoVar::$lang['error_model']['cant_insert'].' ';
				return 0;
			
			}
			else
			{
			
				return 1;
				
			}
		}
		else
		{	
			
			$this->std_error.=PhangoVar::$lang['error_model']['cant_insert'].' ';

			return 0;

		}
		
	}

	//Method update a row in database using model data
	//@param $post is a array where each key is referred to a model field. 
	//@param $conditions is a sql sentence for specific conditions for the query Example: "where id=2"
	
	/**
	* This method update rows from a database using model how mirage of table.
	* 
	* If you have inserted a row, you'll need update in the future, with this method you can update your row.
	*
	* @param $post Is an array with data to update. You have a key that represent the name of field to fill with data, and the value that is the data for fill.
	* @param $conditions is a string containing a sql string beginning by "where". Example: where id=1.
	*/
	
	public function update($post, $conditions="")
	{
	
		$this->set_phango_connection();
		
		//Make conversion from post

		//Check if minimal fields are fill and if fields exists in components.

		$arr_fields=array();

		//Unset the id field from the model for security
		
		unset($post[$this->idmodel]);
		
		$post=$this->unset_no_required($post);
		
		//Checking and sanitizing data from $post array for use in the query
		
		if( $fields=$this->check_all($post) )
		{
			
			//Foreach for create the query that comes from the $post array
			
			foreach($this->components as $key => $component)
			{
				if(isset($fields[$key]))
				{
				
					$quot_open=$component->quot_open;
					$quot_close=$component->quot_close;
				
					if(get_class($component)=='ForeignKeyField' && $fields[$key]==NULL)
					{
					
						$quot_open='';
						$quot_close='';
						$fields[$key]='NULL';
					
					}
				
					$arr_fields[]='`'.$key.'`='.$quot_open.$fields[$key].$quot_close;
					
				}
	
			}
			
			//Load method for checks the values on database directly. PhangoFields how ParentField, need this for don't create circular dependencies.
		
			/*foreach($this->components as $name_field => $component)
			{*/
			
			foreach($fields as $name_field => $val_field)
			{
			
				if(method_exists($this->components[$name_field],  'process_update_field'))
				{
					
					if(!$component->process_update_field($this, $name_field, $conditions, $fields[$name_field]))
					{
						
						$this->std_error.=PhangoVar::$lang['error_model']['cant_update'].' ';

						return 0;
					
					}
				
				}
			
			}

			//Create the query..
		
			if(!($query=webtsys_query('update '.$this->name.' set '.implode(', ' , $arr_fields).' '.$conditions, $this->db_selected) ) )
			{
				
				$this->std_error.=PhangoVar::$lang['error_model']['cant_update'].' ';
				return 0;
			
			}
			else
			{
			
				return 1;
			
			}
		}
		else
		{
			//Validation of $post fail, add error to $model->std_error
			
			$this->std_error.=PhangoVar::$lang['error_model']['cant_update'].' ';

			return 0;

		}

	}

	//This method select a row in database using model data
	//You have use webtsys_fetch_row or alternatives for obtain data
	//Conditions are sql lang, more simple, more kiss
	
	/**
	* This method is a primitive for select rows from a model that represent a table of a database.
	* 
	* If you have inserted a row, you'll need update in the future, with this method you can update your row.
	*
	* You can select rows with sql joins if you add a foreignkey field on $arr_select.
	*
	* @param $conditions is a string containing a sql string beginning by "where". Example: where id=1.
	* @param $arr_select is an array contain the selected fields of the model for obtain. If is not set, all fields are selected.
	* @param $raw_query If set to 0, you obtain fields from table related if you selected a foreignkey field, if set to 1, you obtain an array without any join.
	*/

	public function select($conditions="", $arr_select=array(), $raw_query=0)
	{
		//Check conditions.., script must check, i can't make all things!, i am not a machine!

		$this->set_phango_connection();
		
		if(count($arr_select)==0)
		{
		
			$arr_select=array_keys($this->components);
			

		}
		else
		{
			
			$arr_select=array_intersect($arr_select, array_keys($this->components));

		}

		//$arr_extra_select is an hash for extra fields from related models
		$arr_extra_select=array();
		//$arr_model is an array where are stored the tables used in the query, it is usually only referred to the model table
		$arr_model=array($this->name);
		//$arr_where is an array where is stored the relationship between models
		$arr_where=array('1=1');
		
		$arr_extra_model=array();

		foreach($arr_select as $key => $my_field)
		{
			//Check if field is a key from a related_model

			$arr_select[$key]=$this->name.'.`'.$my_field.'`';

			//Check if a field link with other field from another table...

			//list($arr_select, $arr_extra_select, $arr_model, $arr_where)=$this->recursive_fields_select($key, $this->name, $my_field, $raw_query, $arr_select, $arr_extra_select, $arr_model, $arr_where);
			if(get_class($this->components[$my_field])=='ForeignKeyField')
			{
			
				$arr_extra_model[$key]=$my_field; //$this->components[$my_field]->related_model;
			
			}
			
		}
		
		if($raw_query==0)
		{
		
			//Add fields defined on fields_related_model.
			
			foreach($arr_extra_model as $key => $my_field)
			{
			
				$model_name_related=$this->components[$my_field]->related_model;
				
				//Set the value for the component foreignkeyfield if name_field_to_field is set.
			
				if($this->components[$my_field]->name_field_to_field!='')
				{
				
					$arr_select[$key]=$model_name_related.'.`'.$this->components[$my_field]->name_field_to_field.'` as `'.$my_field.'`';
					
				}
				
				//Set the new fields added for related model...
				
				foreach($this->components[$my_field]->fields_related_model as $fields_related)
				{
				
					$arr_select[]=$model_name_related.'.`'.$fields_related.'` as `'.$model_name_related.'_'.$fields_related.'`';
				
				}
				
				$arr_model[]=$model_name_related;
				
				//Set the where connection
				
				$arr_where[]=$this->name.'.`'.$my_field.'`='.$model_name_related.'.`'.PhangoVar::$model[$model_name_related]->idmodel.'`';
			
			}
			
			//Now define inverse relationship...
			
			foreach($this->related_models as $model_name_related => $fields_related)
			{
			
				foreach($fields_related as $field_related)
				{
				
					$arr_select[]=$model_name_related.'.`'.$field_related.'` as `'.$model_name_related.'_'.$field_related.'`';
					
				}
				
				$arr_model[]=$model_name_related;
				
				$arr_where[]=$this->name.'.`'.$this->idmodel.'`='.$model_name_related.'.`'.$fields_related[0].'`';
			
			}
		
		}

		//Final fields from use in query
		
		$fields=implode(", ", $arr_select);

		//The tables used in the query
		
		$arr_model=array_unique($arr_model, SORT_STRING);

		$selected_models=implode(", ", $arr_model);
		
		//Conditions for the select query for related fields in the model
		$where=implode(" and ", $arr_where);

		//$conditions is a variable where store the result from $arr_select and $arr_extra_select
		
		if(preg_match('/^where/', $conditions) || preg_match('/^WHERE/', $conditions))
		{
			
			$conditions=str_replace('where', '', $conditions);
			$conditions=str_replace('WHERE', '', $conditions);

			$conditions='WHERE '.$where.' and '.$conditions;

		}
		else
		{
			
			$conditions='WHERE '.$where.' '.$conditions;

		}

		//$this->create_extra_fields();
		
		//Make the query...
		
		$arr_distinct[$this->distinct]='';
		$arr_distinct[0]='';
		$arr_distinct[1]=' DISTINCT ';
		
		$query=webtsys_query('select '.$arr_distinct[$this->distinct].' '.$fields.' from '.$selected_models.' '.$conditions, $this->db_selected);
		
		$this->distinct=0;
		
		return $query;
		
	}

	//This method count num rows for the sql condition
	
	/**
	* This method is used for count the number of rows from a conditions.
	*
	* Using this method you count number of rows affected by $conditions. $conditions use the same sql sintax that $this->select 
	*
	* @param string $conditions is a string containing a sql string beginning by "where". Example: where id=1.
	* @param string $field The field to count, if no is set $field=$this->idmodel.
	* @param string $fields_for_count Array for fields used for simple counts based on foreignkeyfields.
	*/

	public function select_count($conditions, $field='', $fields_for_count=array())
	{
	
		$this->set_phango_connection();
		
		if($field=='')
		{
		
			$field=$this->idmodel;
		
		}
	
		$arr_model=array($this->name);
		$arr_where=array('1=1');
		
		$arr_check_count=array();
		
		foreach($fields_for_count as $key_component)
		{
		
			if(isset($this->components[$key_component]))
			{
		
				$component=$this->components[$key_component];
			
				if(get_class($component)=='ForeignKeyField')
				{
				
					$table_name=$component->related_model;
				
					if(isset($arr_check_count[$table_name]))
					{
				
						$table_name.='_'.uniqid();
						
					}
				
					$arr_model[]=$component->related_model.' as '.$table_name;
			
					$arr_where[]=$this->name.'.`'.$key_component.'`='.$table_name.'.`'.PhangoVar::$model[$component->related_model]->idmodel.'`';
					
					$arr_check_count[$table_name]=1;
				
				}
				
			}
		}
		
		foreach($this->related_models as $model_name_related => $fields_related)
		{
			
			$arr_model[]=$model_name_related;
			
			$arr_where[]=$this->name.'.`'.$this->idmodel.'`='.$model_name_related.'.`'.$fields_related[0].'`';
		
		}
		
		$where=implode(" and ", $arr_where);
		
		if(preg_match('/^where/', $conditions) || preg_match('/^WHERE/', $conditions))
		{
			
			$conditions=str_replace('where', '', $conditions);
			$conditions=str_replace('WHERE', '', $conditions);

			$conditions='WHERE '.$where.' and '.$conditions;
			
		}
		else
		{
			
			$conditions='WHERE '.$where.' '.$conditions;

		}
		
		$query=webtsys_query('select count('.$this->name.'.`'.$field.'`) from '.implode(', ', $arr_model).' '.$conditions, $this->db_selected);
		
		list($count_field)= webtsys_fetch_row($query);

		return $count_field;

	}

	/**
	* This method delete rows for the sql condition
	*
	* This method is used for delete rows based in a sql conditions. If you use $this->set_component method for create new fields for model, $this->delete will delete all rows from model with foreignkeys related with this model. This thing is necessary because foreignkeys need to be deleted if you deleted its related model.
	*
	* @param string $conditions Conditions have same sintax that $conditions from $this->select method
	*/

	public function delete($conditions="")
	{
	
		$this->set_phango_connection();
	
		foreach($this->components as $name_field => $component)
		{
		
			if(method_exists($component,  'process_delete_field'))
			{
			
				$component->process_delete_field($this, $name_field, $conditions);
			
			}
		
		}
		
		//Delete rows on models with foreignkeyfields to this model...
		//You need load all models with relationship if you want delete related rows...
		
		if(count($this->related_models_delete)>0)
		{
			
			$arr_deleted=$this->select_to_array($conditions, array($this->idmodel), 1);
			
			$arr_id=array_keys($arr_deleted);
			
			$arr_id[]=0;
			
			foreach($this->related_models_delete as $arr_set_model)
			{
				
				if( isset( PhangoVar::$model[ $arr_set_model['model'] ]->components[ $arr_set_model['related_field'] ] ) )
				{
					
					PhangoVar::$model[ $arr_set_model['model'] ]->delete('where '.$arr_set_model['related_field'].' IN ('.implode(', ', $arr_id).')');
				
				}
			
			}
			
		}

 		return webtsys_query('delete from '.$this->name.' '.$conditions, $this->db_selected);
		
	}
	
	/**
	* A helper function for obtain an array from a result of $this->select
	*
	* @param mixed $query The result of an $this->select operation
	*/
	
	public function fetch_row($query)
	{
	
		$this->set_phango_connection();
	
		return webtsys_fetch_row($query);
	
	}
	
	/**
	* A helper function for obtain an associative array from a result of $this->select
	*
	* @param mixed $query The result of an $this->select operation
	*/
	
	public function fetch_array($query)
	{
	
		$this->set_phango_connection();
	
		return webtsys_fetch_array($query);
	
	}
	
	/**
	* A helper function for obtain the last insert id.
	*
	* @param mixed $query The last insert id.
	*/
	
	static public function insert_id()
	{
		
		$this->set_phango_connection();
	
		return webtsys_insert_id();
	
	}

	/**
	* A helper function for get fields names of the model from the array $components
	*
	* This method is used if you need the fields names from a model for many tasks, for example, filter fields.
	*/

	public function all_fields()
	{
	
		if(count($this->forms)==0)
		{
		
			$this->create_form();
		
		}
	
		return array_keys($this->forms);

	}
	
	/**
	* A helper function for get fields names of the model from the array $components except some fields.
	*
	* This method is used if you need the fields names from a model for many tasks, for example, filter fields and you don't want all fields.
	*
	* @param array $arr_strip Array with the fields that you don't want on returned array.
	*/
	
	public function stripped_all_fields($arr_strip)
	{
	
		$arr_total_fields=$this->all_fields();

		return array_diff($arr_total_fields, $arr_strip);

	}
	
	/**
	* Internal method for check value for a field.
	*
	* @param string $key Defines the field used for insert the value
	* @param mixed $value The value to check
	*/
	
	public function check_element($key, $value)
	{
	
		return $this->components[$key]->check($value);
	
	}
	
	/**
	* A dummy function for internal tasks on $this->check_all method
	*
	* @param string $key Defines the field used for insert the value
	* @param mixed $value The value to check
	*/
	
	public function no_check_element($key, $value)
	{
	
		return $value;
	
	}

	/**
	* Check if components are valid, if not fill $this->std_error
	*
	* Check if an array of values for fill a row from a model are valid before insert on database. 
	*
	* @param array $post Is an array with data to update. You have a key that represent the name of field to fill with data, and the value that is the data for fill.
	*/

	public function check_all($post)
	{
		
		load_lang('error_model');
	
		//array where sanitized values are stored...
		
		$func_check='check_element';
		
		if($this->prev_check==1)
		{
		
			$func_check='no_check_element';
		
		}

		$arr_components=array();

		$set_error=0;

		$arr_std_error=array();

		//Make a foreach inside components, fields that are not found in components, are ignored
		
		foreach($this->components as $key => $value)
		{
			
			//If is set the variable for this component make checking

			if(isset($post[$key]))
			{

				//Check if the value is valid..

				$arr_components[$key]=$this->$func_check($key, $post[$key]);

				//If value isn't valid and is required set error for this component...

				if($this->components[$key]->required==1 && $arr_components[$key]=="")
				{	

					//Set errors...

					if($this->components[$key]->std_error=='')
					{

						$this->components[$key]->std_error=PhangoVar::$lang['common']['field_required'];

					}

					$arr_std_error[]=PhangoVar::$lang['error_model']['check_error_field'].' '.$key.' -> '.$this->components[$key]->std_error. ' ';
					$set_error++;
	
				}
		
			}
			else if($this->components[$key]->required==1)
			{
	
				//If isn't set the value and this value is required set std_error.

				$arr_std_error[]=PhangoVar::$lang['error_model']['check_error_field_required'].' '.$key.' ';
	
				if($this->components[$key]->std_error=='')
				{

					$this->components[$key]->std_error=PhangoVar::$lang['common']['field_required'];

				}
	
				$set_error++;

			}

		}

		//Set std_error for the model where is stored all errors in checking...

		$this->std_error=implode(', ', $arr_std_error);

		//If error return false

		if($set_error>0)
		{

			return 0;

		}

		//If not return values sanitized...

		return $arr_components;

	}

	/**
	* Simple method for secure if you don't want that a user send values to a fields of a model.
	*
	* This method is used if you don't want that the users via POST or GET send values to a field. This method simply delete the fields from the model. With field destroyed is impossible write in it.
	*
	* @param array $arr_components Array with fields names that you want delete from model.
	*/

	public function unset_components($arr_components=array())
	{

		foreach($arr_components as $value)
		{
			$stack[$value]=$this->components[$value];
			unset($this->components[$value]);
		}

		return $stack;

	}
	
	public function unset_no_required($post)
	{
	
		return filter_fields_array($this->arr_fields_updated, $post);
	
	}

	/**
	* Method for create an array of forms used for create html forms.
	*
	* This method is used for initialize an ModelForm array. This array is used for create a form based on fields of the model.
	*
	* @param array $fields_form The values of this array are used for obtain ModelForms from the fields with the same key that array values.
	*/
	
	public function create_form($fields_form=array())
	{

		//With function for create form, we use an array for specific order, after i can insert more fields in the form.

		$this->forms=array();
		
		$arr_form=array();
		
		if(count($fields_form)==0)
		{
		
			$fields_form=array_keys($this->components);
			
		}
		
		//foreach($this->components as $component_name => $component)
		foreach($fields_form as $component_name)
		{
		
			if(isset($this->components[$component_name]))
			{
			
				$component=&$this->components[$component_name];
			
				//Create form from model's components

				$this->forms[$component_name]=new ModelForm($this->name, $component_name, $component->form, set_name_default($component_name), $component, $component->required, '');
				
				$this->forms[$component_name]->set_all_parameters_form($component->get_parameters_default());
				
				if($this->components[$component_name]->label=='')
				{
				
					$this->components[$component_name]->label=ucfirst($component_name);
				
				}
				
				$this->forms[$component_name]->label=$this->components[$component_name]->label;

				//Set parameters to default
				//$parameters_value=$this->components[$component_name]->parameters;

				/*if($this->forms[$component_name]->parameters[2]==0)
				{*/
	
				//$this->forms[$component_name]->parameters=$this->components[$component_name]->parameters;
					

				//}

				//Use method from ModelForm for set initial parameters...

				//$this->forms[$component_name]->set_parameter_value($parameters_initial_value);
				
			}

		}

	}

	/**
	* Method for obtain an array with all errors in components
	* 
	* This method is used for obtain errors when a transaction (insert, update) was failed.
	*
	*/
	
	public function return_error_form()
	{

		$arr_error=array();

		foreach($this->components as $component_name => $component)
		{

			$arr_error[$component_name]=$component->std_error;

		}

		return $arr_error;

	}
	
	/**
	* Method for reset required fields.
	*
	* Method for reset required fields from components. Use this if you need update a field from a model but you don't want update other required fields.
	*/
	
	public function reset_require()
	{

		foreach($this->components as $component_name => $component)
		{

			$this->save_required[$component_name]=$this->components[$component_name]->required;
		
			$this->components[$component_name]->required=0;

		}

	}
	
	/**
	* Method for load saved required values for the fields...
	*
	* Method for load required values fields from components. Use this if you need recovery required values if you reseted them...
	*
	*/
	
	public function reload_require()
	{
		
		foreach($this->save_required as $field_required => $value_required)
		{
		
			$this->components[$field_required]->required=$this->save_required[$field_required];

		}

	}
	
	/**
	* Method used by form views for know if the form from this model have FileField...
	*
	* Internal method used for set enctype variable, necessary for diverses views for forms.
	*/

	public function set_enctype_binary()
	{

		$this->enctype='enctype="multipart/form-data"';

	}
	
	/**
	* API definition for method extensions based in function __call
	*
	* This method is used for define an easy format for create extensions for Webmodel class.
	*
	* For create una extension, you need create a file called name_extension.php on libraries/classes_extensions/ directory where name_extension is the basic name of new method.
	* On name_extension.php you must create a function with this name and arguments:
	* 
	* Example: function name_extension_method_class($class, argument1, $argument2, ...)
	*
	*
	* @param string $name_method Name of the new method
	* @param array $arguments An array with the arguments used in the new method
	*/
	
	public function __call($name_method, $arguments)
	{
	
		load_libraries(array('classes_extensions/'.$name_method));
	
		array_unshift($arguments, $this);
	
		return call_user_func_array($name_method.'_method_class', $arguments);
	
	}
	
	/**
	* Experimental method for check elements on a where string
	*
	* @param array $arr_where An array with values to check
	*/
	
	static public function check_where($arr_where)
	{
	
		foreach($arr_where as $key => $value)
		{
		
			$arr_where[$key]=$this->components[$key]->check($value);
		
		}
		
		return $arr_where;
	
	}
	
	/**
	* A method for add components or fields (fields of a table on a db) to a model(table of a db).
	*
	* This is a method for create new fields for a model. You can create a field on a table with two methods: first, directly using fields or components classes, second, with this method. This method is recommended because give to you more info about your model to your component.
	*
	* @param string $name The name of the model 
	* @param string $type Field type, based on a phangofield class
	* @param string $arguments Array with arguments for construct the new field
	* @param boolean $required A boolean used for set the default required value
	*/
	public function set_component($name, $type, $arguments, $required=0)
	{
	
		$rc=new ReflectionClass($type);
		$this->components[$name]=$rc->newInstanceArgs($arguments);
		//Set first label...
		$this->components[$name]->label=set_name_default($name);
		$this->components[$name]->name_model=$this->name;
		$this->components[$name]->name_component=$name;
		$this->components[$name]->required=$required;
		
		$this->components[$name]->set_relationships();
	
	}
	
	/**
	*
	* A experimental method for insert a form inside of $this->forms array after of a chosen field.
	*
	* This method us used for insert a form field inside of $this->forms array after of a chosen field.
	*
	* @param string $name_form_after Name of the form inside on $this->forms where you want put the new form after
	*
	* @param string $name_form_new Name of the new form after of $name_form_after
	*
	* @param string $form_new The new form, created using ModelForm class.
	*
	*/
	
	public function insert_after_field_form($name_form_after, $name_form_new, $form_new)
	{
	
		$arr_form_new=array();
	
		foreach($this->forms as $form_key => $form_field)
		{
		
			$arr_form_new[$form_key]=$form_field;
			
			if($form_key==$name_form_after)
			{
				
				$arr_form_new[$name_form_new]=$form_new;
			
			}
		
		}
		
		$this->forms=$arr_form_new;
	
	}

}

/**
*
* Fill a ModelForm array with default values.
*
* With this method you can set an array consisting of ModelForm items with the values from $post.
*
* @param array $post is an array with the values to be inserted on $arr_form. The keys must have the same name that keys from $arr_form
* @param array $arr_form is an array of ModelForms. The key of each item is the name of the ModelForm item.
* @param array $show_error An option for choose if in the form is showed 
*/

function set_values_form($post, $arr_form, $show_error=1)
{
	
	//Foreach to $post values
	
	if(gettype($post)=='array')
	{
		foreach($post as $name_field => $value)
		{
			
			//If exists a ModelForm into $arr_form with the same name to $name_field check if have a $component field how "type" and set error if exists

			if(isset($arr_form[$name_field]))
			{	
				
				if($arr_form[$name_field]->type->std_error!='' && $show_error==1)
				{
					
					/*if($arr_form[$name_field]->std_error!='')
					{
						
						$arr_form[$name_field]->std_error=$arr_form[$name_field]->txt_error;
						

					}
					else*/
					if($arr_form[$name_field]->std_error=='')
					{
						
						$arr_form[$name_field]->std_error=$arr_form[$name_field]->type->std_error;

					}

				}

				//Set value for ModelForm to $value
				
				$arr_form[$name_field]->set_param_value_form($value);
		
			}
			else
			{

				unset($post[$name_field]);

			}

		}

	}
}


//Class ModelForm is the base class for create forms...

/**
* ModelForm is a class used for create and manipulate forms.
*
* ModelForm is a class used for create and manipulate forms. With this, you can create a complete html form, check, fill with values, etc..., when you create a ModelForm, you create a field of a form. If you want a form, create an array with ModelForms and 
*
*/

class ModelForm {


	/**
	* The name of the form where is inserted this form element
	* 
	*/

	public $name_form;
	
	/**
	* The name of this ModelForm 
	* 
	*/
	
	public $name;
	
	/**
	* String with the name of the function for show the form. For example 'TextForm'.
	* 
	*/
	
	public $form;
	
	/**
	* Text that is used on html form for identify the field.
	* 
	*/
	
	public $label;
	
	/**
	* Text that is used on html for identify the class label containment.
	* 
	*/
	
	public $label_class='';
	
	/**
	*  DEPRECATED An string used for internal tasks of older versions of generate_admin
	* *@deprecated Used on older versions of generate_admin
	* 
	*/
	
	public $set_form;
	
	/**
	*  String where the error message from a source is stored
	* 
	*/
	
	public $std_error;
	
	/**
	*  String where the default error message is stored if you don't use $this->std_error
	* 
	*/
	
	public $txt_error;
	
	/**
	*  Internal string used for identify fields when name fields protection is used.
	* 
	*/
	
	public $html_field_name='';
	
	/**
	*  Boolean that defined if this ModelForm is required in the form or not. If is required, set to true or to 1.
	* 
	*/
	
	public $required=0;
	
	/**
	*  Internal boolean that control if the field was filled correctly or not.
	* 
	*/
	
	public $error_flag=0;
	
	/**
	* Constructor for create a new ModelForm. ModelForm are used for create forms easily.
	* 
	* @param string $name_form  The name of the form where is inserted this form element
	* @param string $name_field The name of this ModelForm 
	* @param string $form String with the name of the function for show the form. For example 'TextForm'.
	* @param string $label Text that is used on html form for identify the field.
	* @param PhangoField $type PhangoField instance, you need this if you want check the value of the ModelForm.
	* @param boolean $required Internal boolean that control if the field was filled correctly or not.
	* @param array $parameters Set first set of parameters for $this->form. This element cover the third argument of a Form function.
	*
	*/

	function __construct($name_form, $name_field, $form, $label, $type, $required=0, $parameters='')
	{

		$this->name_form = $name_form;
		$this->name = $name_field;
		$this->form = $form;
		$this->type = $type;
		$this->label = $label;
		$this->std_error = '';
		$this->txt_error = PhangoVar::$lang['common']['error_in_field'];
		$this->required = $required;

		$this->html_field_name=$name_field;

		switch(DEBUG)
		{

			default:
				
				$prefix_uniqid=generate_random_password();
								
				if(!isset($_SESSION['fields_check'][$name_field]))
				{
					$this->html_field_name=uniqid($prefix_uniqid);
				
					$_SESSION['fields_check'][$name_field]=$this->html_field_name;
					$_SESSION['fields_check'][$this->html_field_name]=$name_field;
					
				}
				else
				{
				
					$this->html_field_name=$_SESSION['fields_check'][$name_field];
				
				}
			
				/*$this->html_field_name[$name_field]=$html_field_name;

				if(isset($_POST[$html_field_name]))
				{

					$_POST[$name_field]=&$_POST[$html_field_name];

				}

				if(isset($_FILES[$html_field_name]))
				{

					$_FILES[$name_field]=&$_FILES[$html_field_name];

				}*/

			break;

			case 1:

				$this->html_field_name=$name_field;
				

			break;
		}
		
		//$this->html_field_name=$name_field; slugify($this->label, $respect_upper=0, $replace_space='-', $replace_dot=1, $replace_barr=1);

		PhangoVar::$arr_form_public[$this->html_field_name]=$name_field;

		$this->parameters = array($this->html_field_name, $class='', $parameters);

	}
	
	public function change_label_html($new_label)
	{
	
		$this->html_field_name=slugify($new_label, $respect_upper=0, $replace_space='-', $replace_dot=1, $replace_barr=1);
		
		$this->parameters[0]=$this->html_field_name;
	
	}
	
	public function return_name_form()
	{
	
		return $this->html_field_name;
	
	}
	
	
	/**
	*
	* Method for set default value in the form.
	*
	* @param mixed $value The value passed to the form
	* @param string $form_type_set Parameter don't used for now.
	*
	*/

	function set_param_value_form($value, $form_type_set='')
	{
		
		$func_setvalue=$this->form.'Set';
		
		$this->parameters[2]=$func_setvalue($this->parameters[2], $value, $form_type_set);
		
	}
	

	/**
	*
	* Method for set third argument of a form function. Third argument can be mixed type.
	*
	* @param mixed $parameters Third argument for the chose form function
	*
	*/
	
	function set_parameter_value($parameters)
	{
		
		$this->parameters[2]=$parameters;
		
	}
	
	/**
	*
	* Method for set all arguments for a form function except name.
	*
	* @param mixed $parameters Third argument for the chose form function
	*
	*/
	
	function set_parameters_form($parameters=array())
	{
	
		$z=1;
	
		foreach($parameters as $parameter)
		{
		
			$this->parameters[$z]=$parameter;
			
			$z++;
			
		}
		
	}
	
	function set_parameter($key, $value)
	{
		
		$this->parameters[$key]=$value;
	
	}
	
	/**
	*
	* @warning 
	*
	* Method for set all arguments of a form function. DONT USE IF YOU DON'T KNOW WHAT ARE YOU DOING
	* 
	* @param array $parameters An array with arguments for the form function used for this ModelForm
	*
	*/
	
	function set_all_parameters_form($parameters)
	{
		
		$this->parameters=$parameters;
		
	}
	
	/**
	*
	* Static method for check an array of ModelForm instances. 
	*
	* With this method you can check if the values of an array called $post (tipically $_POST) are valid for the corresponding values of an array $arr_form, consisting of ModelForm items.
	*
	* @param array $arr_form Array consisting of ModelForm items, used for check the values. The array need keys with the name of the ModelForm instance.
	* @param array $post Array consisting of values. The array need that the keys was the same of $arr_form.
	*
	*/

	static function check_form($arr_form, $post)
	{

		$error=0;
		
		$num_form=0;
		
		foreach($post as $key_form => $value_form)
		{
			
			//settype($post[$key_form], 'string');
			
			if(isset($arr_form[$key_form]))
			{
			
				$form=$arr_form[$key_form];
			
				$post[$key_form]=$form->type->check($post[$key_form]);
				
				if($post[$key_form]=='' && $form->required==1)
				{
					
					if($form->type->std_error!='')
					{

						$form->std_error=$form->type->std_error;

					}
					else
					{

						$form->std_error=$form->txt_error;

					}
					
					$form->error_flag=1;

					if($form->required==1)
					{

						$error++;

					}
		
				}
				
			}
			
			$num_form++;

		}

		if($error==0 && $num_form>0)
		{

			return $post;

		}
		
		return 0;

	}
	
	static public function set_values_form($post, $arr_form, $show_error=1)
	{
		
		set_values_form($post, $arr_form, $show_error);

	}
		
}

/**
*
* A New class for use methods and not switchs for complex controllers. 
*
* 
*
*/

class ControllerSwitchClass {

	public $op_var='action';
	public $controller;
	public $model, $ip, $lang, $base_path, $base_url, $cookie_path, $arr_block, $prefix_key, $block_title, $block_content, $block_urls, $block_type, $block_id, $text_url, $key_csrf;
	
	public function __construct()
	{
	
	
		//$this->user_data=&PhangoVar::$user_data;
		$this->model=&PhangoVar::$model;
		$this->ip=&PhangoVar::$ip;
		$this->lang=&PhangoVar::$lang;
		$this->base_path=&PhangoVar::$base_path;
		$this->base_url=&PhangoVar::$base_url;
		$this->cookie_path=&PhangoVar::$cookie_path;
		$this->prefix_key=&PhangoVar::$prefix_key;
		$this->key_csrf=&PhangoVar::$key_csrf;
		$this->controller=&PhangoVar::$script_controller;
	
	}
	
	/*public function get_method_url($method_controller, $text, $arr_parameters)
	{
		
		$my_controller=strtolower(str_replace('SwitchClass', '', get_class($this)));
		
		$arr_parameters[$this->op_var]=$method_controller;
		
		return make_fancy_url($this->base_url, $this->controller, $my_controller, $text, $arr_parameters);
	
	}*/
	
	public function redirect($direction,$l_text,$text,$ifno)
	{
		
		load_libraries(array('redirect'));
		die( redirect_webtsys( $direction, $l_text, $text, $ifno ) );
	
	}
	
	public function load_theme($title, $cont_index)
	{
		
		echo load_view(array($title, $cont_index),'home');
	
	}
	
	public function simple_redirect($url)
	{
	
		header('Location: '.$url);
	
		die;
	
	}

}

/*****************************************

Now, we define components for use in models. Components are fields on a table.

******************************************/

/**
* PhangoField class is the base for make class used on Webmodel::components property.
*
*/

class PhangoField {

	/**
	* Property used for set this field how indexed in the database table.
	*/

	public $indexed=0;
	
	/**
	* Property used for set this field how unique value in the database table.
	*/

	public $unique=0;
	
	/**
	* The name of the model where this component or field live
	*/
	
	public $name_model='';
	
	/**
	* Name of the field or component.
	*/
	
	public $name_component='';
	
	/**
	* Method used for internal searchs for format the values.
	*
	* 
	*/
	
	/**
	* Required define if this field is required when insert or update a row of this model...
	*/
	public $required=0;
	
	/** 
	* $quote_open is used if you need a more flexible sql sentence, 
	* @warning USE THIS FUNCTION IF YOU KNOW WHAT YOU ARE DOING
	*/
	public $quot_open='\'';
	
	/** 
	* $quote_close is used if you need a more flexible sql sentence, 
	* @warning USE THIS PROPERTY IF YOU KNOW WHAT YOU ARE DOING
	*/
	
	public $quot_close='\'';
	
	/**
	* $std_error contain error in field if exists...
	*/
	
	public $std_error='';
	
	/**
	* Label is the name of field
	*/
	public $label="";
	
	/**
	* Value of field...
	*/
	public $value="";
	
	/**
	* Form define the function for use in forms...
	*/
	
	public $form="";
	
	/**
	* Array for create initial parameters for form..
	*/
	
	public $parameters=array();
	
	/**
	* Method used for internal tasks related with searchs. You can overwrite this method in your PhangoField object if you need translate the value that the user want search to a real value into the database.
	*/
	
	function search_field($value)
	{
	
		return form_text($value);
	
	}
	
	/**
	* Method used for internal tasks related with foreignkeys. By default make nothing.
	*
	* 
	*/
	
	function set_relationships()
	{
	
		
	
	}

	/** 
	* This method is used for describe the new field in a sql language format.
	*/

	public function get_type_sql()
	{

		return 'VARCHAR('.$this->size.') NOT NULL';

	}
	
	/** 
	* This method is used for return a default value for a form.
	*/

	public function get_parameters_default()
	{

		return array($this->name_component, '', '');

	}
	
	/**
	* This method is used for simple checking, used for WhereSql.
	*/
	
	public function simple_check($value)
	{
	
		return $this->check($value);
	
	}


}

/**
* 
* CharField is a PhangoField that defined a varchar element in the model-table.
* 
*/

class CharField extends PhangoField {

	//Basic variables that define the field

	/**
	* Size of field in database
	*/
	public $size=20;
	
	/**
	* Form define the function for use in forms...
	* @deprecated Used on older versions of generate_admin
	*/
	public $set_form="";
	

	/**
	* Construct field with basic data...
	*
	* @param integer $size The size of the varchar. If you put 250, for example, you will can put strings with 250 characters on this.
	* @param boolean $multilang Don't use, don't need for nothing.
	*
	*/

	function __construct($size=20)
	{

		$this->size=$size;
		$this->form='TextForm';

	}
	
	/**
	* This function is used for show the value on a human format
	*/

	function show_formatted($value)
	{

		return $value;

	}
	
	/**
	* This function is for check if the value for field is valid
	*/

	public function check($value)
	{

		//Delete Javascript tags and simple quotes.
		$this->value=form_text($value);
		return form_text($value);

	}


}
//Selections always integers
//PrimaryField is used for primary keys for models

class PrimaryField extends PhangoField {
	
	/**
	* Initial value for the field.
	*/
	
	public $value=0;
	
	/**
	* Initial label for the field. The label is used for create forms from a PhangoField.
	*/
	
	public $label="";
	
	/**
	* Boolean value that is used for check if the field is required for fill a row in the db model.
	*/
	
	public $required=0;
	
	/**
	* By default, the form used for this field is HiddenForm.
	*/
	
	public $form="HiddenForm";
	
	/**
	* @deprecated Value used on older versions for created admins on phango.
	*
	*/
	
	public $set_form="list_value";

	/**
	* Check function that convert the value on a PrimaryField value.
	*
	* @param string $value The value to convert on a PrimaryField value.
	*/
	
	public function check($value)
	{

		$this->value=form_text($value);
		settype($value, "integer");
		return $value;

	}
	
	/**
	* Method for return the sql type for this PhangoField
	*/
	
	public function get_type_sql()
	{

		return 'INT PRIMARY KEY AUTO_INCREMENT';

	}
	
	/**
	* Method for return a formatted value readable for humans.
	*/

	public function show_formatted($value)
	{

		return $value;

	}

}

///Integerfield is a field for integers values.

class IntegerField extends PhangoField {

	public $size=11;
	public $value=0;
	public $label="";
	public $required=0;
	public $only_positive=false;
	public $min_num=0;
	public $max_num=0;

	function __construct($size=11, $only_positive=false, $min_num=0, $max_num=0)
	{

		$this->size=$size;
		$this->form='TextForm';
		$this->set_form='list_value';
		$this->only_positive=$only_positive;
		$this->min_num=$min_num;
		$this->max_num=$max_num;

	}

	function check($value)
	{

		$this->value=form_text($value);
		
		settype($value, "integer");
		
		if($this->only_positive==true && $value<0)
		{
		
			$value=0;
		
		}
		
		if($this->min_num<>0 && $value<$this->min_num)
		{
		
			$value=$this->min_num;
		
		}
		
		if($this->max_num<>0 && $value>$this->max_num)
		{
		
			$value=$this->max_num;
		
		}
		
		return $value;

	}

	function get_type_sql()
	{

		return 'INT('.$this->size.') NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', 0);

	}

}

///Booleanfield is a field for boolean values.

class BooleanField extends PhangoField {

	public $size=1;
	public $value=0;
	public $label="";
	public $required=0;
	public $form="";
	public $set_form='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $default_value=0;

	function __construct()
	{

		$this->size=1;
		$this->form='SelectForm';
		$this->set_form='list_value';

	}

	function check($value)
	{

		//$this->value=form_text($value);
		settype($value, "integer");

		if($value!=0 && $value!=1)
		{

			$value=0;

		}

		return $value;

	}

	function get_type_sql()
	{

		//Int for simple compatibility with sql dbs.
	
		return 'INT('.$this->size.') NOT NULL';

	}

	function show_formatted($value)
	{

		switch($value)
		{
			default:

				return PhangoVar::$lang['common']['no'];

			break;

			case 1:

				return PhangoVar::$lang['common']['yes'];

			break;

	
		}

	}

	function get_parameters_default()
	{
	
		$arr_values=array($this->default_value, PhangoVar::$lang['common']['no'], 0, PhangoVar::$lang['common']['yes'], 1);;

		return array($this->name_component, '', $arr_values);

	}

}

///Doublefield is a field for doubles values.

class DoubleField extends PhangoField {

	public $size=11;
	public $value=0;
	public $label="";
	public $required=0;
	public $form="";
	public $set_form='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';

	function __construct($size=11)
	{

		$this->size=$size;
		$this->form='TextForm';
		$this->set_form='list_value';

	}

	function check($value)
	{

		$this->value=form_text($value);
		settype($value, "double");
		return $value;

	}

	function get_type_sql()
	{

		return 'DOUBLE NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', 0);

	}


}

class ChoiceField extends PhangoField {

	public $size=11;
	public $value=0;
	public $label="";
	public $required=0;
	public $form="";
	public $set_form='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $type='integer';
	public $arr_values=array();
	public $arr_formatted=array();
	public $default_value='';

	

	function __construct($size=11, $type='integer', $arr_values=array(), $default_value='')
	{

		$this->size=$size;
		$this->form='SelectForm';
		$this->type=$type;
		$this->arr_values=$arr_values;
		$this->default_value=$default_value;
		$this->arr_formatted['']='';
		
		foreach($arr_values as $value)
		{
			
			$this->arr_formatted[$value]=$value;
		
		}
	
	}
	
	function restart_formatted()
	{
	
		foreach($this->arr_values as $value)
		{
			
			$this->arr_formatted[$value]=$value;
		
		}
	
	}

	function check($value)
	{
		
		switch($this->type)
		{
		
			case 'integer':

				settype($value, "integer");

			break;

			case 'string':

				$value=form_text($value);

			break;

		}
		
		if(in_array($value, $this->arr_values))
		{	
			
			return $value;

		}
		else
		{

			return $this->default_value;

		}

	}

	function get_type_sql()
	{

		switch($this->type)
		{
		
			case 'integer':

			return 'INT('.$this->size.') NOT NULL';
			
			break;

			case 'string':

			return 'VARCHAR('.$this->size.') NOT NULL';

			break;

		 }	

	}

	function show_formatted($value)
	{
		
		return $this->arr_formatted[$value];

	}

	function get_parameters_default()
	{	

		if(count($this->arr_values)>0)
		{
			$arr_return=array($this->default_value);

			foreach($this->arr_values as $value)
			{

				$arr_return[]=$this->arr_formatted[$value];
				$arr_return[]=$value;

			}

			$arr_values=$arr_return;

		}
		else
		{

			$arr_values=array(0, 'Option 1', 0, 'Option 2', 1);

		}
		
		return array($this->name_component, '', $arr_values);

	}

}

//Textfield is a field for long text values.

class TextField extends PhangoField {

	public $value="";
	public $label="";
	public $required=0;
	public $form="TextAreaForm";
	public $set_form='list_value';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $multilang=0;
	public $br=1;

	function __construct($multilang=0)
	{

		$this->form='TextAreaForm';
		$this->multilang=$multilang;

	}

	function check($value)
	{
		
		//Delete Javascript tags and simple quotes.
		$this->value=$value;
		return form_text($value, $this->br);

	}

	//Function check_form

	function get_type_sql()
	{

		return 'TEXT NOT NULL';
		

	}

	function show_formatted($value)
	{

		return $value;

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', '');

	}
	
}

//TextHTMLfield is a field for long text values based in html.

class TextHTMLField extends PhangoField {

	public $value="";
	public $label="";
	public $required=0;
	public $form="TextAreaForm";
	public $set_form='list_value';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $multilang=0;

	//This variable is used for write rules what accept html tags

	public $allowedtags=array();

	function __construct($multilang=0)
	{

		$this->form='TextAreaForm';
		$this->multilang=$multilang;

	}

	function check($value)
	{
		
		//Delete Javascript tags and simple quotes.
		
		$txt_without_tags=str_replace('&nbsp;', '', strip_tags($value, '<img>') );
		
		$txt_without_tags=trim(str_replace(' ', '', $txt_without_tags));
		
		if($txt_without_tags=='')
		{
		
			return '';
		
		}

		if(PhangoVar::$textbb_type=='')
		{
			
			$this->value=unform_text($value);

		}
		else
		{
			
			$this->value=$value;

		}
		
		return form_text_html($value, $this->allowedtags);

	}

	//Methot for show the allowed html tags to the user

	function show_allowedtags()
	{

		$arr_example_tags=array();

		foreach($this->allowedtags as $tag => $arr_tag)
		{

			$arr_example_tags[]=htmlentities($arr_tag['example']);

		}
		
		return implode(', ', $arr_example_tags);

	}

	function get_type_sql()
	{

		return 'TEXT NOT NULL';
		

	}

	function show_formatted($value)
	{

		return $value;

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', '');

	}

	function set_safe_html_tags()
	{

		$this->allowedtags['a']=array('pattern' => '/&lt;a.*?href=&quot;(http:\/\/.*?)&quot;.*?&gt;(.*?)&lt;\/a&gt;/', 'replace' => '<a_tmp href="$1">$2</a_tmp>', 'example' => '<a href=""></a>');
		$this->allowedtags['p']=array('pattern' => '/&lt;p.*?&gt;(.*?)&lt;\/p&gt;/s', 'replace' => '<p_tmp>$1</p_tmp>','example' => '<p></p>');
		$this->allowedtags['br']=array('pattern' => '/&lt;br.*?\/&gt;/', 'replace' => '<br_tmp />', 'example' => '<br />');
		$this->allowedtags['strong']=array('pattern' => '/&lt;strong.*?&gt;(.*?)&lt;\/strong&gt;/s', 'replace' => '<strong_tmp>$1</strong_tmp>', 'example' => '<strong></strong>');
		$this->allowedtags['em']=array('pattern' => '/&lt;em.*?&gt;(.*?)&lt;\/em&gt;/s', 'replace' => '<em_tmp>$1</em_tmp>', 'example' => '<em></em>');
		$this->allowedtags['i']=array('pattern' => '/&lt;i.*?&gt;(.*?)&lt;\/i&gt;/s', 'replace' => '<i_tmp>$1</i_tmp>', 'example' => '<i></i>');
		$this->allowedtags['u']=array('pattern' => '/&lt;u.*?&gt;(.*?)&lt;\/u&gt;/s', 'replace' => '<u_tmp>$1</u_tmp>', 'example' => '<u></u>');
		$this->allowedtags['blockquote']=array('pattern' => '/&lt;blockquote.*?&gt;(.*?)&lt;\/blockquote&gt;/s', 'replace' => '<blockquote_tmp>$1</blockquote_tmp>', 'example' => '<blockquote></blockquote>', 'recursive' => 1);
		$this->allowedtags['img']=array('pattern' => '/&lt;img.*?alt=&quot;([aA-zZ]+)&quot;.*?src=&quot;('.str_replace('/', '\/', PhangoVar::$base_url).'\/media\/smileys\/[^\r\n\t<"].*?)&quot;.*?\/&gt;/', 'replace' => '<img_tmp alt="$1" src="$2"/>', 'example' => '<img alt="emoticon" src="" />');	

	}
	
}

//Serializefield is a field if you need save serialize values

class SerializeField extends PhangoField {

	public $value="";
	public $label="";
	public $required=0;
	public $form="TextForm";
	public $set_form='list_serialize';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $related_type='';
	
	//type_data can be any field type that is loaded IntegerField, etc..
	
	function __construct($related_type='TextField')
	{
	
		$this->related_type=$related_type;
		
	}
	
	public $type_data='';

	//This method is used for check all members from serialize

	function recursive_form($value)
	{

		if(gettype($value)=="array")
		{

			foreach($value as $key => $value_key)
			{

				if(gettype($value_key)=="array")
				{

					$value[$key]=$this->recursive_form($value_key);

				}
				else
				{

					//Create new type.
					$type_field=new $this->related_type();
				
					$value[$key]=$type_field->check($value_key);

				}

			}

		}

		return $value;

	}

	function check($value)
	{
		
		$value=$this->recursive_form($value);

		$this->value=$value;
		
		return webtsys_escape_string(serialize($value));

	}

	function get_type_sql()
	{

		return 'TEXT NOT NULL';
		

	}

	function show_formatted($value)
	{

		$real_value=unserialize($value);
		
		return implode(', ', $return_value);

	}
	
	static function unserialize($value)
	{

		$real_value=@unserialize($value);
		
		if($real_value!==false)
		{
			return $real_value;
		}
		else
		{
		
			//$this->std_error='';
			return false;
		
		}

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', '');

	}
	
}

//Datefield is a field for save dates in timestamp, this value is a timestamp and you need use form_date or form_time for format DateField

class DateField extends PhangoField {

	public $size=11;	
	public $value="";	
	public $required=0;
	public $form="";
	public $label="";
	public $set_form='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $set_default_time=0;
	public $std_error='';

	function __construct($size=11)
	{

		$this->size=$size;
		$this->form='DateForm';
		$this->set_form='list_date';

	}

	//The check have 3 parts, in a part you have a default time, other part if you have an array from a form, last part if you send a timestamp directly.
	
	function check($value)
	{

		$final_value=0;

		if($this->set_default_time==0)
		{

			$final_value=mktime(date('H'), date('i'), date('s'));
		
		}
		
		if(gettype($value)=='array')
		{
			
			settype($value[0], 'integer');
			settype($value[1], 'integer');
			settype($value[2], 'integer');
			settype($value[3], 'integer');
			settype($value[4], 'integer');
			settype($value[5], 'integer');
			
			if($value[0]>0 && $value[1]>0 && $value[2]>0)	
			{

				/*$substr_time=$user_data['format_time']/3600;
	
				$value[3]-=$substr_time;*/

				$final_value=mktime ($value[3], $value[4], $value[5], $value[1], $value[0], $value[2] );
	
			}
			
			/*echo date('H-i-s', $final_value);
			
			//echo $final_value;
			
			die;*/

		}
		else if(strpos($value, '-')!==false)
		{
		
			$arr_time=explode('-',trim($value));
			
			settype($arr_time[0], 'integer');
			settype($arr_time[1], 'integer');
			settype($arr_time[2], 'integer');
			
			$final_value=mktime (0, 0, 0, $arr_time[1], $arr_time[0], $arr_time[2] );
			
			if($final_value===false)
			{
			
				$final_value=mktime (0, 0, 0, $arr_time[1], $arr_time[2], $arr_time[0] );
			
			}
		
		}
		else
		if(gettype($value)=='string' || gettype($value)=='integer')
		{
			
			settype($value, 'integer');
			$final_value=$value;

		}
		
		$this->value=form_text($final_value);

		return $final_value;

	}

	function get_type_sql()
	{

		return 'INT('.$this->size.') NOT NULL';
		

	}

	function show_formatted($value)
	{

		return $this->format_date($value);

	}
	
	static public function format_date($value)
	{

		load_libraries(array('form_date'));
		
		return form_date( $value, PhangoVar::$format_date , PhangoVar::$format_time);
	
	}

	function get_parameters_default()
	{

		return array($this->name_component, '', time());

	}
	
}

class FileField extends PhangoField {

	public $value="";
	public $label="";
	public $required=0;
	public $form="FileForm";
	public $name_file="";
	public $path="";
	public $url_path="";
	//public $type='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';

	function __construct($name_file, $path, $url_path)
	{

		$this->name_file=$name_file;
		$this->path=$path;
		$this->url_path=$url_path;
		//$this->type=$type;

	}

	//Check if the file is correct..
	
	function check($file)
	{	
		
		$file_field=$this->name_file;

		settype($_POST['delete_'.$file_field], 'integer');
		
		if($_POST['delete_'.$file_field]==1)
		{

			$file_delete=form_text($_POST[$file_field]);

			if($file_delete!='')
			{

				@unlink($this->path.'/'.$file_delete);

				$file='';

			}

		}
		
		if(isset($_FILES[$file_field]['tmp_name']))
		{
				
			if($_FILES[$file_field]['tmp_name']!='')
			{
	
				if( move_uploaded_file ( $_FILES[$file_field]['tmp_name'] , $this->path.'/'.$_FILES[$file_field]['name'] ) )
				{

					return $_FILES[$file_field]['name'];

					//return $this->path.'/'.$_FILES[$file]['name'];
					
				}
				else
				{

					$this->std_error=PhangoVar::$lang['common']['error_cannot_upload_this_file_to_the_server'];

					return '';

				}
					

			}
			else if($file!='')
			{

				return $file;

			}

		}
		else
		{
		
			$this->std_error=PhangoVar::$lang['error_model']['check_error_enctype_for_upload_file'];
		
			return '';
		
		}

		$this->value='';
		
		return '';


	}


	function get_type_sql()
	{

		return 'VARCHAR(255) NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}
	
	function show_file_url($value)
	{

		return $this->url_path.'/'.$value;

	}

	function get_parameters_default()
	{

		return array($this->name_component, '', '');

	}
	
	function process_delete_field($model, $name_field, $conditions)
	{
	
		$query=$model->select($conditions, array($name_field));
		
		while(list($file_name)=webtsys_fetch_row($query))
		{
		
			if(!unlink($this->path.'/'.$file_name))
			{
			
				$this->std_error=PhangoVar::$lang['common']['cannot_delete_file'];
			
			}
		
		}
	
	}

}

//Imagefield is a field for upload images
//This field don't have for now a maximum width and height. To fix in next releases.

class ImageField extends PhangoField {

	public $value="";
	public $label="";
	public $required=0;
	public $form="ImageForm";
	public $name_file="";
	public $path="";
	public $url_path="";
	public $type='';
	public $thumb=0;
	public $img_width=100;
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';
	public $quality_jpeg=75;
	public $min_size=array(0, 0);
	public $prefix_id=1;
	public $img_minimal_height=array();
	public $func_token='get_token';

	function __construct($name_file, $path, $url_path, $type, $thumb=0, $img_width=array('mini' => 150), $quality_jpeg=85)
	{

		$this->name_file=$name_file;
		$this->path=$path;
		$this->url_path=$url_path;
		$this->type=$type;
		$this->thumb=$thumb;
		$this->img_width=$img_width;
		$this->quality_jpeg=$quality_jpeg;

	}

	//Check if the image is correct..
	
	function check($image)
	{	
		//Only accept jpeg, gif y png
		
		
		
		$file=$this->name_file;
		$image=basename($image);

		settype($_POST['delete_'.$file], 'integer');
		
		if($_POST['delete_'.$file]==1)
		{

			//Delete old_image

			$image_file=form_text($_POST[$file]);

			if($image_file!='')
			{

				@unlink($this->path.'/'.$image_file);
				
				foreach($this->img_width as $key => $value)
				{

					@unlink($this->path.'/'.$key.'_'.$image_file);
				
				}

				$image='';

			}

		}
		
		if(isset($_FILES[$file]['tmp_name']))
		{
				
			if($_FILES[$file]['tmp_name']!='')
			{	
			
			
				$arr_image=getimagesize($_FILES[$file]['tmp_name']);
				
				$_FILES[$file]['name']=form_text($_FILES[$file]['name']);
				
				if($this->prefix_id==1)
				{
				
					$func_token=$this->func_token;
				
					$_FILES[$file]['name']=$func_token().'_'.$_FILES[$file]['name'];
				
				}
				
				$this->value=$_FILES[$file]['name'];
				
				//Check size
				
				if($this->min_size[0]>0 && $this->min_size[1]>0)
				{
				
					if($arr_image[0]<$this->min_size[0] || $arr_image[1]<$this->min_size[1])
					{
					
						$this->std_error=PhangoVar::$lang['common']['image_size_is_not_correct'].'<br />'.PhangoVar::$lang['common']['min_size'].': '.$this->min_size[0].'x'.$this->min_size[1];
						
						$this->value='';
						return '';
						
					
					}
				
				}
				
				/*//Check if exists a image with same name.
				
				if(file_exists($this->path.'/'.$_FILES[$file]['name']))
				{
				
					$this->std_error=PhangoVar::$lang['common']['a_image_with_same_name_exists'];
					
					return $image;
				
				}*/
				
				//Delete other image if exists..
				
				if($image!='')
				{
				
					unlink($this->path.'/'.$image);
				
				}
				
				//gif 1
				//jpg 2
				//png 3
				//Only gifs y pngs...
				
				//Need checking gd support...
				
				$func_image[1]='imagecreatefromgif';
				$func_image[2]='imagecreatefromjpeg';
				$func_image[3]='imagecreatefrompng';
				
				if($arr_image[2]==1 || $arr_image[2]==2 || $arr_image[2]==3)
				{
				
					$image_func_create='imagejpeg';

					switch($arr_image[2])
					{

						case 1:

							//$_FILES[$file]['name']=str_replace('.gif', '.jpg', $_FILES[$file]['name']);
							$image_func_create='imagegif';

						break;

						case 3:

							//$_FILES[$file]['name']=str_replace('.png', '.jpg', $_FILES[$file]['name']);
							$image_func_create='imagepng';
							//Make conversion to png scale
							$this->quality_jpeg=floor($this->quality_jpeg/10);
							
							if($this->quality_jpeg>9)
							{
							
								$this->quality_jpeg=9;
							
							}

						break;

					}

					
					if( move_uploaded_file ( $_FILES[$file]['tmp_name'] , $this->path.'/'.$_FILES[$file]['name'] ))
					{
						
						//Make jpeg.

						$func_final=$func_image[$arr_image[2]];

						$img = $func_final($this->path.'/'.$_FILES[$file]['name']);
						
						//imagejpeg ( $img, $this->path.'/'.$_FILES[$file]['name'], $this->quality_jpeg );
						
						/*$mini_photo=$_FILES[$file]['name'];
				
						$mini_photo=str_replace('.gif', '.jpg', $mini_photo);
						$mini_photo=str_replace('.png', '.jpg', $mini_photo);*/
						
						//Reduce size for default if $this->img_width['']
						
						if(isset($this->img_width['']))
						{
							if($arr_image[0]>$this->img_width[''])
							{
								$width=$this->img_width[''];
							
								$ratio = ($arr_image[0] / $width);
								$height = round($arr_image[1] / $ratio);
							
								$thumb = imagecreatetruecolor($width, $height);
								
								imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $width, $height, $arr_image[0], $arr_image[1]);
								
								$image_func_create ( $thumb, $this->path.'/'.$_FILES[$file]['name'], $this->quality_jpeg );
								
							}
							
							unset($this->img_width['']);
						}

						//Make thumb if specific...
						if($this->thumb==1)
						{
							
							//Convert to jpeg.
							
							foreach($this->img_width as $name_width => $width)
							{
							
								$ratio = ($arr_image[0] / $width);
								$height = round($arr_image[1] / $ratio);
								
								if(isset($this->img_minimal_height[$name_width]))
								{
									
									if($height<$this->img_minimal_height[$name_width])
									{
											
										//Need recalculate the adecuate width and height.
										
										$height=$this->img_minimal_height[$name_width];
										
										$ratio=($arr_image[1] / $height);
										
										$width=round($arr_image[0]/$ratio);
										
										//$width=
									
									}
								
								}
							
								$thumb = imagecreatetruecolor($width, $height);
								
								imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $width, $height, $arr_image[0], $arr_image[1]);
								
								$image_func_create ( $thumb, $this->path.'/'.$name_width.'_'.$_FILES[$file]['name'], $this->quality_jpeg );
								;
								//imagepng ( resource $image [, string $filename [, int $quality [, int $filters ]]] )

							}

						}
						
						//unlink($_FILES[$file]['tmp_name']);
						
						//Unlink if exists image
						
						if(isset($_POST[$file]))
						{
						
							if($_POST[$file]!='')
							{
								$image_file=form_text($_POST[$file]);

								if($image_file!='')
								{

									@unlink($this->path.'/'.$image_file);
									
									foreach($this->img_width as $key => $value)
									{

										@unlink($this->path.'/'.$key.'_'.$image_file);
									
									}

									$image='';

								}
						
							}
						
						}
						
						return $_FILES[$file]['name'];

						//return $this->path.'/'.$_FILES[$file]['name'];
						
					}
					else
					{

						$this->std_error=PhangoVar::$lang['common']['error_cannot_upload_this_image_to_the_server'];

						return '';

					}
					

				}
				else
				{

					$this->std_error.=PhangoVar::$lang['error_model']['img_format_error'];

				}

			}
			else if($image!='')
			{

				return $image;

			}


		}
		else if($image!=='')
		{
			
			
			if(file_exists($this->path.'/'.$image))
			{

				$this->value=$this->path.'/'.$image;
				return $image;

			}
			else
			{
			
				$this->std_error=PhangoVar::$lang['error_model']['check_error_enctype_for_upload_file'];
				return '';
			
			}
			
			

		}
		else
		{
		
			$this->std_error=PhangoVar::$lang['error_model']['check_error_enctype_for_upload_file'];
		
		}

		$this->value='';
		return '';


	}


	function get_type_sql()
	{

		return 'VARCHAR(255) NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}
	
	function show_image_url($value)
	{

		return $this->url_path.'/'.$value;

	}
	
	function process_delete_field($model, $name_field, $conditions)
	{
	
		
		
		//die;
		$query=$model->select($conditions, array($name_field));
		
		while(list($image_name)=webtsys_fetch_row($query))
		{
		
			if( file_exists($this->path.'/'.$image_name) && !is_dir($this->path.'/'.$image_name) )
			{
				if(unlink($this->path.'/'.$image_name))
				{
				
					//Unlink mini_images
					
					unset($this->img_width['']);
					
					foreach($this->img_width as $key => $value)
					{
					
						if(!unlink($this->path.'/'.$key.'_'.$image_name))
						{
							
							$this->std_error.=PhangoVar::$lang['common']['cannot_delete_image'].': '.$key.'_'.$image_name;
						
						}
					
					}
				
					$this->std_error.=PhangoVar::$lang['common']['cannot_delete_image'].': '.$image_name;
				
				}
				else
				{
				
					$this->std_error.=PhangoVar::$lang['common']['cannot_delete_image'].': '.$image_name;
				
				}
				
			}
			else
			{
			
				$this->std_error.=PhangoVar::$lang['common']['cannot_delete_image'].': '.$image_name;
			
			}
		
		}
	
	}

}

//Keyfield is a indexed field in a sql statement...

class KeyField extends PhangoField {

	public $size=11;
	public $value=0;
	public $label="";
	public $required=0;
	public $form="";
	public $set_form='';
	public $quot_open='\'';
	public $quot_close='\'';
	public $fields=array();
	public $table='';
	public $model='';
	public $ident='';
	public $std_error='';

	function __construct($size=11)
	{

		$this->size=$size;
		$this->form='TextForm';
		$this->set_form='list_value';

	}

	function check($value)
	{

		$this->value=form_text($value);

		settype($value, "integer");
		return $value;

	}

	function get_type_sql()
	{

		return 'INT('.$this->size.') NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}

}

//ForeignKeyfield is a relantioship between two models...

class ForeignKeyField extends IntegerField{

	//field related in the model...
	public $related_model='';
	public $container_model='';
	public $null_relation=1;
	public $params_loading_mod=array();
	public $default_id=0;
	public $yes_zero=0;
	
	function __construct($related_model, $size=11, $null_relation=1, $default=0)
	{

		$this->size=$size;
		$this->form='SelectForm';
		$this->related_model=$related_model;
		$this->container_model=$this->related_model;
		//Fields obtained from related_model if you make a query...
		$this->fields_related_model=array();
		//Representative field for related model...
		$this->name_field_to_field='';
		$this->null_relation=$null_relation;
		$this->default_id=$default;
		
		//PhangoVar::$model[$related_model]->related_models_delete[]=array('model' => $this->name_model, 'related_field' => $this->name_component);
		
		//echo get_parent_class();

	}
	
	function set_relationships()
	{
		
		//We need the model loaded...
		
		if(isset(PhangoVar::$model[$this->related_model]))
		{
			PhangoVar::$model[$this->related_model]->related_models_delete[]=array('model' => $this->name_model, 'related_field' => $this->name_component);
		}
		else
		{
		
			show_error('You need load class before set relantionship', 'You need load class '.$this->related_model.' before set relantionship with ForeignKeyField on model '.$this->name_model, $output_external='');
			
			die;
		
		}
	}

	function check($value)
	{
		
		settype($value, "integer");

		//Reload related model if not exists, if exists, only check cache models...

		if(!isset(PhangoVar::$model[$this->related_model]))
		{

			load_model($this->container_model);

		}

		//Need checking if the value exists with a select_count
		
		$num_rows=PhangoVar::$model[$this->related_model]->select_count('where '.$this->related_model.'.'.PhangoVar::$model[$this->related_model]->idmodel.'='.$value, PhangoVar::$model[$this->related_model]->idmodel);
		
		if($num_rows>0)
		{
		
			if($value==0 && $this->yes_zero==0)
			{
				
				return NULL;
			
			}
			
			return $value;

		}
		else
		{
		
			if($this->default_id<=0 && $this->yes_zero==0)
			{
			
				return NULL;
				
			}
			else
			{
			
				return $this->default_id;
			
			}

		}
		

	}
	
	function simple_check($value)
	{
	
		settype($value, 'integer');
		
		return $value;
	
	}
	
	
	function get_type_sql()
	{
	
		$arr_null[0]='NOT NULL';
		$arr_null[1]='NULL';

		return 'INT('.$this->size.') '.$arr_null[$this->null_relation];

	}

	function show_formatted($value)
	{
		
		return PhangoVar::$model[$this->related_model]->components[$this->name_field_to_field]->show_formatted($value);

		//return $value;

	}

	function get_parameters_default()
	{
		
		
		load_libraries(array('forms/selectmodelform'));
		
		//SelectModelForm($name, $class, $value, $model_name, $identifier_field, $where='')
		
		//Prepare parameters for selectmodelform
		
		if(isset($this->name_component) && $this->name_field_to_field!='' && $this->name_model!='' && count(PhangoVar::$model[$this->name_model]->forms)>0)
		{
			PhangoVar::$model[$this->name_model]->forms[$this->name_component]->form='SelectModelForm';
			
			return array($this->name_component, '', '', $this->related_model, $this->name_field_to_field, '');
			
		}
		else
		{
		
			$arr_values=array('', PhangoVar::$lang['common']['any_option_chosen'], '');
			
			return array($this->name_component, '', $arr_values);
			
		}

	}
	
	function get_all_fields()
	{
		
		return array_keys(PhangoVar::$model[$this->related_model]->components);
	
	}

}

class ParentField extends IntegerField{

	//field related in the model...
	public $parent_model='';

	function __construct($parent_model, $size=11)
	{

		$this->parent_model=$parent_model;
		$this->size=$size;
		$this->form='SelectForm';

	}

	function check($value)
	{
		
		settype($value, "integer");

		//Check model
		
		$num_rows=PhangoVar::$model[$this->parent_model]->select_count('where '.PhangoVar::$model[$this->parent_model]->idmodel.'='.$value, PhangoVar::$model[$this->parent_model]->idmodel);
		
		if($num_rows>0)
		{

			return $value;

		}
		else
		{
			
			return 0;

		}
		

	}

	function show_formatted($value)
	{

		return $value;

	}

	function get_parameters_default()
	{
		

		$arr_values=array('', PhangoVar::$lang['common']['any_option_chosen'], '');
		
		return array($this->name_component, '', $arr_values);

	}
	
	function process_update_field($class, $name_field, $conditions, $value)
	{
	
		$num_rows=$class->select_count($conditions.' and '.$class->idmodel.'='.$value);
		
		if($num_rows==0)
		{
		
			return true;
		
		}
		else
		{
		
			return false;
		
		}
	
	}
	
	public function obtain_parent_tree($id, $field_ident, $url_op)
	{
		
		$arr_parent=array();
		$arr_link_parent=array();
		
		$query=PhangoVar::$model[$this->parent_model]->select('', array( PhangoVar::$model[$this->parent_model]->idmodel, $this->name_component, $field_ident) );
		
		while(list($id_block, $parent, $name)=webtsys_fetch_row($query))
		{
		
			$arr_parent[$id_block]=array($parent, $name);
		
		}
		
		$arr_link_parent=$this->obtain_recursive_parent($id, $arr_parent, $arr_link_parent, $field_ident, $url_op);
		
		$arr_link_parent=array_reverse($arr_link_parent, true);
		
		return $arr_link_parent;
	
	}
	
	private function obtain_recursive_parent($id, $arr_parent, $arr_link_parent, $field_ident, $url_op)
	{
	
		//$arr_link_parent[]=array('nombre', 'enlace');
		
		//$arr_link_parent=array();
		
		if($id>0)
		{
			
			$arr_link_parent[$id]=array(PhangoVar::$model[$this->parent_model]->components[$field_ident]->show_formatted($arr_parent[$id][1]), add_extra_fancy_url($url_op, array($this->name_component => $id) ) );
			
			if($arr_parent[$id][0]>0)
			{
			
				$arr_link_parent=$this->obtain_recursive_parent($arr_parent[$id][0], $arr_parent, $arr_link_parent, $field_ident, $url_op);
		
			}
		
		}
	
		return $arr_link_parent;
	}

}

//Emailfield is a field that only accepts emails

class EmailField extends PhangoField {

	public $size=200;
	public $value="";
	public $label="";
	public $form="TextForm";
	public $set_form="";
	public $class="";
	public $required=0;
	public $quot_open='\'';
	public $quot_close='\'';
	public $std_error='';

	function __construct($size=200)
	{

		$this->size=$size;
 		$this->set_form='list_value';

	}

	//Method for accept valid emails only
	
	function check($value)
	{
		
		//Delete Javascript tags and simple quotes.

		

		$value=form_text($value);

		$this->value=$value;

		$email_expression='([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*(?:[\w\!\#$\%\'\*\+\-\/\=\?\^\`{\|\}\~]|&amp;)+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)';
		
		if(preg_match('/^'.$email_expression.'$/i', $value))
		{
			
			return $value;

		}
		else
		{
			
			$this->std_error.=PhangoVar::$lang['error_model']['email_format_error'].' ';
			
			return '';

		}
		

	}

	function get_type_sql()
	{

		return 'VARCHAR('.$this->size.') NOT NULL';

	}

	function show_formatted($value)
	{

		return $value;

	}


}

//in older versions of php, get_magic_quotes_gpc function was to add quotes automatically for certain operations, make_slashes is used to prevent this.

if(function_exists('get_magic_quotes_gpc')) {

	if ( !get_magic_quotes_gpc() )
	{
	
		function make_slashes( $string )
		{
			return addslashes( $string );
		} 

		function unmake_slashes( $string )
		{
			return stripslashes( $string );
		}

	} 
	else
	{
		function make_slashes( $string )
		{
			return $string;
		}

		function make_slashes( $string )
		{
			return $string;
		} 
	
	}

} 
else
{

	/**
	* Function used for add slashes from _POST and _GET variables.
	*
	*
	* @param string $string String for add slashes
	*/

	function make_slashes( $string )
	{
		return addslashes( $string );
	} 
	
	/**
	* Function used for strip slashes from _POST and _GET variables.
	*
	*
	* @param string $string String for strip slashes
	*/

	function unmake_slashes( $string )
	{
		return stripslashes( $string );
	}

}

/**
* This function is used to clean up the text of undesirable elements
* @param string $text Text to clean
* @param string $br Boolean variable used for control if you want br tags or \n symbon on input text
*/

function form_text( $text ,$br=1)
{

    settype( $text, "string" );

    $text = trim( $text );

    $arr_tags=array('/</', '/>/', '/"/', '/\'/', "/  /");
    $arr_entities=array('&lt;', '&gt;', '&quot;', '&#39;', '&nbsp;');
	
    if($br==1)
    {

	$text = preg_replace($arr_tags, $arr_entities, $text);
	
	$arr_text = explode("\n\r\n", $text);

	$c=count($arr_text);

	if($c>1)
	{
		for($x=0;$x<$c;$x++)
		{

			$arr_text[$x]='<p>'.trim($arr_text[$x]).'&nbsp;</p>';

		}
	}


	$text=implode('', $arr_text);

	$arr_text = explode("\n", $text);

	$c=count($arr_text);

	if($c>1)
	{
		for($x=0;$x<$c;$x++)
		{

			$arr_text[$x]=trim($arr_text[$x]).'<br />';

		}
	}

	$text=implode('', $arr_text);
	
    }
    
	
    $text = make_slashes( $text );
    
    return $text;
}

/**
* This function is used to clean up the text of undesirable html tags
*
* @param string $text Input text for clean undesirable html tags
* @param array $allowedtags An array with allow tags on the text.
*/

function form_text_html( $text , $allowedtags=array())
{

	settype( $text, "string" );
	
	//If no html editor \r\n=<p>

	/*$text=preg_replace("/<br.*?>/", "\n", $text);*/
	
	if(PhangoVar::$textbb_type!='')
	{
		
		$text=str_replace("\r", '', $text);
		$text=str_replace("\n", '', $text);

	}
	else
	{

		//Make <p>

		$arr_text = explode("\n\r\n", $text);

		$c=count($arr_text);

		if($c>1)
		{
			for($x=0;$x<$c;$x++)
			{

				$arr_text[$x]='<p>'.trim($arr_text[$x]).'&nbsp;</p>';

			}
		}


		$text=implode('', $arr_text);

		$arr_text = explode("\n", $text);

		$c=count($arr_text);

		if($c>1)
		{
			for($x=0;$x<$c;$x++)
			{

				$arr_text[$x]=trim($arr_text[$x]).'<br />';

			}
		}

		$text=implode('', $arr_text);

	}
	/*echo htmlentities($text);
	die;*/
		
	//Check tags

	//Bug : tags deleted ocuppied space.

	//First strip_tags

	$text = trim( $text );

	//Trim html

	$text=str_replace('&nbsp;', ' ', $text);

	while(preg_match('/<p>\s+<\/p>$/s', $text))
	{

		$text=preg_replace('/<p>\s+<\/p>$/s', '', $text);
	
	}

	//Now clean undesirable html tags
	
	if(count($allowedtags)>0)
	{

		$text=strip_tags($text, '<'.implode('><', array_keys($allowedtags)).'>' );
		
		$arr_tags=array('/</', '/>/', '/"/', '/\'/', "/  /");
		$arr_entities=array('&lt;', '&gt;', '&quot;', '&#39;', '&nbsp;');
		
		$text=preg_replace($arr_tags, $arr_entities, $text);
		
		$text=str_replace('  ', '&nbsp;&nbsp;', $text);
		
		$arr_tags_clean=array();
		$arr_tags_empty_clean=array();

		//Close tags. 

		//Filter tags

		$final_allowedtags=array();
		
		foreach($allowedtags as $tag => $parameters)
		{
			//If mark how recursive, make a loop

			settype($parameters['recursive'], 'integer');

			$c_count=0;
			$x=0;

			if($parameters['recursive']==1)
			{

				$c_count = substr_count( $text, '&lt;'.$tag.'&gt;');

			}
			
			for($x=0;$x<=$c_count;$x++)
			{

				$text=preg_replace($parameters['pattern'], $parameters['replace'], $text);
				
			}
			
			$pos_=strpos($tag, '_');
			
			if($pos_!==false)
			{

				$tag=substr($tag, 0, $pos_);

			}
			
			$final_allowedtags[]=$tag.'_tmp';

			//Destroy open tags.
			
			$arr_tags_clean[]='/&lt;(.*?)'.$tag.'(.*?)&gt;/';
			
			$arr_tags_empty_clean[]='';
			$arr_tags_empty_clean[]='';

		}
		
		$text=preg_replace($arr_tags_clean, $arr_tags_empty_clean, $text);
	}

	//With clean code, modify <tag_tmp
	
	$text=str_replace('_tmp', '', $text);
	
	//Close tags
	
	$text = unmake_slashes( $text );
	
	return $text;

}

/**
* function for clean newlines
* 
* @param string $text Text to clean.
*/

function unform_text( $text )
{

	$text = preg_replace( "/<p>(.*?)<\/p>/s", "$1\n\r\n", $text );
	$text = str_replace( "<br />", "", $text );

	return $text;

}

/**
*  Simple function for replate real quotes for quote html entities.
* 
* @param string $text Text to clean.
*/

function replace_quote_text( $text )
{

	$text = str_replace( "\"", "&quot;", $text );

	return $text;

}


/***********************************************************

Functions used for generate forms from models 
This functions are called via $model->form

************************************************************/

/** 
* Function form used for text fields on a form. Show a text html input.
* 
*
* @param string $name Name of this text field for use in forms
* @param string $class Css class used in the text field
* @param string $value Initial value for the form
*/

function TextForm($name="", $class='', $value='')
{

	return '<input type="text" name="'.$name.'" id="'.$name.'_field_form" class="'.$class.'" value="'.$value.'" />';

}

//Prepare a value for input text

function TextFormSet($post, $value)
{

	$value = replace_quote_text( $value );
	return $value;

}

//Create a input password

function PasswordForm($name="", $class='', $value='')
{

	$value = replace_quote_text( $value );

	return '<input type="password" name="'.$name.'" class="'.$class.'" id="'.$name.'_field_form" value="'.$value.'" />';

}

//Prepare a value for input password

function PasswordFormSet($post, $value)
{

	$value = ''; //replace_quote_text( $value );

	return $value;

}

//Create a input file

function FileForm($name="", $class='', $value='', $delete_inline=0, $path_file='')
{
	
	

	$file_url=$path_file.'/'.$value;
	
	$file_exist='';

	if($value!='')
	{

		$file_exist='<a href="'.$file_url.'">'.basename($value).'</a> ';
		
		if($delete_inline==1)
		{

			$file_exist.=PhangoVar::$lang['common']['delete_file'].' <input type="checkbox" name="delete_'.$name.'" class="'.$class.'" value="1" />';

		}

	}

	return '<input type="hidden" name="'.$name.'" value="'.$value.'"/><input type="file" name="'.$name.'" class="'.$class.'" value="" /> '.$file_exist;

}

//Prepare a value for input password

function FileFormSet($post, $value)
{
	
	$value = replace_quote_text( $value );

	return $value;

}


//Create a special form for a image

function ImageForm($name="", $class='', $value='', $delete_inline=0, $path_image='')
{

	$image_url=$path_image.'/'.$value;
	
	$image_exist='';

	if($value!='')
	{

		$image_exist='<a href="'.$image_url.'">'.basename($value).'</a> ';
		
		if($delete_inline==1)
		{

			$image_exist.=PhangoVar::$lang['common']['delete_image'].' <input type="checkbox" name="delete_'.$name.'" class="'.$class.'" value="1" />';

		}

	}

	return '<input type="hidden" name="'.$name.'" value="'.$value.'"/><input type="file" name="'.$name.'" class="'.$class.'" value="" /> '.$image_exist;

}

//Prepare a value for input password

function ImageFormSet($post, $value)
{
	
	$value = replace_quote_text( $value );

	return $value;

}

//Create a textarea 

function TextAreaForm($name="", $class='', $value='')
{

	return '<textarea name="'.$name.'" class="'.$class.'" id="'.$name.'_field_form">'.$value.'</textarea>';

}

//Prepare the value for the textarea

function TextAreaFormSet($post, $value)
{

	$value = replace_quote_text( $value );

	return $value;

}

//Create a input hidden

function HiddenForm($name="", $class='', $value='')
{

	return '<input type="hidden" name="'.$name.'" value="'.$value.'" id="'.$name.'_field_form"/>';

}

//Prepare the value for a input hidden

function HiddenFormSet($post, $value)
{

	$value = replace_quote_text( $value );

	return $value;

}

//Create a input checkbox

function CheckBoxForm($name="", $class='', $value='')
{
	
	$arr_checked[$value]='';

	$arr_checked[0]='';
	$arr_checked[1]='checked';
	
	return '<input type="checkbox" name="'.$name.'" value="1" id="'.$name.'_field_form" class="'.$class.'" '.$arr_checked[$value].'/>';

}

//Prepare the value for the checkbox

function CheckBoxFormSet($post, $value)
{

	settype($value, 'integer');
	
	return $value;

}

//Create a select

function SelectForm($name="", $class='', $value='', $more_options='')
{
	
	$select='<select name="'.$name.'" id="'.$name.'_field_form" class="'.$class.'" '.$more_options.'>'."\n";

	list($key, $default)= each($value);

	$arr_selected=array();

	$arr_selected[$default]="selected=\"selected\"";

	//Check if array is safe. 
	
	$z=count($value);
	
	for($x=1;$x<$z;$x+=2)
	{
		
		$val=$value[$x+1];
		
		settype($val, "string");
		settype($arr_selected[$val], "string");

		if($val=='optgroup')
		{
    			$select.='<optgroup label="'.$value[$x].'">';
		}
		else 
		if($val=="end_optgroup")
		{

			$select.='</optgroup>';

		}
		else
		{

			$select.= '<option value="'.$val.'" '.$arr_selected[$val].'>'.$value[$x].'</option>'."\n";

		}
	}

	$select.='</select>'."\n";

	return $select;

}

//Prepare the value for the select

function SelectFormSet($post, $value)
{
	
	$value = preg_replace('/<(.*?)\/(.*?)option(.*?)>/', '', $value);
	
	$post[0]=$value;
	
	return $post;

}

//Crate a multiple select

function SelectManyForm($name="", $class='', $value='', $more_options='' )
{
	
	$select='<select name="'.$name.'[]" id="'.$name.'_field_form" class="'.$class.'" '.$more_options.' multiple>'."\n";

	list($key, $arr_values)= each($value);
	
	$arr_selected=array();
	
	foreach($arr_values as $default)
	{

		$arr_selected[$default]="selected";

	}

	//Check if array is safe. 
	
	$z=count($value);
	
	for($x=1;$x<$z;$x+=2)
	{
		
		$val=$value[$x+1];
		
		settype($val, "string");
		settype($arr_selected[$val], "string");

		if($val=='optgroup')
		{
    			$select.='<optgroup label="'.$value[$x].'">';
		}
		else 
		if($val=="end_optgroup")
		{

			$select.='</optgroup>';

		}
		else
		{

			$select.= '<option value="'.$val.'" '.$arr_selected[$val].'>'.$value[$x].'</option>'."\n";

		}
	}

	$select.='</select>'."\n";

	return $select;

}

//Prepare the value for the multiple select

function SelectManyFormSet($post, $value)
{
	
	if(gettype($value)!='array')
	{
	
		$arr_value=unserialize($value);
	}
	else
	{
	
		$arr_value=$value;
	
	}
	//$value = preg_replace('/<(.*?)\/(.*?)option(.*?)>/', '', $value);
	
	$post[0]=$arr_value;
	
	return $post;

}

//A special form for dates in format day/month/year

function DateForm($field, $class='', $value='', $set_time=1, $see_title=1)
{
	
	if($value==0)
	{

		$day='';
		$month='';
		$year='';
		$hour='';
		$minute='';
		$second='';

	}
	else
	{
		
		//$value+=$user_data['format_time'];
		
		$day=date('j', $value);
		$month=date('n', $value);
		$year=date('Y', $value);
		$hour=date('G', $value);
		$minute=date('i', $value);
		$second=date('s', $value);
	}
	
	$date='<span id="'.$field.'_field_form" class="'.$class.'">';
	
	if($set_time<=1)
	{

		$date.='<input type="text" name="'.$field.'[]" value="'.$day.'" size="2" maxlength="2"/>'."\n";
		$date.='<input type="text" name="'.$field.'[]" value="'.$month.'" size="2" maxlength="2"/>'."\n";
		$date.='<input type="text" name="'.$field.'[]" value="'.$year.'" size="4" maxlength="4"/>'."\n&nbsp;&nbsp;&nbsp;";
		
	}
	
	if($set_time>0)
	{
	
		$hour_txt=PhangoVar::$lang['common']['hour'];
		$minute_txt=PhangoVar::$lang['common']['minute'];
		$second_txt=PhangoVar::$lang['common']['second'];
		
		if($see_title==0)
		{
		
			$hour_txt='';
			$minute_txt='';
			$second_txt='';
		
		}

		$date.=$hour_txt.' <input type="text" name="'.$field.'[]" value="'.$hour.'" size="2" maxlength="2" />'."\n";
		$date.=$minute_txt.' <input type="text" name="'.$field.'[]" value="'.$minute.'" size="2" maxlength="2" />'."\n";
		$date.=$second_txt.' <input type="text" name="'.$field.'[]" value="'.$second.'" size="2" maxlength="2" />'."\n";
		
	}

	echo '</span>';
	
	return $date;

}

//Prepare value form dateform

function DateFormSet($post, $value)
{

	if(gettype($value)=='array')
	{
		foreach($value as $key => $val)
		{

			settype($value[$key], 'integer');

		}
		
		settype($value[3], 'integer');
		settype($value[4], 'integer');
		settype($value[5], 'integer');
		
		$final_value=mktime ($value[3], $value[4], $value[5], $value[1], $value[0], $value[2] );

	}
	else
	{

		settype($value, 'integer');

		$final_value=$value;

	}


	return $final_value;

}

function RadioIntForm($name="", $class='', $value=array(), $more_options='')
{
	$select='';

	list($key, $default)= each($value);

	$arr_selected=array();

	$arr_selected[$default]="checked";

	//Check if array is safe. 

	$z=count($value);
	
	for($x=1;$x<$z;$x+=2)
	{
	
		$val=$value[$x+1];
		
		settype($arr_selected[$val], "string");
	
		$select.= $value[$x].' <input type="radio" name="'.$name.'" value="'.$val.'" '.$arr_selected[$val].' />'."\n";
		
	}

	return $select;

}

//Prepare the value for the select

function RadioIntFormSet($post, $value)
{
	
	settype($value, 'integer');

	$post[0]=$value;
	
	return $post;

}
//Function for make pretty urls...

//If active fancy urls...
	
//Url don't have final slash!!

function make_fancy_url($url, $folder_url, $ident_url, $arr_params=array(), $arr_get_params=array())
{

	/*$description_text=slugify($description_text, $respect_upper);

	$arr_get=array();

	foreach($arr_data as $key => $value)
	{

		$arr_get[]=$key.'/'.$value;

	}
	
	$get_final=implode('/', $arr_get);
	
	return $url.$index_php.'/'.$controller.'/show/'.$func_controller.'/'.$description_text.'/'.$get_final;*/
	
	$index_php='/index.php';
	
	if(defined('NO_INDEX_PHP'))
	{
	
		$index_php='';
	
	}
	
	$part_url=PhangoVar::$urls[$folder_url][$ident_url]['url'];
	
	$parameters='';
	
	if(count(PhangoVar::$urls[$folder_url][$ident_url]['parameters'])>0)
	{
	
		$parameters='/'.implode('/', $arr_params);
	
	}
	
	$extra_params='';

	if(count($arr_get_params)>0)
	{
	
		foreach($arr_get_params as $key => $value)
		{

			$arr_get[]=$key.'/'.$value;

		}
	
		$extra_params='/get/'.implode('/', $arr_get);
	
	}
	
	return $url.$index_php.$part_url.$parameters.$extra_params;

}

function add_extra_fancy_url($url_fancy, $arr_data)
{

	$arr_get=array();

	foreach($arr_data as $key => $value)
	{

		$arr_get[]=$key.'/'.$value;

	}

	$get_final=implode('/', $arr_get);

	$sep='/get/';

	if(preg_match('/\/$/', $url_fancy))
	{

		$sep='get/';

	}
	
	
	if(preg_match('/\/get\//', $url_fancy))
	{

		$sep='/';

	}

	return $url_fancy.$sep.$get_final;

}
/*
function controller_fancy_url($func_name, $description_text, $arr_data=array(), $respect_upper=0)
{

	return make_fancy_url(PhangoVar::$base_url, PhangoVar::$script_module, $func_name, $description_text, $arr_data, $respect_upper);

}
*/

/**
*
* Function for normalize texts for use on urls or other things...
*
* @param string $text String for normalize
* @param boolean $respect_upper If true or 1 respect uppercase, if false or 0 convert to lowercase the $text
* @param string $replace Character used for replace text spaces.
*
*
*/

function slugify($text, $respect_upper=0, $replace_space='-', $replace_dot=0, $replace_barr=0)
{

	$from='àáâãäåæçèéêëìíîïðòóôõöøùúûýþÿŕñÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÝỲŸÞŔÑ¿?!¡()"|#*%,;+&$ºª<>`çÇ{}@~=^:´[]';
	$to=  'aaaaaaaceeeeiiiidoooooouuuybyrnAAAAAACEEEEIIIIDOOOOOOUUUYYYBRN---------------------------------';
	
	if($replace_dot==1)
	{
	
		$from.='.';
		$to.='-';
	
	}
	
	if($replace_barr==1)
	{
	
		$from.="/";
		$to.="-";
	
	}

	$text=trim(str_replace(" ", $replace_space, $text));

	$text = utf8_decode($text);    
	$text = strtr($text, utf8_decode($from), $to);
	
	//Used for pass base64 via GET that use upper, for example.
	
	if($respect_upper==0)
	{
	
		$text = strtolower($text);
		
	}

	return utf8_encode($text); 

}

//Load_view is a very important function. Phango is an MVC framework and has separate code and html.

/**
* Very important function used for load views. Is the V in the MVC paradigm.
*
* load_view is used for load the views. Views in Phango are php files with a function that have a special name with "View" suffix. For example, if you create a view file with the name blog.php, inside you need create a php function called BlogView(). The arguments of this function can be that you want, how on any normal php function. The view files need to be saved on a "view" folders inside of a theme folder, or a "views/module_name" folder inside of a module being "module_name" the name of the module.
*
* @param array $arr_template Arguments for the view function of the view.
* @param string $template Name of the view. Tipically views/$template.php or modules/name_module/views/name_module/$template.php
* @param string $module_theme If the view are on a different theme and you don't want put the view on the theme, use this variable for go to the other theme.
* @param string $load_if_no_cache Variable used if you want the view wasn't if used a first time.
*/

function load_view($arr_template, $template, $module_theme='', $load_if_no_cache=0)
{

	//First see in controller/view/template, if not see in /views/template
	
	$theme=PhangoVar::$dir_theme;
	
	$container_theme=PhangoVar::$module_theme;
	
	$view='';
	
	if(!isset(PhangoVar::$cache_template[$template])) 
	{

		//First, load view from module...

		ob_start();
		
		//Load view from theme...
		
		if(!include(PhangoVar::$base_path.$container_theme.'views/'.$theme.'/'.strtolower($template).'.php')) 
		{

			$output_error_view=ob_get_contents();

			ob_clean();

			//No exists view in theme, load view respect to the PhangoVar::$script_module views
			
			if(!include(PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/views/'.strtolower($template).'.php')) 
			{

				$output_error_view.=ob_get_contents();

				ob_clean();

				//No exists view in module where , load view respect to the module_theme variable...

				if(!include(PhangoVar::$base_path.'modules/'.$module_theme.'/views/'.strtolower($template).'.php')) 
				{

					//No exists view, see error from phango framework
					
					$output=ob_get_contents();

					ob_clean();
					
					include(PhangoVar::$base_path.'views/default/common/common.php');
				
					$template=@form_text($template);

					CommonView('Phango Framework error','<p>Error while loading template <strong>'.$template.'</strong>, check config.php or that template exists... </p><p>Output: '.$output_error_view.'<p>'.$output.'</p>');
					
					ob_end_flush();
					
					die;

				}

			}

		}

		ob_end_flush();

		//If load view, save function name for call write the html again without call include view too
		
		PhangoVar::$cache_template[$template]=basename($template).'View';

	}
	else 
	if($load_if_no_cache!=0)
	{
			
		return  '';
		
	
	}
	
	ob_start();

	$func_view=PhangoVar::$cache_template[$template];
	
	//Load function from loaded view with his parameters

	call_user_func_array($func_view, $arr_template);

	$out_template=ob_get_contents();

	ob_end_clean();
	
	return $out_template;

}

/**
* Function for load multiple views for a only source file.
* 
* Useful for functions where you need separated views for use on something, When you use load_view for execute a view function, the names used for views are in $func_views array.
*
* @param string $template of the view library. Use the same format for normal views. 
* @param string The names of templates, used how template_name for call views with load_view.
*/

function load_libraries_views($template, $func_views=array())
{
	
	$theme=PhangoVar::$dir_theme;

	$container_theme=PhangoVar::$module_theme;
	
	$view='';

	//Load views from a source file...
	
	//Check func views...
	
	$no_loaded=0;

	foreach($func_views as $template_check)
	{

		if(isset(PhangoVar::$cache_template[$template_check]))
		{
			//Function view loaded, return because load_view load the function automatically.
		
			$no_loaded++;
		
		}

	}
	
	if($no_loaded==0)
	{	
		if(!include_once(PhangoVar::$base_path.$container_theme.'views/'.$theme.'/'.strtolower($template).'.php')) 
		{
			
			$output_error_view=ob_get_contents();

			ob_clean();

			if(!include_once(PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/views/'.strtolower($template).'.php')) 
			{

				$output=ob_get_contents();

				ob_clean();

				include(PhangoVar::$base_path.'views/default/common/common.php');
				
				CommonView('Phango Framework error','<p>Error while loading template library <strong>'.$template.'</strong>, check config.php or that template library exists... </p><p>Output: '.$output_error_view.$output.'</p>');
				
				ob_end_flush();
				
				die;

			}

		}
		
	}
	
	//Forever register views if the code use different functions in a same library.
	
	foreach($func_views as $template)
	{

		PhangoVar::$cache_template[$template]=basename($template).'View';

	}


}


/**
* Internal function used for check if model is loaded in framework.
* 
* @param string $model_name Name of the model.
*/

function check_model($model_name)
{

	// || !isset( PhangoVar::$model[$model_name] ) 

	if( !isset(PhangoVar::$arr_check_table[$model_name]) )
	{

		/*$output=ob_get_contents();

		$no_exists[1]='<p>Don\'t exists '.$model_name.' models or model don\'t loaded. Please use <strong>php padmin.php model_container or function load_model(\''.$model_name.'\')</strong>.</p><p>Output: '.$output.'</p>';

		$no_exists[0]='<p>Don\'t exists the model or model don\'t loaded.</p>';

		ob_clean();
		
		echo load_view(array('Phango site is down', '<p>'.$no_exists[DEBUG].'</p>'), 'common/common');

		ob_end_flush();

		die;*/


		return 1;

	}

	return 0;

}

/**
* Internal function used for check if models and database are well synchronized.
* 
*/

function check_model_exists()
{
	
	$arr_keys_model=array_keys(PhangoVar::$model);

	$error_model=array();

	$c_model=0;

	foreach($arr_keys_model as $key)
	{

		if(!isset(PhangoVar::$arr_check_table[$key]))
		{

			$error_model[]=$key;
			$c_model++;

		}

	}


	if( $c_model >0 ) 
	{

		$output=ob_get_contents();

		$no_exists[1]='<p>Don\'t exists '.implode(',', $error_model).' models. Please use <strong>php padmin.php model_container</strong>.</p><p>Output: '.$output.'</p>';

		$no_exists[0]='<p>Don\'t exists the model.</p>';

		ob_clean();
		
		echo load_view(array('Phango site is down', '<p>'.$no_exists[DEBUG].'</p>'), 'common/common');

		ob_end_flush();

		die;

	}

}

//Function for load the models..., if the model_file != models_path.php put model in format path/model_file

/**
*
* Function used for load models on controllers (or where you like, ;) ).
*
* When you call load_model with a name, or many names, phango look if exists a folder on modules called how $name_model. If find this, try open a file called "models_$name_model.php". If not exists, you obtain a phango exception error. If you want load a model file with other name, you can use this format: module_name/other_model_name being module_name, the name of the module an other_model_name the name of the model.
*
* Remember that the models can have a name distinct to the name of the file model.
*
* @param $name_model A serie of names of the models. 
*
*/

function load_model($name_model='')
{
	
	$names=func_get_args();
	
	//Load a source file only	
	
	foreach($names as $my_model)
	{

		$arr_file=explode('/', $my_model);

		$my_path=$arr_file[0];

		if(count($arr_file)>1)
		{

			$my_model=$arr_file[1];

		}

		
		if( !isset(PhangoVar::$cache_model[$my_model]) )
		{

			$path_model=PhangoVar::$base_path.'modules/'.$my_path.'/models/models_'.$my_model.'.php';
		
			if(!include($path_model)) 
			{

				$arr_error_sql[0]='<p>Error: Cannot load a file model.</p>';    
				$arr_error_sql[1]='<p>Error: Cannot load '.$my_model.' file model.</p>';
				
				$output=ob_get_contents();

				$arr_error_sql[1].='<p>Output: '.$output.'</p>';

				ob_clean();
			
				echo load_view(array('Phango site is down', $arr_error_sql[DEBUG]), 'common/common');

				die();
			
			}
			else
			{
				
				PhangoVar::$cache_model[$my_model]=1;

			}
			
			//Now, load extension if necessary
			
			if(isset(PhangoVar::$arr_extension_model[$my_model]))
			{
				
				load_extension($my_model);
			
			}
			

		}

	
	}
	//Check if model and db is synced

	//check_model_exists();

}

/**
* Function for load config for modules.
*
*
* @param $module Name of the module
* @param $name_config Name of the config file, optional. Normally load config.php file on folder config.
*/

function load_config($module, $name_config='config_module')
{

	//load_libraries(array($name_config), PhangoVar::$base_path.'/modules/'.$module.'/config/');
	
	if(is_file(PhangoVar::$base_path.'/modules/'.$module.'/config/'.$name_config.'.php'))
	{
		include(PhangoVar::$base_path.'/modules/'.$module.'/config/'.$name_config.'.php');
	}
	
}

/**
* Internal function used for load_model for load extensions to the models. You can specific your extensions using PhangoVar::$arr_extension_model array. The name of an extension file is extension_name.php where name is the name given how PhangoVar::$arr_extension_model item.
*
*/

function load_extension()
{
	
	$names=func_get_args();
	
	foreach($names as $my_model)
	{

		$arr_file=explode('/', $my_model);

		$my_path=$arr_file[0];

		if(count($arr_file)>1)
		{

			$my_model=$arr_file[1];

		}
		
	}
	
	if( !isset(PhangoVar::$cache_model['extension_'.$my_model]) )
	{
		
		$path_model=PhangoVar::$base_path.'modules/'.$my_path.'/models/extension_'.$my_model.'.php';
		
		if(!include($path_model)) 
		{
		
			$arr_error_sql[0]='<p>Error: Cannot load a file extension model.</p>';    
			$arr_error_sql[1]='<p>Error: Cannot load '.$my_model.' file extension model.</p>';
			
			$output=ob_get_contents();

			$arr_error_sql[1].='<p>Output: '.$output.'</p>';

			ob_clean();
		
			echo load_view(array('Phango site is down', $arr_error_sql[DEBUG]), 'common/common');

			die();
		
		}
		else
		{
		
			PhangoVar::$cache_model['extension_'.$my_model]=1;
		
		}
	
	}

}

//Load libraries, well, simply a elegant include

function load_libraries($names, $path='')
{
	
	if(gettype($names)!='array')
	{
		ob_clean();
		$check_error_lib[1]='Error: You need an array how parameter in load_libraries. Return value: '.$names;
		$check_error_lib[0]='Error';
		
		echo load_view(array('Load libraries error', $check_error_lib[DEBUG]), 'common/common');
		die();

	}

	if($path=='')
	{

		$path=PhangoVar::$base_path.'libraries/';

	}
	
	foreach($names as $library) 
	{
		

		if(!isset(PhangoVar::$cache_libraries[$library]))
		{
		
			if(!include($path.$library.'.php')) 
			{
			
				//Libraries path
				
				$path=PhangoVar::$base_path.'/modules/'.PhangoVar::$script_module.'/libraries/';
				
				if(!include($path.$library.'.php')) 
				{
			
					$output=ob_get_contents();

					$check_error_lib[1]='Error: Don\'t exists '.$library.'.<p>Output: '.$output.'</p>';
					$check_error_lib[0]='Error loading library.';

					ob_end_clean();
				
			
					echo load_view(array('Load libraries error', $check_error_lib[DEBUG]), 'common/common');
					die();
					
				}
				else
				{

					PhangoVar::$cache_libraries[$library]=1;

				}
			
			}
			else
			{

				PhangoVar::$cache_libraries[$library]=1;

			}

		}

	}

	return true;

}

//Load a language file...
//Other elegant include...

function load_lang()
{
	
	if(isset($_SESSION['language']))
	{

		PhangoVar::$language=$_SESSION['language'];

	}
	else
	{
	
		$_SESSION['language']=PhangoVar::$language;
	
	}
	
	$arg_list = func_get_args();
	
	foreach($arg_list as $lang_file)
	{

		$lang_file=basename($lang_file);

		if(!isset(PhangoVar::$cache_lang[$lang_file]))
		{

			//First search in module, after in root i18n.

			//echo PhangoVar::$base_path.'modules/'.$lang_file.'/i18n/'.PhangoVar::$language.'/'.$lang_file.'.php';

			ob_start();

			$module_path=$lang_file;
				
			$pos=strpos($module_path, "_");
			
			if($pos!==false)
			{

				$arr_path=explode('_', $module_path);

				$module_path=$arr_path[0];
				
			}
			
			$file_path=PhangoVar::$base_path.'modules/'.$module_path.'/i18n/'.PhangoVar::$language.'/'.$lang_file.'.php';
			
			if(!include($file_path))
			{

				$output_error_lang=ob_get_contents();
			
				if(!include(PhangoVar::$base_path.'i18n/'.PhangoVar::$language.'/'.$lang_file.'.php')) 
				{
					
					$output=ob_get_contents();
				
					ob_end_clean();
					ob_end_clean();
					//'.$output_error_lang.' '.$output.'
					$check_error_lang[1]='Error: Don\'t exists PhangoVar::$lang['.$lang_file.']variable. Do you execute <strong>check_language.php</strong>?.<p></p>';
					$check_error_lang[0]='Error: Do you execute <strong>check_language.php</strong>?.';

					/*echo load_view(array('Internationalization error', $check_error_lang[DEBUG]), 'common/common');
					die();*/
					show_error($check_error_lang[0], $check_error_lang[1], $output);
				
				}

			}

			ob_end_clean();

			PhangoVar::$cache_lang[$lang_file]=1;

		}

	}

}

//Set raw variables from a array

function check_variables($arr_variables, $fields=array())
{

	if(count($fields)==0)
	{

		$fields=array_keys($arr_variables);

	}

	$arr_final=array();

	foreach($fields as $field) 
	{
		settype($arr_variables[$field], 'string');
		$arr_final[$field]=unmake_slashes( form_text( urldecode( $arr_variables[$field] ) ) );

	}

	return $arr_final;

}

//Fill arr_check_table for check if exists model

function load_check_model()
{

	$table='';
	PhangoVar::$arr_check_table=array();

	$query=webtsys_query(SQL_SHOW_TABLES);

	while(list($table)=webtsys_fetch_row($query))
	{

		PhangoVar::$arr_check_table[$table]=1;

	}

	return PhangoVar::$arr_check_table;

}

//Function for strip values with keys inside $array_strip

function strip_fields_array($array_strip, $array_source)
{

	$array_source=array();

	foreach($array_strip as $field_strip)
	{

		unset($array_source[$field_strip]);

	}

	return $array_source;

}

//Function for strip values without keys inside $array_strip

function filter_fields_array($array_strip, $array_source)
{

	$array_final=array();
	
	if(count($array_strip)>0)
	{
		foreach($array_strip as $field_strip)
		{

			$array_final[$field_strip]=@$array_source[$field_strip];

		}

		return $array_final;

	}
	else
	{
	
		return $array_source;
	
	}
}

function set_csrf_key()
{

        echo "\n".HiddenForm('csrf_token', '', PhangoVar::$key_csrf)."\n";

}

function show_error($txt_error_normal, $txt_error_debug, $output_external='')
{

	
	$arr_error[0]='<p>'.$txt_error_normal.'</p>';    
	$arr_error[1]='<p>'.$txt_error_debug.'</p>';
	
	$output=ob_get_contents();

	$arr_error[1].="\n\n".'<p>Output: '.$output."\n".$output_external.'</p>';

	$arr_view[0]='common';
	$arr_view[1]='commontxt';
	
	if(PhangoVar::$utility_cli==0)
	{

		ob_clean();

	}

	echo load_view(array('Phango site is down', $arr_error[DEBUG]), 'common/'.$arr_view[PhangoVar::$utility_cli]);

	die();

}

function load_header_view()
{

	//Delete repeat scripts...

	PhangoVar::$arr_cache_header=array_unique(PhangoVar::$arr_cache_header, SORT_STRING);
	
	ksort(PhangoVar::$arr_cache_header);

	return implode("\n", PhangoVar::$arr_cache_header)."\n";

}

//A function for load all files into media folder, on application, theme view, or module.
//Here is load from theme view or module views. Without base64 code.
//the type is the folder where you search into media.

function get_url_media($name_media, $module='none')
{

	return make_fancy_url(PhangoVar::$media_url, 'media', 'show', array('module' => $module, 'media' => $name_media));

}

if(PhangoVar::$THEME_MODULE==1)
{

	function get_url_image($img_name, $module='none')
	{
	
		//Redirect to php
		
		//$img_name=urlencode_redirect($img_name, 1);
		
		//$arr_image_def=array('module' => $module, 'image' => 'images/'.$img_name);
		
		//return make_fancy_url(PhangoVar::$media_url, 'media', 'image', $arr_image_def);
		
		return get_url_media('images/'.$img_name, $module);
	
	}
	
	function load_css_view()
	{
		
		//Delete repeat scripts...

		PhangoVar::$arr_cache_css=array_unique(PhangoVar::$arr_cache_css, SORT_STRING);
		$arr_final_css=array();

		foreach(PhangoVar::$arr_cache_css as $idcss => $css)
		{
			
			$module_css='none';
			
			if(gettype($css)=='array')
			{
				
				$module_css=$idcss;
				
				foreach($css as $css_item)
				{
					/*$css_item=slugify(urlencode_redirect($css_item, 1), 1);
				
					$url=make_fancy_url(PhangoVar::$media_url, 'media', 'css', array('module' => $module_css, 'css' => $css_item));
					*/
					
					$url=get_url_media('css/'.$css_item, $module_css);
					
					$arr_final_css[]='<link href="'.$url.'" rel="stylesheet" type="text/css"/>'."\n";
				}
			}
			else
			{
				
				/*$css=slugify(urlencode_redirect($css, 1), 1);
				
				$url=make_fancy_url(PhangoVar::$media_url, 'media', 'css', array('module' => $module_css, 'css' => $css));*/
				
				$url=get_url_media('css/'.$css, $module_css);
				
				$arr_final_css[]='<link href="'.$url.'" rel="stylesheet" type="text/css"/>'."\n";

			}
		}

		return implode("\n", $arr_final_css)."\n";

	}
	
	function load_jscript_view()
	{
		
		//Delete repeat scripts...

		PhangoVar::$arr_cache_jscript=array_unique(PhangoVar::$arr_cache_jscript, SORT_STRING);
		$arr_final_jscript=array();

		foreach(PhangoVar::$arr_cache_jscript as $idjscript => $jscript)
		{
			
			$module_jscript='none';
			
			if(gettype($jscript)=='array')
			{
				
				$module_jscript=$idjscript;
				
				foreach($jscript as $jscript_item)
				{
					/*$jscript_item=slugify(urlencode_redirect($jscript_item, 1), 1);
				
					$url=make_fancy_url(PhangoVar::$media_url, 'media', 'jscript', array('module' => $module_jscript, 'jscript' => $jscript_item));*/
					
					$url=get_url_media('jscript/'.$jscript_item, $module_jscript);
					
					$arr_final_jscript[]='<script language="javascript" src="'.$url.'"></script>'."\n";
				}
			}
			else
			{
				
				/*$jscript=slugify(urlencode_redirect($jscript, 1), 1);
				
				$url=make_fancy_url(PhangoVar::$media_url, 'media', 'jscript', array('module' => $module_jscript, 'jscript' => $jscript));*/
				
				$url=get_url_media('jscript/'.$jscript, $module_jscript);
				
				$arr_final_jscript[]='<script language="javascript" src="'.$url.'"></script>'."\n";

			}
		}
		
		return implode("\n", $arr_final_jscript)."\n";
	
	}
}
else
{

	function get_url_image($img_name, $module='')
	{
	
		//Redirect to image
		//media/default/images
		
		return PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$module.'/images/'.$img_name;
	
	}
	
	function load_css_view()
	{

		//Delete repeat scripts...

		PhangoVar::$arr_cache_css=array_unique(PhangoVar::$arr_cache_css, SORT_STRING);
		$arr_final_css=array();

		foreach(PhangoVar::$arr_cache_css as $idcss => $css)
		{
		
			if(gettype($css)=='array')
			{
			
				foreach($css as $css_item)
				{
				
					$arr_final_css[]='<link href="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$idcss.'/css/'.$css_item.'" rel="stylesheet" type="text/css"/>'."\n";
				
				}
			
			}
			else
			{
				$arr_final_css[]='<link href="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/css/'.$css.'" rel="stylesheet" type="text/css"/>'."\n";
			}
		}

		return implode("\n", $arr_final_css)."\n";

	}
	
	function load_jscript_view()
	{


		//Delete repeat scripts...

		PhangoVar::$arr_cache_jscript=array_unique(PhangoVar::$arr_cache_jscript, SORT_STRING);
		$arr_final_jscript=array();

		foreach(PhangoVar::$arr_cache_jscript as $idjscript => $jscript)
		{
		
			if(gettype($jscript)=='array')
			{
			
				foreach($jscript as $jscript_item)
				{
				
					$arr_final_jscript[]='<script language="javascript" src="'.PhangoVar::$media_url.'/media/'.PhangoVar::$dir_theme.'/'.$idjscript.'/jscript/'.$jscript_item.'"></script>'."\n";
				
				}
			
			}
			else
			{
				$arr_final_jscript[]='<script language="Javascript" src="'.PhangoVar::$media_url.'/media/jscript/'.$jscript.'"></script>'."\n";
			}
		}

		return implode("\n", $arr_final_jscript)."\n";
	
	}

}

/**
*
* Function for encode an url in base64 for use on normalized get parameters.
*
* @param string $url Url for encode in base64
*
*/

function urlencode_redirect($url)
{

	$base64_url=base64_encode( $url );
	
	$arr_char_ugly='+/=';
	$arr_char_cool='-_.';
	
	$replace=strtr($base64_url, $arr_char_ugly, $arr_char_cool);
	
	return $replace;

}

/**
* Function for decode an url in base64 for use on normalized get parameters.
*
* @param string $url Url for decode in base64
*
*/

function urldecode_redirect($url_encoded)
{

	$arr_char_cool='-_.';
	$arr_char_ugly='+/=';

	$url_encoded=strtr($url_encoded, $arr_char_cool, $arr_char_ugly);
	
	$url=base64_decode( $url_encoded , true);
	
	return $url;

}

/**
* A internal helper function 
*
* @param string $name Name for process
*
*/

function set_name_default($name)
{

	return ucfirst(str_replace('_', ' ', $name));

}

/**
* A function for generate a rand token used on sessions.
*
*/

function get_token()
{

	$rand_prefix=generate_random_password();
	
	return sha1( uniqid($rand_prefix, true) );

}

/**
* Function for load the controller, first, load the urls, and check, with this info, load the controller from the module X and finally, the action.
*
*/

function load_controller()
{

	//First, load and check urls. 
	
	//$server_host_php='http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	
	//Load urls, you need load this for make_fancy_url
	
	foreach(PhangoVar::$activated_modules as $module)
	{
	
		if(!include(PhangoVar::$base_path.'modules/'.$module.'/urls.php'))
		{
		
			echo show_error('Not found urls.php for the module '.$module, 'Not found urls.php for the module '.$module, $output_external='');
			
			die;
		
		}
				
	
	}
	
	$request_uri=$_SERVER['REQUEST_URI'];
	
	$request_uri=str_replace(PhangoVar::$cookie_path, '', $request_uri);
	
	$request_uri=str_replace('index.php/', '', $request_uri);
	
	$arr_extra_get=explode('/get/', $request_uri);
	
	if(isset($arr_extra_get[1]))
	{
	
		$arr_variables=explode('/', $arr_extra_get[1]);
	
		$cget=count($arr_variables);

		if($cget % 2 !=0 ) 
		{

			$arr_variables[]='';
			$cget++;
		}

		if($cget % 2 ==0 )
		{
			//Get variables

			for($x=0;$x<$cget;$x+=2)
			{
				
				//Cut big variables...

				$_GET[$arr_variables[$x]]=urldecode(slugify(substr($arr_variables[$x+1], 0, 255), 1));

			}

		}
		
		
	
	}
	
	//Delete $_GET elements.
	
	$request_uri=preg_replace('/\/\?.*$/', '', $request_uri);
	
	//Delete get elements.
	
	$request_uri=preg_replace('/\/get\/.*$/', '', $request_uri);
	
	if($request_uri=='' || $request_uri=='index.php')
	{
		
		PhangoVar::$script_module=PhangoVar::$app_index;
		
		PhangoVar::$script_controller='index';
		
		PhangoVar::$script_action='index';
	
	}
	else
	{
	
		//Search in 
		
		$arr_uri=explode('/', $request_uri);
		
		$search_in=$arr_uri[0];
		
		if(isset(PhangoVar::$urls[$search_in]))
		{
		
			$yes_match=0;
		
			foreach(PhangoVar::$urls[$search_in] as $arr_url)
			{
				
				$pattern=$arr_url['pattern'];
			
				$module=$arr_url['module'];
			
				$controller=$arr_url['controller'];
				
				$action=$arr_url['action'];
				
				if($yes_match==0)
				{
			
					if(preg_match($pattern, $request_uri))
					{
					
						PhangoVar::$script_module=$module;
			
						PhangoVar::$script_controller=$controller;
						
						PhangoVar::$script_action=$action;
						
						//Obtain get parameters.
						
						//Prepare string
						
						$arr_param['string']='slugify_get';
						$arr_param['integer']='integer_get';
						
						$str_param=implode('|', array_keys($arr_url['parameters']));
						
						$str_parameters=preg_replace($pattern, $str_param, $request_uri);
						
						PhangoVar::$get=explode('|', $str_parameters);
						
						$z=0;
						
						foreach($arr_url['parameters'] as $key => $value)
						{
						
							$check_param_func=$arr_param[ $value ];
							
							PhangoVar::$get[$z]=$check_param_func(PhangoVar::$get[$z]);
						
							$z++;
						
						}
						
						$yes_match=1;
					
					}
					
				}
			
			}
			
		}
	
	}
	
	//Check if all url module dependencies is loaded.
	
	$arr_keys_urls=array_keys(PhangoVar::$urls);
	
	$arr_no_loaded_urls=array_diff(PhangoVar::$url_module_requires, $arr_keys_urls);
	
	foreach($arr_no_loaded_urls as $url_no_loaded)
	{
	
		$output=ob_get_contents();

		ob_clean();

		$arr_no_controller[0]='<p>Don\'t loaded necessary urls..</p>';
		$arr_no_controller[1]='<p>Don\'t loaded necessary urls '.$url_no_loaded.'</p>';

		echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
		
		die;
	
	}
	
	$folder_controller='';
	
	if(@strpos('/', PhangoVar::$script_controller))
	{
	
		$arr_controller=explode('/', PhangoVar::$script_controller);
		
		$folder_controller=basename($arr_controller[0]).'/';
	
	}
	
	if(in_array(PhangoVar::$script_module, PhangoVar::$activated_modules)) 
	{
		
		$path_script_controller=PhangoVar::$base_path.'modules/'.PhangoVar::$script_module.'/controllers/'.$folder_controller.'controller_'.PhangoVar::$script_controller.'.php';
		
		$script_class_name=ucfirst(PhangoVar::$script_controller).'SwitchClass';
		
		//$script_class='index';
		
		if(include($path_script_controller))
		{
			if(class_exists($script_class_name))
			{
			
				if(isset(PhangoVar::$get[0]))
				{
					if(PhangoVar::$get[0]=='')
					{
					
						PhangoVar::$get=array();
					
					}
				}
				
				$script_class=new $script_class_name();
				
				if(call_user_func_array(array($script_class, PhangoVar::$script_action), PhangoVar::$get)===false)
				{
				
					$output=ob_get_contents();

					ob_clean();

					$arr_no_controller[0]='<p>Don\'t exist controller method</p>';
					$arr_no_controller[1]='<p>Don\'t exist '.PhangoVar::$script_action.' on <strong>'.$path_script_controller.'.php</strong></p><p>Output: '.$output.'</p>';

					echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
					
					die;
				
				}
			
			
			}
			else 
			{

				$output=ob_get_contents();

				ob_clean();

				$arr_no_controller[0]='<p>Don\'t exist controller class</p>';
				$arr_no_controller[1]='<p>Don\'t exist '.$script_class_name.' <strong>'.PhangoVar::$script_controller.' folder</strong></p>';

				echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
				
				die;

			}
			
		}
		else
		{
		
			$output=ob_get_contents();

			ob_clean();

			$arr_no_controller[0]='<p>Don\'t exist controller file</p>';
			$arr_no_controller[1]='<p>Don\'t exist '.$path_script_controller.'</p>';

			echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
			
			die;
		
		}
		
	}
	else
	{
	
		$output=ob_get_contents();

		ob_clean();

		$arr_no_controller[0]='<p>Don\'t exist module</p>';
		$arr_no_controller[1]='<p>Don\'t exist module '.PhangoVar::$script_module.' on PhangoVar::$activated_modules</p></p>';

		echo show_error($arr_no_controller[0], $arr_no_controller[1], $output_external=$output);
		
		die;
	
	}
	
	
	

}

function slugify_get($value)
{

	$value=preg_replace('/\?.*$/', '', $value);

	return slugify($value, 1);

}

function integer_get($value)
{

	settype($value, 'integer');
	
	return $value;

}

function generate_random_password($length_pass=14)
{

	$x=0;
	$z=0;

	$abc = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '*', '+', '!', '-', '_');
	
	shuffle($abc);
	
	$c_chars=count($abc)-1;

	$password_final='';

	for($x=0;$x<$length_pass;$x++)
	{

		$z=mt_rand(0, $c_chars);
		
		$password_final.=$abc[$z];

	}

	return $password_final;

}

/**
*
* A simple class for create where strings with checking.
*
* With this extension, you can create sql strings for use on where parameter of select method from Webmodel.
*
* Example ['AND']->array( 'field' => array('!=', 25), 'field2' => array('=', 'value_field'), 'field3' => array('LIKE', 'value_field'), 'field4' => array('IN',  array('1','2','3'), 'limit_sql' => array('LIMIT', array(1, 10), 'order_by' => array('order_fieldY', 'ASC'
))
* 
* You can join differents sql sentences 
*/

class WhereSql {

	public $initial_sql;
	public $arr_conditions;
	public $order_by;
	public $limit;

	public function __construct($model_name, $arr_conditions=array(), $order_by=array(), $limit=array())
	{
	
		$this->model_name=$model_name;
		$this->initial_sql='WHERE 1=1 ';
		$this->arr_conditions=$arr_conditions;
		$this->order_by=$order_by;
		$this->limit=$limit;
	
	}
	
	public function get_where_sql()
	{
	
		$arr_to_glued=array();
		
		/*
		$arr_conditions['union1_AND']['AND'][]=array('moderator' => array('=', $arr_user['IdUser_admin']));
		$arr_conditions['union1_AND']['AND'][]=array('moderator' => array('!=', 0));
		$arr_conditions['union1_AND']['OR'][]=array('moderator' => array('!=', 0));
		$arr_conditions['union1_AND']['AND'][]=array('moderator' => array('=', $arr_user['IdUser_admin']));
		
		$arr_conditions['union2_OR']['AND'][]=array('moderator' => array('=', $arr_user['IdUser_admin']));
		$arr_conditions['union2_OR']['OR'][]=array('moderator' => array('!=', 1));
		$arr_conditions['union2_OR']['AND'][]=array('moderator' => array('=', '25'));
		
		$where_class->order_by[]=array('field' => 'moderator', 'order' => 'ASC');
		$where_class->order_by[]=array('field' => 'moderator', 'order' => 'ASC');
		
		$where_class->limit=array(0, 25);
		*/
		
		$arr_define_sql=array();
		
		$arr_final_sql=array();
		
		$first_sep=0;
		
		foreach($this->arr_conditions as $group => $arr_glue)
		{
		
			foreach($arr_glue as $glue => $arr_elements)
			{
				
				foreach($arr_elements as $arr_fields_where)
				{
					
					foreach($arr_fields_where as $field => $operation)
					{
					
						
					
						list($field_select, $model_name, $field_name)=$this->set_safe_name_field(PhangoVar::$model[$this->model_name], $field);
								
						$op=$operation[0];
						
						$value=$operation[1];
						
						switch($op)
						{
						
							case '=':
							
								$value=PhangoVar::$model[$model_name]->components[$field_name]->simple_check($value);
							
								$arr_to_glued[]=$field_select.' '.$op.' \''.$value.'\'';
							
							break;
							
							case '!=':
								
								$value=PhangoVar::$model[$model_name]->components[$field_name]->simple_check($value);
								
								$arr_to_glued[]=$field_select.' '.$op.' \''.$value.'\'';
							
							break;
							
							case 'LIKE':
							
								$value=PhangoVar::$model[$model_name]->components[$field_name]->simple_check($value);
							
								$arr_to_glued[]=$field_select.' '.$op.' \''.$value.'\'';
							
							break;
							
							case 'IN':
							case 'NOT IN':
							
								foreach($value as $key_val => $val)
								{
								
									$value[$key_val]=PhangoVar::$model[$model_name]->components[$field_name]->check($val);
								
								}
								
								$arr_to_glued[]=$field_select.' '.$op.' (\''.implode('\',\'', $value).'\')';
							
							break;
						
						}
						
					}
				
				}
				
				$arr_define_sql[$glue]=' '.implode(' '.$glue.' ', $arr_to_glued).' ';
				
				$arr_to_glued=array();
			
			}
			
			$arr_group=explode('_', $group);
			
			$separator_group=end($arr_group);
			
			if($first_sep==0)
			{
			
				$separator_group='AND';
			
			}
			
			$first_sep++;
			
			$arr_final_sql[]=$separator_group.' ( '.implode(' '.$glue.' ', $arr_define_sql).' ) ';
			
			//$arr_define_sql=array();
		
		}
		
		$this->initial_sql.=implode('', $arr_final_sql);
		
		return $this->initial_sql;
	
	}
	
	public function get_order_sql()
	{
	
		$arr_order_final=array();
		
		$final_order='';
		
		//$order_by[]=array('field' => 'moderator', 'order' => 'ASC'
		
		if(count($this->order_by)>0)
		{
			foreach($this->order_by as $arr_order)
			{
			
				list($field_select, $model_name, $field_name)=$this->set_safe_name_field(PhangoVar::$model[$this->model_name], $arr_order['field']);
			
				$arr_order_final[]=$field_name.' '.$arr_order['order'];
			
			}
		
			$final_order=' ORDER BY '.implode(' ,', $arr_order_final);
		
		}
		
		return $final_order;
	
	}
	
	public function get_limit_sql()
	{
			
		if(count($this->limit)>0)
		{
		
			return ' LIMIT '.implode(' ,', $this->limit);
		
		}
		
		return '';
	
	}
	
	public function get_all_sql()
	{
	
		return $this->get_where_sql().$this->get_order_sql().$this->get_limit_sql();
	
	}
	
	public function set_safe_name_field($class, $field)
	{
		
		$pos_dot=strpos($field, '.');
		
		$model_name='';
		$field_name='';
		
		if($pos_dot!==false)
		{
		
			//The model need to be loading previously.
			
			//substr ( string $string , int $start [, int $length ] )
			
			$model_name=substr($field, 0, $pos_dot);
			$field_name=substr($field, $pos_dot+1);
			
			$field_select='`'.$model_name.'`.`'.$field_name.'`';
		
		}
		else
		{
			
			$model_name=$class->name;
			$field_name=$field;
			
			$field_select='`'.$class->name.'`.`'.$field.'`';
			
		}
		
		return array($field_select, $model_name, $field_name);

	}

}

?>
