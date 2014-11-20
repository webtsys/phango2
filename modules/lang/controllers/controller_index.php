<?php

class IndexSwitchClass extends ControllerSwitchClass {


	public function index($lang)
	{
		
		if(in_array($lang, PhangoVar::$arr_i18n))
		{
		
			$_SESSION['language']=$lang;
			
			if($_SERVER['HTTP_REFERER']=='')
			{

				$_SERVER['HTTP_REFERER']=PhangoVar::$base_url;

			}
			
			//http://localhost/phangodev/index.php/user/show/change_lang/change_language/language/en-US
			
			if(  preg_match('/\/lang\//', $_SERVER['HTTP_REFERER']) )
			{
			
				$_SERVER['HTTP_REFERER']=$base_url;
			
			}
			
			$this->simple_redirect($_SERVER['HTTP_REFERER']);
		
		}
	
	}

}

?>