<?php
class Facebook_Controller extends Base_Controller {

	public function action_index()
	{


	$facebook = IoC::resolve('facebook-sdk');


	


		return View::make('home.index', Array('facebook'=> $facebook));
	}
	
	public function  action_me(){
		echo $get = File::get('application/libraries/data.txt');
		/**
		 *$_REQUEST['callback'] = null;
		$callback = $_REQUEST['callback'];

		// Create the output object.
		//$output = array('a' => 'Apple', 'b' => 'Banana');

		//start output
		if ($callback) {
    		header('Content-Type: text/javascript');
    		return $callback . '(' . json_encode($get) . ');';
		} else {
    		header('Content-Type: application/x-json');
    		return json_encode($get);
		}
		 */
		
		
		
		
		//$call = $_REQUEST['callback'];
		//return $call.Response::json($get);
		return View::make('facebook.me');
		
		//return Response::json($get);

		/*
		$headers = array(
			'Content-Type' => 'application/x-javascript; charset=utf-8',
			'Access-Control-Allow-Origin' => '*'
		);
		//return Response::make($_GET['callback'].'('.$get.');', 200, $headers);
		
    	return Response::make(json_encode($get), 200, $headers);
		*/
	}
	

}