<?php

class IndexSwitchClass extends ControllerSwitchClass {

	public function index()
	{

		echo load_view(array('title' => 'Welcome to Phango!', 'content' => 'This is the phango framework!!!!.'), 'common/common');

	}

}

?>