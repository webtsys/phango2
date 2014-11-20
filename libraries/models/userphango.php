<?php

load_lang('users');

class UserPhangoModel extends Webmodel {

	public $username='username';
	public $email='email';
	public $password='password';
	public $repeat_password='repeat_password';

	public function insert($post)
	{
	
		if($this->check_user_exists($post[$this->username], $post[$this->email]))
		{
		
			if(!$this->check_password($post['password'], $post['repeat_password']))
			{
			
				//$this->components['password']->required=0;
				
				$this->components[$this->password]->std_error=$lang['users']['pasword_not_equal_repeat_password'];
				
				return false;
			
			}
		
			return parent::insert($post);
		
		}
		else
		{
		
			$this->std_error=PhangoVar::$lang['users']['cannot_insert_user_email_or_user'];
		
			return false;
		
		}
	
	}
	
	public function update($post, $where_sql='')
	{
	
		if($this->check_user_exists($post[$this->username], $post[$this->email], $post['IdUser_admin']))
		{
		
			if(!$this->check_password($post['password'], $post['repeat_password']))
			{
			
				//$this->components['password']->required=0;
				
				$this->components[$this->password]->std_error=PhangoVar::$lang['users']['pasword_not_equal_repeat_password'];
				
				return false;
			
			}
			
			if(form_text($post['password'])=='')
			{
			
				$this->components[$this->password]->required=0;
				unset($post[$this->password]);
			
			}
		
			return parent::update($post, $where_sql);
		
		}
		else
		{
		
			$this->std_error=PhangoVar::$lang['users']['cannot_insert_user_email_or_user'];
		
			return false;
		
		}
	
	}
	
	public function check_password($password, $repeat_password)
	{
	
		$password=form_text($password);
		$repeat_password=form_text($repeat_password);
		
		if($password!=$repeat_password)
		{
		
			return false;
		
		}
		
		return true;
	
	}
	
	public function check_user_exists($user, $email, $iduser=0)
	{
	
		$user=$this->components[$this->username]->check($user);
		$email=$this->components[$this->email]->check($email);
		
		$where_sql='where (username="'.$user.'" or email="'.$email.'")';
		
		settype($iduser, 'integer');
		
		if($iduser>0)
		{
		
			$where_sql.=' and IdUser_admin!='.$iduser;
		
		}
		
		$c=$this->select_count($where_sql);
		
		if($c==0)
		{
		
			return true;
		
		}
		else
		{
		
			return false;
		
		}
		
	
	}

}

?>