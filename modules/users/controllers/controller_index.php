<?php

load_libraries(array('login'));
load_model('users');
load_lang('users');

class IndexSwitchClass extends ControllerSwitchClass {

	protected $login;

	public function __construct()
	{
		$this->login=new LoginClass('user', 'username', 'password', '', $arr_user_session=array(), $arr_user_insert=array('username'));
	
		$this->login->url_login=make_fancy_url(PhangoVar::$base_url, 'users', 'login', array());
	
		parent::__construct();
	
	}

	public function index()
	{
		ob_start();
		
		$c_users=PhangoVar::$model['user']->select_count('');
		
		if($c_users>0)
		{
	
			$this->login->login_form();
			
			$cont_index=ob_get_contents();
			
			ob_end_clean();
			
			$this->load_theme(PhangoVar::$lang['users']['login'], $cont_index);
			
		}
		else
		{
		
			/*$this->login->create_account_form();
			
			$cont_index=ob_get_contents();
			
			ob_end_clean();
			
			$this->load_theme(PhangoVar::$lang['users']['login'], $cont_index);*/
			
			load_libraries(array('redirect'));
			
			$url_return=make_fancy_url(PhangoVar::$base_url, 'installation', 'index');
			
			$this->simple_redirect($url_return);
		
		}
	
	}
	
	public function login()
	{
	
		settype($_POST['no_expire_session'], 'integer');
	
		if(!$this->login->login($_POST['username'], $_POST['password'], $_POST['no_expire_session']))
		{
		
			ob_start();
	
			$this->login->login_form();
			
			$cont_index=ob_get_contents();
			
			ob_end_clean();
			
			$this->load_theme(PhangoVar::$lang['users']['login'], $cont_index);
		
		}
		else
		{
		
			load_libraries(array('redirect'));
			
			$url_return=make_fancy_url(PhangoVar::$base_url, ADMIN_FOLDER, 'index');
			
			$this->simple_redirect($url_return);
		
		}
	
	}

}

?>