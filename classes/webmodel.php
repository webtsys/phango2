<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package webmodel
*
*/


/**
* Base file include where basic function and methods for create MVC applications
*
* This file contains principal functions and methods for create models, text formatting, forms creation, definition of basic variables, basic ORM that use on 90% of db searchs, etc...
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package Core
*
*/

//Variables


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
	
	/**
	* Property that define if this model is cached or not.
	*
	*/
	
	public $cache=0;
	
	/**
	* Property that define if this model was cached before, if not, obtain the query from the sql db.
	*
	*/
	
	public $cached=0;
	
	/**
	* Property that define the cache type, nosql, cached in memory with memcached or redis, etc.
	*
	*/
	
	public $type_cache='';

	/**
	* Property that define if id is modified.
	*
	*/
	
	public $modify_id=0;
	
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
		
		//include(PhangoVar::$base_path.'database/'.TYPE_DB.'.php');
		load_libraries(array('database/'.TYPE_DB), PhangoVar::$base_path);
	
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
	
	/**
	* Method used for connet to db, if you are connected, execute a dummy db connection method.
	* 
	*/
	
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
	* This method prepare the new sql query
	*
	* @warning This method don't check value of $fields. Use $this->check_all for this task.
	*
	* @param array $fields Is an array with data to insert. You have a key that represent the name of field to fill with data, and the value that is the data for fill.
	*
	*/
	
	public function prepare_insert_sql($fields)
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
			
		return 'insert into '.$this->name.' (`'.implode("`, `", array_keys($fields)).'`) VALUES ('.implode(", ",$arr_fields).') ';
	
	}
	
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
		
		if(!$this->modify_id)
		{
		
			unset($post[$this->idmodel]);
			
		}
		
		$arr_fields=array();
		
		if( $fields=$this->check_all($post) )
		{	
		
			if( !( $query=webtsys_query($this->prepare_insert_sql($fields), $this->db_selected) ) )
			{
			
				$this->std_error.=i18n_lang('error_model', 'cant_insert', 'Can\'t insert').' ';
				return 0;
			
			}
			else
			{
			
				return 1;
				
			}
		}
		else
		{	
			
			$this->std_error.=i18n_lang('error_model', 'cant_insert', 'Can\'t insert').' ';

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
		
		if(!$this->modify_id)
		{
		
			unset($post[$this->idmodel]);
			
		}
		
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
					;
					if(!$this->components[$name_field]->process_update_field($this, $name_field, $conditions, $fields[$name_field]))
					{
						
						$this->std_error.=i18n_lang('error_model', 'cant_update', 'Can\'t update').' ';

						return 0;
					
					}
				
				}
			
			}

			//Create the query..
		
			if(!($query=webtsys_query('update '.$this->name.' set '.implode(', ' , $arr_fields).' '.$conditions, $this->db_selected) ) )
			{
				
				$this->std_error.=i18n_lang('error_model', 'cant_update', 'Can\'t update').' ';
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
			
			$this->std_error.=i18n_lang('error_model', 'cant_update', 'Can\'t update').' ';

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
	
	public function insert_id()
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

						$this->components[$key]->std_error=i18n_lang('common', 'field_required', 'Field required');

					}

					$arr_std_error[]=i18n_lang('error_model', 'check_error_field', 'Error in field').' '.$key.' -> '.$this->components[$key]->std_error. ' ';
					$set_error++;
	
				}
		
			}
			else if($this->components[$key]->required==1)
			{
	
				//If isn't set the value and this value is required set std_error.

				$arr_std_error[]=i18n_lang('error_model', 'check_error_field_required', 'Error: Field required').' '.$key.' ';
	
				if($this->components[$key]->std_error=='')
				{

					$this->components[$key]->std_error=i18n_lang('common', 'field_required', 'Field required');

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
	
	
	/**
	* This method is used for checking if you prefer strings for where_sql.
	*/
	
	public function check_where_sql($name_component, $value)
	{
	
		return $this->components[$name_component]->check($value);
	
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
		$this->txt_error = i18n_lang('common', 'error_in_field', 'Error in field');
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

	public function set_param_value_form($value, $form_type_set='')
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
	
	public function set_parameter_value($parameters)
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
	
	public function set_parameters_form($parameters=array())
	{
	
		$z=1;
	
		foreach($parameters as $parameter)
		{
		
			$this->parameters[$z]=$parameter;
			
			$z++;
			
		}
		
	}
	
	public function set_parameter($key, $value)
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
	
	public function set_all_parameters_form($parameters)
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

	static public function check_form($arr_form, $post)
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

	static public function set_values_form($post, $arr_form, $show_error=1)
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
		
}

/**
* A simple class for create where strings with checking.
*
* With this extension, you can create sql strings for use on where parameter of select method from Webmodel.
*
* Example ['AND']->array( 'field' => array('!=', 25), 'field2' => array('=', 'value_field'), 'field3' => array('LIKE', 'value_field'), 'field4' => array('IN',  array('1','2','3'), 'limit_sql' => array('LIMIT', array(1, 10), 'order_by' => array('order_fieldY', 'ASC'
))
* 
*You can join differents sql sentences 
*
* @warning Phango developers recommend use Webmodel::check_where_sql method on a simple sql string
*
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

/**
* Simple function for make a redirection via header()
*
* @param string $url Url to redirect the website
*/

function simple_redirect_location($url)
{

	header('Location: '.$url);

	die;

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


?>
