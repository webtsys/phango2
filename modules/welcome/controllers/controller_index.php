<?php

class IndexSwitchClass extends ControllerSwitchClass {

	public function index($id=0, $example_text='')
	{
	
		$text_showed='';
		
		if($id!=0)
		{
		
			$text_showed='<p>The id passed is '.$id.' and the example_text passed is '.$example_text.'</p>';
		
		}

		echo load_view(array('title' => 'Welcome to Phango!', 'content' => 'This is the phango framework!!!!.<p><a href="'.make_fancy_url(PhangoVar::$base_url, 'welcome', 'arguments', array(1, 'example_text')).'">An example link</a></p><p><a href="'.make_fancy_url(PhangoVar::$base_url, 'welcome', 'index', array()).'">Other example link</a></p>'.$text_showed), 'common/common');

	}

}

?>