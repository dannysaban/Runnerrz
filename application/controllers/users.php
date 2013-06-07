<?php
//header("Access-Control-Allow-Origin: *"); 
//header("content-type: application/json"); 

class Users_Controller extends Base_Controller {
	
	//public $restful = TRUE;
	//public function get_user(){}
	//public function post_user(){}
	
	
	public function action_index(){
	/**/
		$users = new Ufb();
		$cursors = $users->_get();
				
		/**/
		foreach ($cursors as $c){
			//print_r($c);//1 book
			$my = get_object_vars($c);
			echo "<br>";
	
			print_r($cursor = $my['attributes']);
			//echo "<br>";
			
			//$_oneBook = Array($cursor["name"], $cursor["link"]); 
			//print_r($_oneBook[0]." -- ".$_oneBook[1]);
	
			//echo json_encode($cursor);
			echo "<hr>";
			
		}
		
	return View::make('mongo.title')->with('users', 'end data');
		
	}	
	
	
	
	
	public function action_all(){
		
		$users = new Ufb();
		$nameQuery = array('name');
		//$nameQuery = array('Natan Shalva');
		$cursors = $users->_get($nameQuery);
		
		$Numcursors = $users->_count($nameQuery);
		echo "the num of members is : ".$Numcursors;
		echo "<br>";
				
		/**/
		//while (true){
			foreach ($cursors as $c){
				//print_r($c);//1 book
				$my = get_object_vars($c);
				echo "<br>";
				
				//$cursor = $my['attributes'];
				print_r($cursor = $my['attributes']);
				//echo "<br>";
				/*
				while($cursor["name"]){
					$_oneBook = Array($cursor["name"], $cursor["link"]); 
					print_r($_oneBook[0]." -- ".$_oneBook[1]);
					exit();
				}
				*/
	
			//echo json_encode($cursor);
				echo "<hr>";
				//exit();
			
			}
		//}
			
		return View::make('mongo.all')->with('data', 'end of data');
	}
	//
	
	public function action_location(){
		
		$connect = new MongoClient();
		$db = $connect->test;//test
    	
		//$collection = $db->fb_profile;
		//$collection = $db->fb_myprofile;
		$collection = $db->fb_myrunnerrz;
		//echo $user_profile["id"];
		//echo "<br>";
		$location = array("location" => array ("id" => "106371992735156" , "name" => "Tel Aviv, Israel"));
		$relationship = array("relationship_status" => "Single");	
		$gender = array( "gender" => "female");
		$name = array("name");
		$id = array("id");
		$all = array("relationship_status" => "Single","gender" => "female");
		$cursors = $collection->find($all);
		//print_r($toJson = json_encode($cursors));
		//return View::make('mongo.location')->with('data', 'end of data');
		//return View::make('mongo.location');
		//exit();
		//$users = new Ufb();
	 	//$i=0;
		$getData['user'] = Array();
		$testData =Array();
		
			foreach ($cursors as $cur){
				//foreach ($cur as $c=>$v){}
				//$i++;
				//echo "<hr>";
				$getData['user'][] = $cur;
				//$testData .= $getData['user'];
				
				
				
				//print_r($cur);
				//print_r($toJson = '['.json_encode($getData['user']).']');
				
				
				//$getData = null;
				/*
				 *foreach ($cur as $c=>$v){
					
					$getArray = is_array($v);
					print_r($testData = $c ."=>". $v);//ok
					echo "<br>";
					//exit();
					if($getArray){
						
						$getData .= $testData;
						
						foreach($v as $data){
							$location = $data;
							if($location == 'Tel Aviv, Israel'){
								echo $data;
								echo "<br>";
							}
						
						}
						
					
					}
					
					
				} 
				 */
				
				
				//echo json_encode($cursor);
				//echo "<hr>";
				//exit();
			
			}
			
	 $get = array("users" => $getData['user']);
	//$get = ($getData['user']);
	//return $get = '({"users":'.($getData['user']).'})';
	//$json = '('.JsonResponse::$get.')';
	//$json = '({"users":[{"id":"1540196904","name":"Michal Al","link":"http:\/\/www.facebook.com\/michal.al.10","location":{"id":"112604772085346","name":"Ramat Gan"},"gender":"female"},{"id":"1540196904","name":"Michal Al","link":"http:\/\/www.facebook.com\/michal.al.10","location":{"id":"112604772085346","name":"Ramat Gan"},"gender":"female"]});';
	
	//return Response::json($get);
	
	$_GET['callback']=null;
	$jsonX = '('.json_encode($get).');';
	$json = json_encode($get);
	
	$getJson = $_GET['callback'].$json;	
	$getJson2 = $_GET['callback'].$jsonX;	
	
	$headers = array(
			'Content-Type' => 'application/x-javascript; charset=utf-8',
			'Access-Control-Allow-Origin' => '*'
		);
	//$arr = array("get" => "$getJson");	 
	
		return Response::make($getJson, 200, $headers);
	
	
	
	
	
	//call_user_func($function)
	//return Response::prepare($response)('('.$get.')', 200, array('Content-Type' => 'application/javascript'));
	//$_GET['callback'] = null;
	//$total = $_GET['callback'].$json;
	//$view = View::make('mongo.data')->with('users',$value);
	//Response::json($json);//$value = '({"users":'.json_encode($getData['user']).'})' ;
	//return Response::json($json);
	
	//return View::make('mongo.location', array('callback' => $json));
	//return View::make('mongo.location', Response::json($get);
	
	}
	
	public function action_gender(){
		
		$connect = new MongoClient();
		$db = $connect->test;//test
    	
		//$collection = $db->fb_profile;
		//$collection = $db->fb_myprofile;
		$collection = $db->fb_myrunnerrz;
		//echo $user_profile["id"];
		//echo "<br>";
		$location = array("location" => array ("id" => "106371992735156" , "name" => "Tel Aviv, Israel"));
		$relationship = array("relationship_status" => "Single");	
		$gender = array( "gender" => "male");
		$name = array("name");
		$id = array("id");
		$all = array("relationship_status" => "Single","gender" => "male");
		$cursors = $collection->find($all);
		//print_r($toJson = json_encode($cursors));
		//return View::make('mongo.location')->with('data', 'end of data');
		//return View::make('mongo.location');
		//exit();
		//$users = new Ufb();
	 	//$i=0;
		$getData['user'] = Array();
		$testData =Array();
		
			foreach ($cursors as $cur){
				//foreach ($cur as $c=>$v){}
				//$i++;
				//echo "<hr>";
				$getData['user'][] = $cur;
				//$testData .= $getData['user'];
				
				
				
				//print_r($cur);
				//print_r($toJson = '['.json_encode($getData['user']).']');
				
				
				//$getData = null;
				/*
				 *foreach ($cur as $c=>$v){
					
					$getArray = is_array($v);
					print_r($testData = $c ."=>". $v);//ok
					echo "<br>";
					//exit();
					if($getArray){
						
						$getData .= $testData;
						
						foreach($v as $data){
							$location = $data;
							if($location == 'Tel Aviv, Israel'){
								echo $data;
								echo "<br>";
							}
						
						}
						
					
					}
					
					
				} 
				 */
				
				
				//echo json_encode($cursor);
				//echo "<hr>";
				//exit();
			
			}
			
	 $get = array("users" => $getData['user']);
	//$get = ($getData['user']);
	//return $get = '({"users":'.($getData['user']).'})';
	//$json = '('.JsonResponse::$get.')';
	//$json = '({"users":[{"id":"1540196904","name":"Michal Al","link":"http:\/\/www.facebook.com\/michal.al.10","location":{"id":"112604772085346","name":"Ramat Gan"},"gender":"female"},{"id":"1540196904","name":"Michal Al","link":"http:\/\/www.facebook.com\/michal.al.10","location":{"id":"112604772085346","name":"Ramat Gan"},"gender":"female"]});';
	
	//return Response::json($get);
	
	$_GET['callback']=null;
	$jsonX = '('.json_encode($get).');';
	$json = json_encode($get);
	
	$getJson = $_GET['callback'].$json;	
	$getJson2 = $_GET['callback'].$jsonX;	
	
	$headers = array(
			'Content-Type' => 'application/x-javascript; charset=utf-8',
			'Access-Control-Allow-Origin' => '*'
		);
	//$arr = array("get" => "$getJson");	 
	
		return Response::make($getJson, 200, $headers);
	
	
	
	}
	
}