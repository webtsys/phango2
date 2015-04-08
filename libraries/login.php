<?php

/**
*
* @author  Antonio de la Rosa <webmaster@web-t-sys.com>
* @file
* @package ExtraUtils/Login
*
*
*/

class LoginClass {

	public $model_login;
	public $field_user;
	public $field_name='name';
	public $field_password;
	public $field_mail='email';
	public $field_recovery='token_recovery';
	public $name_cookie='';
	public $arr_user_session;
	public $arr_user_insert=array();
	public $field_key;
	public $session;
	public $url_login='';
	public $url_insert='';
	public $url_recovery='';
	public $url_recovery_send='';
	public $login_view='common/user/standard/loginform';
	public $edit_fields=array();
	public $create_account_view='common/user/standard/insertuserform';
	public $recovery_pass_view='common/user/standard/recoverypassform';
	public $method_crypt='sha256';
	public $accept_conditions=1;
	public $was_prepared=0;
	
	public function __construct($model_login, $field_user, $field_password, $field_key, $arr_user_session=array(), $arr_user_insert=array())
	{
	
		$this->model_login=$model_login;
		$this->field_user=$field_user;
		$this->field_password=$field_password;
		$this->arr_user_session=$arr_user_session;
		$this->field_key=$field_key;
		$this->name_cookie=PhangoVar::$model[$model_login]->name;
		
		$this->arr_user_insert=$arr_user_insert;
		
		$this->arr_user_insert[]=$this->field_user;
		$this->arr_user_insert[]=$this->field_password;
		$this->arr_user_insert[]='repeat_password';
		
		$this->arr_user_insert=array_unique($this->arr_user_insert, SORT_STRING);
		
		//Check is phangoUser the model.
		
		if(get_class(PhangoVar::$model[$this->model_login])!='UserPhangoModel')
		{
		
			show_error(users_l('A special library is need, please, inform to admin'), users_l('Special class PhangoUserClass is needed'));
		
			die;
		
		}

		//Initialize form
		
		if(count(PhangoVar::$model[$this->model_login]->forms)==0)
		{
		
			PhangoVar::$model[$this->model_login]->create_form();
		
		}
		
		if(count($this->arr_user_session)==0)
		{
		
			$this->arr_user_session[]=PhangoVar::$model[$this->model_login]->idmodel;
			$this->arr_user_session[]=$this->field_key;
		
		}

	}
	
	public function automatic_login($iduser)
	{
	
		$arr_user=PhangoVar::$model[$this->model_login]->select_a_row($iduser, array($this->field_user, $this->field_password));
	
		return $this->login($arr_user[$this->field_user], $arr_user[$this->field_password], 0, 1);
	
	}
	
	public function login($user, $password, $no_expire_session=0, $yes_hash=0)
	{
		load_libraries(array('fields/passwordfield'));
	
		$check_password=0;
	
		$user=form_text($user);
		
		$this->arr_user_session[]=$this->field_password;
		
		$arr_user=PhangoVar::$model[$this->model_login]->select_a_row_where('where '.$this->field_user.'="'.$user.'"', $this->arr_user_session);
		
		settype($arr_user[PhangoVar::$model[$this->model_login]->idmodel], 'integer');
		
		if($arr_user[PhangoVar::$model[$this->model_login]->idmodel]==0)
		{
			
			ModelForm::set_values_form($_POST, PhangoVar::$model[$this->model_login]->forms, 1);
		
			PhangoVar::$model[$this->model_login]->forms[$this->field_password]->std_error= users_l('Wrong user or password');
		
			unset($arr_user[$this->field_password]);
			
			return false;
		
		}
		else
		{
		
			$yes_password=0;
		
			
			if($yes_hash==0)
			{
			
				if(PasswordField::check_password($password, $arr_user[$this->field_password]))
				{
				
					$yes_password=1;
				
				}
				
			}
			else
			{
			
				if($password==$arr_user[$this->field_password])
				{
				
					$yes_password=1;
				
				}
				
			}
			
			if($yes_password==1)
			{
		
				unset($arr_user[$this->field_password]);
			
				$this->session=$arr_user;
				
				//Create token
				
				$new_token=sha1(get_token());
				
				PhangoVar::$model[$this->model_login]->reset_require();
				
				if( PhangoVar::$model[$this->model_login]->update(array($this->field_key => sha1($new_token)), 'where `'.PhangoVar::$model[$this->model_login]->idmodel.'`='.$arr_user[PhangoVar::$model[$this->model_login]->idmodel]) )
				{
					
					PhangoVar::$model[$this->model_login]->reload_require();
					
					$lifetime=0;
					
					if($no_expire_session==1)
					{
						
						$lifetime=time()+31536000;
						
					
					}
					
					if(!setcookie(COOKIE_NAME.'_'.sha1($this->name_cookie), $new_token,$lifetime, PhangoVar::$cookie_path))
					{
						
						return false;
					
					}
					//echo sha1($new_token); die;
					return true;
					
				}
				else
				{
				
					ModelForm::set_values_form($_POST, PhangoVar::$model[$this->model_login]->forms, 1);
				
					return false;
				
				}
				
			}
			else
			{
				
				ModelForm::set_values_form($_POST, PhangoVar::$model[$this->model_login]->forms, 1);
				
				PhangoVar::$model[$this->model_login]->forms[$this->field_password]->std_error= users_l('Wrong user or password');
			
				return false;
			
			}
		
		}
	
	}
	
	public function logout()
	{
	
		unset($_SESSION);
	
		session_destroy();
		
		//setcookie(COOKIE_NAME.'_'.sha1($this->field_key), 0, 0, PhangoVar::$cookie_path);
		
		setcookie(COOKIE_NAME, 0, 0, PhangoVar::$cookie_path);
		setcookie(COOKIE_NAME.'_'.sha1($this->name_cookie), 0, 0, PhangoVar::$cookie_path);
	
	}
	
	public function check_login()
	{
		
		$check_user=0;
		
		/*if(isset($_SESSION[$this->field_key]) && isset($_SESSION[PhangoVar::$model[$this->model_login]->idmodel]))
		{
			
			$check_user=1;
			
		}	
		else
		if(isset( $_COOKIE[COOKIE_NAME.'_'.sha1($this->field_key)] ))
		{
			
			$arr_token=$_COOKIE[COOKIE_NAME.'_'.sha1($this->field_key)];
			
			$arr_set=@unserialize($arr_token);
			
			settype($arr_set['id'], 'integer');
			
			if($arr_set['id']>0)
			{
			
				$_SESSION[PhangoVar::$model[$this->model_login]->idmodel]=$arr_set['id'];
			
				$_SESSION[$this->field_key]=$arr_set['token'];
				
				$check_user=1;
				
			}
			
		
		}*/
		$cookie_val='';
		
		if(isset($_COOKIE[COOKIE_NAME.'_'.sha1($this->name_cookie)]))
		{
		
			$cookie_val=sha1($_COOKIE[COOKIE_NAME.'_'.sha1($this->name_cookie)]);
		
			$check_user=1;
		
		}
		
		if($check_user==1)
		{
			
			$arr_user=PhangoVar::$model[$this->model_login]->select_a_row_where('where '.$this->field_key.'="'.$cookie_val.'"', $this->arr_user_session);
			
			settype($arr_user[PhangoVar::$model[$this->model_login]->idmodel], 'integer');
			
			if($arr_user[PhangoVar::$model[$this->model_login]->idmodel]==0)
			{
			
				return false;
			
			}
			else
			{
			
				$this->session=$arr_user;
			
				return true;
			
			}
		
		}
		else
		{
		
			
		
			return false;
				
		
		}
	
	}
	
	public function login_form()
	{
		
		echo load_view(array(PhangoVar::$model[$this->model_login], $this), $this->login_view);
	
	}
	
	public function recovery_password_form()
	{
		
		echo load_view(array(PhangoVar::$model[$this->model_login], $this), $this->recovery_pass_view);
	
	}
	
	public function recovery_password()
	{
	
		settype($_GET['token_recovery'], 'string');
						
		$_GET['token_recovery']=form_text($_GET['token_recovery']);
		
		load_libraries(array('send_email'));
		
		if($_GET['token_recovery']=='')
		{
		
			$email = @form_text( $_POST['email'] );
			
			$query=PhangoVar::$model[$this->model_login]->select( 'where '.$this->field_mail.'="'.$email.'"', array(PhangoVar::$model[$this->model_login]->idmodel, $this->field_name, $this->field_mail) );
			
			list($iduser_recovery, $nick, $email)=PhangoVar::$model[$this->model_login]->fetch_row($query);
			
			settype($iduser_recovery, 'integer');
			
			if($iduser_recovery>0)
			{
			
				$email = @form_text( $_POST['email'] );
		
				$query=PhangoVar::$model[$this->model_login]->select( 'where '.$this->field_mail.'="'.$email.'"', array(PhangoVar::$model[$this->model_login]->idmodel, $this->field_name, $this->field_mail) );
				
				list($iduser_recovery, $nick, $email)=PhangoVar::$model[$this->model_login]->fetch_row($query);
				
				settype($iduser_recovery, 'integer');
			
				//Create token recovery...
				
				$token_recovery=get_token();
				
				PhangoVar::$model[$this->model_login]->reset_require();
				
				$query=PhangoVar::$model[$this->model_login]->update(array($this->field_recovery => hash($this->method_crypt, $token_recovery)), 'where '.PhangoVar::$model[$this->model_login]->idmodel.'='.$iduser_recovery);
				
				//$query=PhangoVar::$model['recovery_password']->insert(array('iduser' => $iduser_recovery, 'token_recovery' => sha1($token_recovery), 'date_token' => TODAY) );
				
				//Send email
				
				$url_check_token=add_extra_fancy_url($this->url_recovery_send, array('token_recovery' => $token_recovery));
				
				$topic_email =  users_l('You requested a new password');
				$body_email =  users_l('Hello, you have requested a new password.')."\n\n". users_l('You have requested a new password. Copy and paste the following url into your browser, and a new password will be generated for you. If you did not request this operation, ignore this message.')
				."\n\n". users_l('Copy and paste the following url').': '.$url_check_token."\n\n". common_l('Thanks');
				
				if ( send_mail($email, $topic_email, $body_email) )
				{
				
					echo '<p>'. users_l('You have requested a new password. Copy and paste the following url into your browser, and a new password will be generated for you. If you did not request this operation, ignore this message.').'</p>';
				
				}
				else
				{
				
					echo '<p>'. users_l('We can not send to your email the instructions to change your password. Please contact the administrator of this site to solve the problem.').'</p>';
				
				}
				
			
			}
			else
			{

				echo  "<p>" .  users_l('Error, mail format is wrong').'</p>';
				
				echo  "<p><a href=\"".$this->url_recovery."\"><b>" . common_l('Go back') . "</b></a></p>";

			}
		
		}
		else
		{
		
			load_libraries(array('fields/passwordfield'));

			$query=PhangoVar::$model[$this->model_login]->select('where '.$this->field_recovery.'="'.hash($this->method_crypt, $_GET['token_recovery']).'"', array(PhangoVar::$model[$this->model_login]->idmodel, $this->field_name, $this->field_mail));
			
			list($iduser_recovery, $nick, $email)=PhangoVar::$model[$this->model_login]->fetch_row($query);
			
			settype($iduser_recovery, 'integer');
			
			if($iduser_recovery>0)
			{
			
				//$query=PhangoVar::$model[$this->model_login]->select( 'where '.$this->field_mail.'="'.$email.'"', array(PhangoVar::$model[$this->model_login]->idmodel, $this->field_name, $this->field_mail) );
				
				//list($iduser_recovery, $nick, $email)=PhangoVar::$model[$this->model_login]->fetch_row($query);
				
				//settype($iduser_recovery, 'integer');

				$password=generate_random_password(); 
				
				$topic_email =  users_l('The password was changed successfully.');
				$body_email =  users_l('Hello, we have changed your password and is shown below. With these data should be back online in the system.')."\n\n".  users_l('User\'s data') . "\n\n". users_l('User')." : $nick"."\n\n". common_l('Email')." : $email"."\n\n"  .  users_l('New password') . " : $password" . "\n\n" . common_l('Thanks');
					
				if ( $email != "" )
				{
					
					$portal_name=html_entity_decode(PhangoVar::$portal_name);	
					
					//$query=PhangoVar::$model['recovery_password']->delete('where '.PhangoVar::$model[$this->model_login]->idmodel.'='.$iduser_recovery);

					PhangoVar::$model[$this->model_login]->reset_require();
					
					$query = PhangoVar::$model[$this->model_login]->update(array($this->field_password => $password, $this->field_recovery => ''), 'where '.PhangoVar::$model[$this->model_login]->idmodel.'='.$iduser_recovery);
					
					if ( send_mail($email, $topic_email, $body_email) )
					{
						
						echo  "<p>" .  users_l('The password was changed successfully.').'</p>';
						echo  "<p>" .  users_l('We have sended to your email, the new password.').'</p>';

					} 
					else
					{

						echo  "<p>" .  users_l('The password was changed successfully.').'</p>';
						
						echo  "<p>" .  users_l('We can not send your new password to your email at this time, we are showing your user data in plain text. For added security, change your password once achieved identified in the system again.').'</p>';
						
						echo '<pre>';
						
						echo $body_email;
						
						echo '</pre>';

					} 
				} 

				else
				{

					echo  "<p>" .  users_l('Error, mail format is wrong').'</p>';

				}
				
			}
			else
			{
			
				echo  "<p>" .  users_l('Error: incorrect code used to change a password.').'</p>';
			
			}

			echo  "<p><a href=\"".$this->url_login. "</b></a></p>";
		}
	
	}
	
	public function create_account_form()
	{
		
		if($this->was_prepared==0)
		{
			
			$this->prepare_insert_user();
		
		}
	
		echo load_view(array('model' => PhangoVar::$model[$this->model_login], 'login_model' => $this), $this->create_account_view);
	
	}
	
	public function create_account()
	{
		
		$this->prepare_insert_user();
		
		$this->was_prepared=1;
					
		$post=filter_fields_array($this->arr_user_insert, $_POST);
		
		$no_user=0;
		
		$check_user=PhangoVar::$model[$this->model_login]->components[$this->field_user]->check($post[$this->field_user]);
		
		//$no_user=PhangoVar::$model[$this->model_login]->select_count('where `'.PhangoVar::$model[$this->model_login]->name.'`.`'.$this->field_user.'`="'.$check_user.'"');
		
		// && $no_user==0
		
		if(ModelForm::check_form(PhangoVar::$model[$this->model_login]->forms, $post))
		{
		
			/*if($_POST['repeat_password']==$post[$this->field_password] && $check_captcha==1 && $no_user==0)
			{*/
			
			PhangoVar::$model[$this->model_login]->reset_require();
			
			foreach($this->arr_user_insert as $field_require)
			{
			
				if(isset(PhangoVar::$model[$this->model_login]->components[$field_require]))
				{
					PhangoVar::$model[$this->model_login]->components[$field_require]->required=1;
				}
			}
			
			if(PhangoVar::$model[$this->model_login]->insert($post))
			{
			
				return true;
			
			}
			else
			{
			
				ModelForm::set_values_form($_POST, PhangoVar::$model[$this->model_login]->forms, 1);
			
			
				return false;
				
			}
		}
		else
		{
		
			if($no_user>0)
			{
				
				PhangoVar::$model[$this->model_login]->forms[$this->field_user]->std_error= users_l('User or email exists');
			
			}
		
			ModelForm::set_values_form($_POST, PhangoVar::$model[$this->model_login]->forms, 1);
		
			return false;
		
		}
	
	}
	
	public function prepare_insert_user()
	{
		
		//$this->arr_user_insert[]='accept_conditions';
		
		PhangoVar::$model[$this->model_login]->forms['repeat_password']=new ModelForm('repeat_password', 'repeat_password', 'PasswordForm',  users_l('Repeat password'), new PasswordField(), $required=1, $parameters='');
		
		//PhangoVar::$model[$this->model_login]->InsertAfterFieldForm($this->field_password, 'repeat_password', new ModelForm('repeat_password', 'repeat_password', 'PasswordForm',  users_l('Repeat password'), new PasswordField(), $required=1, $parameters=''));
			
		if(PhangoVar::$captcha_type!='')
		{

			load_libraries(array('fields/captchafield'));

			PhangoVar::$model[$this->model_login]->forms['captcha']=new ModelForm('captcha', 'captcha', 'CaptchaForm', common_l('Captcha'), new CaptchaField(), $required=1, $parameters='');

			$this->arr_user_insert[]='captcha';
			
		}
		
		if($this->accept_conditions==1)
		{
		
			PhangoVar::$model[$this->model_login]->forms['accept_conditions']=new ModelForm('form_login', 'accept_conditions', 'CheckBoxForm',  users_l('Accept registration conditions')	, new BooleanField(), $required=1, $parameters='');
			
			$this->arr_user_insert[]='accept_conditions';
			
		}
	
	}
	
	public function obtain_cookie_token()
	{
	
		return $_COOKIE[COOKIE_NAME.'_'.sha1($this->name_cookie)];
	
	}
	
	
}

?>