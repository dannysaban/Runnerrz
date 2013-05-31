<?php
header("Access-Control-Allow-Origin: *"); 
header("content-type: application/json"); 
	
class User_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()//get a perameter that the post wrote
{
	
	return  json_encode('sfgdfg');//Input::get('name');
}

	public function get_match()//extra...
{

}

	public function get_edit()// a form to edit data
{

}

	public function put_update()//PUT method
{

}

	public function delete_destroy()//DELETE method
{

}

	public function post_index()//write a prameter that the get will have
{
	echo json_encode(Input::get('name'));
	header('Location: http://harmoneya.com/ajax/myAjax.html');
}

}

