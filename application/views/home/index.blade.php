<?php 
header("Access-Control-Allow-Origin: *"); 
header("content-type: application/json"); 
// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    global $user_profile;
    $user_profile = $facebook->api('/me');
    //$user_likes = $facebook->api( '/me/likes' );
    global $user_friends;
    $user_friends = $facebook->api ( '/me/friends?fields=id,name,link,picture,location,gender,birthday,interests,education,work,activities,relationship_status,interested_in' );
    
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
$params = array(
  'scope' => 'email, sms, friends_location, friends_birthday, user_relationship_details, user_birthday,friends_interests,friends_work_history,friends_activities,friends_relationship_details,friends_education_history,friends_relationships'
);
if ($user) {

  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl($params);
}
		


?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-type" name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
    <title>RunnerrZ - connecting people around activities</title>
<!-- --> 
 	<link rel="stylesheet" href="js/jquery.mobile-1.1.0.css" />

	<link rel="stylesheet" href="css/index.css" /> 
 
    <script src="js/jquery-1.7.2.min"></script>
    <!--   --> 
	<script src="js/jquery.mobile-1.1.0.js"></script>

	<!-- CDN Respositories: For production, replace lines above with these uncommented minified versions -->
	<!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />-->
	<!-- <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
	<!-- <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>-->
	

<style>
h3{
color: #3b5998;
}
a {
	text-decoration: none;
	color: #3b5998;
}

a:hover {
	text-decoration: underline;
}
#confirm{
height: 2.3em;
width: 12.5em;
}
#mybutton{
height: 2.3em;
width: 12.5em;
background-image:url("img/login-with-facebook_big.png");
}
.asa{background: white ;}

.mydiv{
width:25%;
height: 100em;
float: left; 
}
#end{
height: 10px;
}
</style>
</head>
<body>

<div data-role="page" id="page-home" class="type-interior" data-theme="b" >

	<div data-role="header" data-theme="b">
		<h1>Login to myRunnerrZ</h1>
	</div>
	
	<div data-role="content" data-theme="a" class= "asa"  >

		<div class="content-primary" >
				
	 	<?php if ($user): ?>
		
		<p><?= $user_profile["name"];  ?> </p>
		<?php 
		//return Response::json(array('name' => 'Batman'));
	
		?>
	
		<?php else: ?>
		<div>
			
			<br><br><br><br>
	<a id ="mybutton" data-role="button"  data-corners="false" data-theme="b" href="<?php echo $loginUrl; ?>"></a>
		</div>
		
		
		
		<div class="mydiv"></div>
	
		</div>
		
<?php endif ?>


<?php if ($user): ?>
<!-- --> 
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">






<pre>
<?php 

/*
	echo "<br>";
	echo "Hello user num: ".$user_profile["id"];
	echo "<br>";
	print_r($user_profile);
	////////////////////////////////////////////////
	
	//$user_friends['id'] = $user_profile["id"];
	
	
	echo "<hr>"; 

	echo "<h3> Your friends: </h3>";
*/
	//echo "<br>";
	//$user_friends['id'] = $user_profile["id"];
	//print_r($user_friends);
	//echo "<br>";
	////////////////////////////////////////////////
	/*
	//$user_likes['id'] = $user_profile["id"];	
	
	
	echo "<hr>";
	echo "<h3> Your likes: </h3>";
	echo "<br>";
	//$user_likes['id'] = $user_profile["id"];	
	print_r($user_likes);
	////////////////////////////////////////////////
	*/
	
	
	/*	
	$users = new Ufb();
	//$nameQuery = array('name');
	$getMe = array("id" => "100003538821460");// ok 
		//$nameQuery = array('Natan Shalva');
	$cursors = $users->_get($getMe);
	foreach ($cursors as $cur){
		$my = get_object_vars($cur);
		echo "<br>";
				
				//$cursor = $my['attributes'];
		print_r($cursor = $my['attributes']);
	}
	exit(); 
 */
$connect = new MongoClient();
	
if ( $connect ){
	
	// select a database
	$db = $connect->test;//test
	
	//$db = $connect->selectDB('test');
	//$collection = new MongoCollection($db, 'fb_myrunnerrz');
	
    //$db = $m->selectDB("test");
	// select a collection (analogous to a relational database's table)
	//$collection = $db->fb_profile;
	//$collection = $db->fb_myprofile;
	$collection = $db->fb_myrunnerrz;
	
	/**/
	//$collection->insert($user_profile);
	//exit();
				//$user_friends['id'] = $user_profile["id"];
				//$collection->insert($user_friends);
				//$user_likes['id'] = $user_profile["id"];
				//$collection->insert($user_likes);
	
	
	//delete database
	//$response = $collection->drop();
	
	//get information from database
	//$get = $collection->find();
	//if($get){echo "nice";}
//echo "<hr>"; 
$getNumFriends = $user_friends['data'];
$numOfFriends = count($getNumFriends);
//echo "you have ".$numOfFriends." friends";echo "<hr>";
$getId = $user_profile["id"];

$getMe = array("id" => $getId);// ok 
//exit();

//$get = $collection->find(array('id' => '100003538821460'));// get all data of user
$get = $collection->count($getMe);//exit();
//echo "<br>";
//echo $getInt = is_int($get); //1 if yes
//exit();
if($get > 0 ){
	$getUpdate = $collection->update(array('id'=>'$getId'), $user_profile);
	echo "You are allready authorised";
	//header('Refresh:5 ; http://harmoneya.com/ajax/ajax.php?data='.$getId.'');
	//echo "<br>";
	//echo "<hr>"; 
	//echo "redirecting you to myRunnerZ App...";
	//exit();
	$name = $user_profile["name"];
	$get = array("users" => array(array("name" => $name , "id" => $user)) );
	$Json = json_encode($get);
	File::put('application/libraries/data.txt', $Json);
	
	
	
	//return Response::make('facebook.me', Response::json($get));
	//return Response::json(View::make('facebook.me');
	
	//File::put('application/libraries/data.txt', '{"users":[{"name":"'.$user_profile["name"].'","id":"'.$user.'"}]}');
	
	//File::put('application/libraries/data.php', $json);
	//File::put('http://harmoneya.com/ajax/data.json','{"completed_in":0.1,"max_id":335120787545669632,"max_id_str":"335120787545669632","next_page":"?page=2&max_id=335120787545669632&q=Sencha%20Touch","page":1,"query":"Sencha+Touch","refresh_url":"?since_id=335120787545669632&q=Sencha%20Touch","results":[{"created_at":"Thu, 16 May 2013 19:53:16 +0000","from_user":"SenchaQA","from_user_id":635013921,"from_user_id_str":"635013921","from_user_name":"Sencha Q&A","geo":null,"id":335120787545669632,"id_str":"335120787545669632","iso_language_code":"de","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/2426210142\/kx414t8hvzra3l62wwe4_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/2426210142\/kx414t8hvzra3l62wwe4_normal.png","source":"&lt;a href=&quot;http:\/\/www.sencha.com&quot;&gt;Sencha Forums Q&amp;A&lt;\/a&gt;","text":"Q&amp;A - Upgrade to Touch 2.2 with 2.1 styles? http:\/\/t.co\/wMYlvgw2VU #SenchaTouch2"},{"created_at":"Thu, 16 May 2013 19:16:47 +0000","from_user":"kotsutsumi","from_user_id":69088395,"from_user_id_str":"69088395","from_user_name":"\u5c0f\u5824\u4e00\u5f18","geo":null,"id":335111605379551232,"id_str":"335111605379551232","iso_language_code":"ja","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/2056475421\/Kotsutsumi_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/2056475421\/Kotsutsumi_normal.jpg","source":"&lt;a href=&quot;http:\/\/sites.google.com\/site\/yorufukurou\/&quot;&gt;YoruFukurou&lt;\/a&gt;","text":"Sencha Touch\u306e\u65b9\u304c\u3001\u5927\u5909\u3058\u3083\u7121\u3044\u3068\u3044\u3046\u304b\u3001\u5927\u5909\u3068\u3044\u3046\u304b\u2026 \u304a\u308c\u304c\u3084\u308b\u3057\u304b\u306a\u3044\u304b\u3041\u2026"},{"created_at":"Thu, 16 May 2013 19:00:12 +0000","from_user":"Juborax","from_user_id":157150170,"from_user_id_str":"157150170","from_user_name":"Juborax","geo":null,"id":335107433611554817,"id_str":"335107433611554817","iso_language_code":"de","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1447052543\/juborax_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1447052543\/juborax_normal.png","source":"&lt;a href=&quot;http:\/\/www.juborax.com&quot;&gt;JUBORAX&lt;\/a&gt;","text":"http:\/\/t.co\/iFVfkPUZ6Y found article on  Heise.de  Sencha Touch 2.0 #f\u00fcr App Entwickler"},{"created_at":"Thu, 16 May 2013 18:03:53 +0000","from_user":"CHIKA_osawa","from_user_id":1359088508,"from_user_id_str":"1359088508","from_user_name":"Chika Osawa","geo":null,"id":335093261263855616,"id_str":"335093261263855616","iso_language_code":"ja","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/3534288622\/4b7462c23d55dcb3beebd65b19d34f9b_normal.jpeg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/3534288622\/4b7462c23d55dcb3beebd65b19d34f9b_normal.jpeg","source":"&lt;a href=&quot;http:\/\/twitter.com\/&quot;&gt;web&lt;\/a&gt;","text":"JS\u3060\u3051\u3067\u69cb\u7bc9\u30fb\u30fb\u30fb\u3053\u308c\u306f\u307e\u3060\u4f7f\u3048\u306a\u3044\nSencha Touch\nhttp:\/\/t.co\/S9pC7olRHk"},{"created_at":"Thu, 16 May 2013 17:15:24 +0000","from_user":"torre76","from_user_id":14482254,"from_user_id_str":"14482254","from_user_name":"GianLuca Dalla Torre","geo":null,"id":335081058146062336,"id_str":"335081058146062336","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/56825365\/lupetto_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/56825365\/lupetto_normal.jpg","source":"&lt;a href=&quot;http:\/\/tapbots.com\/tweetbot&quot;&gt;Tweetbot for iOS&lt;\/a&gt;","text":"RT @nilsdehl: Slides of my talk \"Develop and test custom components for Sencha Touch\" are online #jsday @sencha http:\/\/t.co\/qbI2onQVBA #SenchaTouch"},{"created_at":"Thu, 16 May 2013 17:08:28 +0000","from_user":"CustomInkSean","from_user_id":271452075,"from_user_id_str":"271452075","from_user_name":"Sean Murphy","geo":null,"id":335079312497713152,"id_str":"335079312497713152","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1285527256\/sm-0115-Sean_bw_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1285527256\/sm-0115-Sean_bw_normal.jpg","source":"&lt;a href=&quot;http:\/\/twitter.com\/&quot;&gt;web&lt;\/a&gt;","text":"RT @ModusCreate: The Ultimate Guide to Sencha Touch tomorrow at @customink. Dont forget to sign up! @ModusJesus and @SenchaMitch http:\/\/t.co\/k0aSW7oQSn"},{"created_at":"Thu, 16 May 2013 16:45:59 +0000","from_user":"bartvandeweerdt","from_user_id":14589662,"from_user_id_str":"14589662","from_user_name":"Bart Vandeweerdt","geo":null,"id":335073656319389696,"id_str":"335073656319389696","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1416940386\/zim.disguise.pondering_square_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1416940386\/zim.disguise.pondering_square_normal.jpg","source":"&lt;a href=&quot;http:\/\/tapbots.com\/software\/tweetbot\/mac&quot;&gt;Tweetbot for Mac&lt;\/a&gt;","text":"RT @nilsdehl: Slides of my talk \"Develop and test custom components for Sencha Touch\" are online #jsday @sencha http:\/\/t.co\/qbI2onQVBA #SenchaTouch"},{"created_at":"Thu, 16 May 2013 16:44:12 +0000","from_user":"BustosMG","from_user_id":113700338,"from_user_id_str":"113700338","from_user_name":"Marcelo","geo":null,"id":335073208661327872,"id_str":"335073208661327872","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/3078296348\/cbc0e8bb1b7bd58908a76f96da157b52_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/3078296348\/cbc0e8bb1b7bd58908a76f96da157b52_normal.png","source":"&lt;a href=&quot;http:\/\/www.linkedin.com\/&quot;&gt;LinkedIn&lt;\/a&gt;","text":"http:\/\/t.co\/YXTnhSRpcI Hi! Do you know if I can programme in other laguage? (Sencha Touch)"},{"created_at":"Thu, 16 May 2013 16:43:48 +0000","from_user":"Sencha","from_user_id":14539337,"from_user_id_str":"14539337","from_user_name":"Sencha","geo":null,"id":335073106974605312,"id_str":"335073106974605312","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1233097698\/sencha-blue_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1233097698\/sencha-blue_normal.png","source":"&lt;a href=&quot;http:\/\/www.hootsuite.com&quot;&gt;HootSuite&lt;\/a&gt;","text":"RT @nilsdehl: Slides of my talk \"Develop and test custom components for Sencha Touch\" are online #jsday @sencha http:\/\/t.co\/qbI2onQVBA #SenchaTouch"},{"created_at":"Thu, 16 May 2013 14:55:06 +0000","from_user":"DanielJGallo","from_user_id":76582318,"from_user_id_str":"76582318","from_user_name":"Daniel Gallo","geo":null,"id":335045750281093121,"id_str":"335045750281093121","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1154526670\/image_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1154526670\/image_normal.jpg","source":"&lt;a href=&quot;http:\/\/twitter.com\/download\/iphone&quot;&gt;Twitter for iPhone&lt;\/a&gt;","text":"RT @nilsdehl: Slides of my talk \"Develop and test custom components for Sencha Touch\" are online #jsday @sencha http:\/\/t.co\/qbI2onQVBA #SenchaTouch"},{"created_at":"Thu, 16 May 2013 12:30:37 +0000","from_user":"c0hama","from_user_id":135868694,"from_user_id_str":"135868694","from_user_name":"\u3053\u306f\u307e","geo":null,"id":335009390585315328,"id_str":"335009390585315328","iso_language_code":"ja","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/842770578\/UFO_normal.bmp","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/842770578\/UFO_normal.bmp","source":"&lt;a href=&quot;http:\/\/janetter.net\/&quot;&gt;Janetter&lt;\/a&gt;","text":"ST2 \u3068\u66f8\u304b\u308c\u305f\u6642\u306b Sublime Text 2 \u306a\u306e\u304b Sencha Touch 2 \u306a\u306e\u304b\u3067\u30a2\u30ec\u3002"},{"created_at":"Thu, 16 May 2013 12:11:08 +0000","from_user":"t_nakamura","from_user_id":15125524,"from_user_id_str":"15125524","from_user_name":"\u306a\u304b\u3080\u3089","geo":null,"id":335004485590081536,"id_str":"335004485590081536","iso_language_code":"ja","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/3002009722\/8ff2e9e8a9f495db2c83308674a4a68b_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/3002009722\/8ff2e9e8a9f495db2c83308674a4a68b_normal.png","source":"&lt;a href=&quot;http:\/\/www.hatena.ne.jp\/guide\/twitter&quot;&gt;Hatena&lt;\/a&gt;","text":"\u306f\u3066\u306a\u30d6\u30ed\u30b0\u306b\u6295\u7a3f\u3057\u307e\u3057\u305f\nSencha Touch \u306e Model \u3068 Store \u306e\u4f7f\u3044\u65b9\u30e1\u30e2 - present\n http:\/\/t.co\/l6raP7wuK8"},{"created_at":"Thu, 16 May 2013 11:18:29 +0000","from_user":"e_fontaine","from_user_id":56874564,"from_user_id_str":"56874564","from_user_name":"\u00c9ric Fontaine","geo":null,"id":334991235527884800,"id_str":"334991235527884800","iso_language_code":"fr","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/1283367901\/EricFontaine-SharePoint-twitter-800_normal.jpg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1283367901\/EricFontaine-SharePoint-twitter-800_normal.jpg","source":"&lt;a href=&quot;http:\/\/twitter.com\/&quot;&gt;web&lt;\/a&gt;","text":"Sencha Touch est un framework de d\u00e9veloppement que vous devez consid\u00e9rer s\u00e9rieusement pour un d\u00e9veloppement mobile. Merci @cotepatrice"},{"created_at":"Thu, 16 May 2013 10:38:30 +0000","from_user":"TDeBailleul","from_user_id":264103562,"from_user_id_str":"264103562","from_user_name":"Titouan de Bailleul","geo":null,"id":334981173476458496,"id_str":"334981173476458496","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/3640567723\/30723db6217a551b90d44127587bbd90_normal.jpeg","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/3640567723\/30723db6217a551b90d44127587bbd90_normal.jpeg","source":"&lt;a href=&quot;http:\/\/twitter.com\/&quot;&gt;web&lt;\/a&gt;","text":"More details on my last tweet http:\/\/t.co\/Psu6NmZRGW"},{"created_at":"Thu, 16 May 2013 10:14:03 +0000","from_user":"stuartashworth9","from_user_id":366293285,"from_user_id_str":"366293285","from_user_name":"Stuart Ashworth","geo":null,"id":334975020323450880,"id_str":"334975020323450880","iso_language_code":"en","metadata":{"result_type":"recent"},"profile_image_url":"http:\/\/a0.twimg.com\/profile_images\/3258696656\/660fd798ddbc95148b9d5087f8e0823c_normal.png","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/3258696656\/660fd798ddbc95148b9d5087f8e0823c_normal.png","source":"&lt;a href=&quot;http:\/\/twitter.com\/download\/iphone&quot;&gt;Twitter for iPhone&lt;\/a&gt;","text":"RT @nilsdehl: Slides of my talk \"Develop and test custom components for Sencha Touch\" are online #jsday @sencha http:\/\/t.co\/qbI2onQVBA #SenchaTouch"}],"results_per_page":15,"since_id":0,"since_id_str":"0"}');

		/*
	//send cURL...
	$location = "http://harmoneya.com/ajax/ajax.php";
	$writeTo = "http://harmoneya.com/ajax/file.txt";
	
	$ch = curl_init($writeTo);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$output = curl_exec($ch);

	$fh = fopen($location, 'w');
	fwrite($fh, $output);
	fclose($fh);

	header('Refresh:5 ; http://harmoneya.com/ajax/index.php');
	exit;
	
	$location = "http://harmoneya.com/ajax/ajax.php";
	$writeTo = "http://harmoneya.com/ajax/file.txt";
	$ch = curl_init($writeTo);
	--------------------------------------------
	$data = array('name' => 'Danny', 'id' => '12345');
	$json = json_encode($data);

	curl_setopt($ch, CURLOPT_URL, $location);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

	curl_exec($ch);
	
	//$fh = fopen($location, 'w');
	file_put_contents($location, $data);
	fclose($fh);
	*/
	
}
else{
	//echo "no user with id ".$getId." exist in database";
	$collection->insert($user_profile);
		//echo "profile of user num: ".$getId." is new";
		//echo "<hr>"; 
		//echo "you will be redirect to myRunnerZ App...";
		//echo "<br>";
			if ($numOfFriends > 3){
				$i = 0;	
				for ($i; $i<$numOfFriends; $i++){
					//$user_friends['id'] = $user_profile["id"];
					$collection->insert($user_friends['data'][$i]);
					print_r($user_friends['data'][$i]);
					//$i++;
					//echo "user's friend was inserted to database";
				
				}	
	
			}
			
			else {
			//echo "you have less then 3 friends - system didnt enter your friends' list";
			//echo "<hr>"; 
			//echo "redirecting you to myRunnerZ App...";
			}	

exit();
}

	
}	
	
//else {echo "problem connecting to database";}
//echo "<hr>";
//echo "end of story"."<hr>";


?>
</pre>
<?php else: ?>
<strong><em></em></strong>
<?php endif ?>
		

		</div>
	</div>
			
</div>
 
<!-- -->
<div id ="end" data-role="footer" data-position="fixed" class="footer-docs" data-theme="b">
		<p>&copy; 2013 RunnerrZ Mobile Solutions</p>
</div>
 
  </body>
</html>

