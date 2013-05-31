<?php
header("Access-Control-Allow-Origin: *"); 
header("content-type: application/json"); 

$get = $_GET['sent'];
//$value = array("danny" => "saban");
//$value = $_GET['json'];

//$value = array("CTO" => array("name" => "danny saban"));
$jsonencoded = json_encode($get);

echo $jsonencoded;
//echo $_GET['callback'] . '{'.json_encode($value).'}';
//echo $_GET['callback'] .  $jsonencoded ;

