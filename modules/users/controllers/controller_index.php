<?php

load_libraries(array('login'));
load_model('users');
load_lang('users');

class IndexSwitchClass extends ControllerSwitchClass {

	protected $login;

	public function __construct()
	{
		$this->login=new LoginClass('user', 'username', 'password', '', $arr_user_session=array(), $arr_user_insert=array('username', ));
	
		parent::__construct();
		
		
	
	}

	public function index()
	{
	
		//$this->login->show_
		
		$cont_index='';
		
		echo load_view(array(PhangoVar::$lang['users']['login'], $cont_index), 'home');
	
	}

}

?>