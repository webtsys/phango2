<?php

load_libraries(array('login'));
load_model('admin');
load_lang('users');

class LoginSwitchClass extends ControllerSwitchClass {

	protected $login;

	public function __construct()
	{
		$this->login=new LoginClass('user_admin', 'username', 'password', '', $arr_user_session=array('IdUser_admin', 'privileges_user'), $arr_user_insert=array('username', 'password', 'repeat_password', 'email'));
	
		$this->login->url_login=make_fancy_url(PhangoVar::$base_url, 'admin', 'login_check', array());
		
		$this->login->url_insert=make_fancy_url(PhangoVar::$base_url, 'admin', 'register_insert', array(1));
		
		$this->login->accept_conditions=0;
		
		$this->login->field_key='token_client';
	
		parent::__construct();
	
	}

	public function index()
	{
		ob_start();
		
		$c_users=PhangoVar::$model['user_admin']->select_count('');
		
		if($c_users>0)
		{
		
			if(!$this->login->check_login())
			{
			
				$this->login->login_form();
				
				$cont_index=ob_get_contents();
				
				ob_end_clean();
				
				$this->load_theme(PhangoVar::$lang['users']['login'], $cont_index);
				
			}
			else
			{
			
				
			
			}
			
		}
		else
		{
			
			load_libraries(array('redirect'));
			
			$url_return=make_fancy_url(PhangoVar::$base_url, ADMIN_FOLDER, 'register');
			
			$this->simple_redirect($url_return);
		
		}
	
	}
	
	public function login()
	{
	
		settype($_POST['no_expire_session'], 'integer');
		settype($_POST['username'], 'string');
		settype($_POST['password'], 'string');
		
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
	
	public function remember_password()
	{
	
		
	
	}
	
	public function register($update=0)
	{
	
		$c_users=PhangoVar::$model['user_admin']->select_count('');
		
		if($c_users==0)
		{
			
			ob_start();
			
			if($update==0)
			{
	
				$this->login-> create_account_form();
				
			}
			else
			{
			
				if($this->login->create_account())
				{
				
					$url_return=make_fancy_url(PhangoVar::$base_url, ADMIN_FOLDER, 'login');
			
					$this->simple_redirect($url_return);
				
				}
				else
				{
				
					$this->login-> create_account_form();
				
				}
			
			}
			
			$cont_index=ob_get_contents();
			
			ob_end_clean();
			
			$this->load_theme(PhangoVar::$lang['users']['login'], $cont_index);
		
		}
	
	}

}

?>