<?php
class Runkeeper_Controller extends Base_Controller {

	public function action_index()
	{
		//return "nike is all index";
		return View::make('runkeeper.index');
	}
	
	

}