<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-type" name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
    <title>RunnerrZ - connecting people around activities</title>

 	<link rel="stylesheet" href="js/jquery.mobile-1.1.0.min.css" />
	<link rel="stylesheet" href="css/index.css" /> 

    <script src="js/jquery-1.7.2.min"></script>
	<script src="js/jquery.mobile-1.1.0.min.js"></script>
  
	<!-- CDN Respositories: For production, replace lines above with these uncommented minified versions -->
	<!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />-->
	<!-- <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
	<!-- <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>-->
	
<title>RunnerrZ - know your partners</title>
<style>

a {
	text-decoration: none;
	color: #3b5998;
}

a:hover {
	text-decoration: underline;
}

.asa{background: white ;}

</style>
</head>
<body>

<div data-role="page" id="page-home" class="type-interior" data-theme="b">

<div data-role="header" data-theme="b">
		<h1>Welcome to RunnerrZ</h1>
 		<a href="#" data-icon="home" data-iconpos="notext" id="intro" class="ui-btn-right">intro</a>
	</div>
	
<div data-role="content" data-theme="c" class= "asa">

<div class="content-primary">
	
<p><?php echo "Hello " . $user_profile['name'];echo "<br>"; ?></p>	
	
		
<?php if ($uid): ?>
    
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
      <br> <br>
    <?php else: ?>
    	<div data-role="button" id="playaudio" class="wider-btn" data-theme="c">
      
			<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
	    
		</div>			
					
	<?php endif;?> 
	<!--  <h3>PHP Session</h3>
	<pre><?php //print_r($_SESSION); ?></pre>
-->
    <?php if ($uid): ?>
      
	<img src="https://graph.facebook.com/<?php echo $uid; ?>/picture">

	<h3>Facebook Profile: </h3>
	<pre><?php
	
	global $database_fb;
	
	if ($uid) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api ( '/me' );
			echo "<hr>";
			$database_fb = "'". $user_profile['id'] ."', "; 
			"Facebook_ID: " . $user_profile['id'];//echo "<br>";
			
			$database_fb .=  "'". $user_profile['name']."', ";
			echo "Facebook_Name: " . $user_profile['name'];echo "<br>";
			
			$database_fb .= "'". $user_profile['link']."', ";
			"Facebook_Link: " . $user_profile['link'];//echo "<br>";
			
			
			//*************************************************
			$get_loc = $user_profile['location']; //echo "<br>";//ok Array
				
			if (!$get_loc){
				$get_loc = 0;
				$database_fb .= "'". $get_loc."', "; 
				"Facebook_Location: " . $get_loc; //echo "<br>";
			}
			
			else {
				foreach ($get_loc as $r){
					
						$get = $get_loc['name'];
						echo "Facebook_Location: " . $get;echo "<br>";
						$database_fb .= "'".$get."', ";
						break;
				}
			}
			//******************************************************
						
			$get_edu = $user_profile['education'];
			
			
			if (!$get_edu){
				$get_edu =0;
				"Facebook_Education: " . $get_edu; //echo "<br>";
			 	$database_fb .= "'".$get_edu."', "; 
			}
				
			else {
				foreach ($get_edu as $r=>$t){
					//for ($i=1; $i<2; $i++){
					$get = $get_edu[0]['type'];//['school']['name'];
					echo "Facebook_Education: " . $get;echo "<br>";
					$database_fb .= "'".$get."', ";
					break;
					//}
			
						
				}
			}
			
			//***********************************************
			
			$get_gender = $user_profile['gender'];
				
				
			if (!$get_gender){
				$get_gender = 0;
				"Facebook_Gender: " . $get_gender; //echo "<br>";
				$database_fb .= "'".$get_gender."', ";
			}
			
			else {
				//foreach ($get_gender as $r=>$t){
					//for ($i=1; $i<2; $i++){
					$get = $get_gender;
					echo "Facebook_Gender: " . $get;echo "<br>";
					$database_fb .= "'".$get."', ";
					//break;
					//}
						
			
				//}
			}
			
			//*********************************************************************
			
			$get_religion = $user_profile['religion'];
			
			
			if (!$get_religion){
				$get_religion = 0;
				"Facebook_Religion: " . $get_religion; //echo "<br>";
				$database_fb .= "'".$get_religion."', ";
			}
				
			else {
				//foreach ($get_religion as $r=>$t){
					//for ($i=1; $i<2; $i++){
					$get = $get_religion;
					echo "Facebook_Religion: " . $get;echo "<br>";
					$database_fb .= "'".$get."', ";
					//break;
					//}
			
						
				//}
			}
			
			
			//**********************************************************************	
			$get_political = $user_profile['political'];
				
				
			if (!$get_political){
				$get_political = 0;
				"Facebook_Political: " . $get_political; //echo "<br>";
				$database_fb .= "'".$get_political."', ";
			}
			
			else {
				//foreach ($get_political as $r=>$t){
					//for ($i=1; $i<2; $i++){
					$get = $get_political;
					echo "Facebook_Political: " . $get;echo "<br>";
					$database_fb .= "'".$get."', ";
					//break;
					//}
						
			
				//}
			}
			
			//*************************************************************************
			
			$get_work = $user_profile['work'];
				
				
			if (!$get_work){
				$get_work = 0;
				"Facebook_Work: " . $get_work; //echo "<br>";
				$database_fb .= "'".$get_work."', ";
			}
			
			else {
				foreach ($get_work as $r=>$t){
					//for ($i=1; $i<2; $i++){
					$get = $get_work[0]['position']['name'];
					echo "Facebook_Work: " . $get;echo "<br>";
					$database_fb .= "'".$get."', ";
					break;
					//}
						
			
				}
			}
			
			$get_lang = $user_profile['languages'];
			
			if (!$get_lang){
				$get_lang = 0;
				"Facebook_Languages: " . $get_lang; //echo "<br>";
				$database_fb .= "'".$get_lang."', ";
			}
	
			else {
				foreach ($user_profile['languages'] as $r=>$t){
					//for ($i=1; $i<2; $i++){
						$get = $t['name'];
						echo "Facebook_Languages: " . $get;echo "<br>";
						$database_fb .= "'".$get."', ";
						break;
					//}
					
						
				}
			}
	
	
			echo "<br>";
		} catch ( FacebookApiException $e ) {
			error_log ( $e );
			$user = null;
		}
	}
	
	
	
	//echo "<hr>";echo $database_fb;echo "<hr>";
					
					
						echo "<br>";
endif;?>
	</div>
	</div>
			
	</div><div data-role="footer" data-position="fixed" class="footer-docs" data-theme="b">
		<p>&copy; 2013 RunnerrZ Mobile Solutions</p>
		</div>
  </body>
</html>
			