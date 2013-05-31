<?php
class Nike_Controller extends Base_Controller {

	public function action_index()
	{
		//return "nike is all index";
		return View::make('nike.index');
	}
	
	

}