@layout('nike')
@section('header')
@endsection
@section('nike')
<?php 
require_once 'application/libraries/nike.blade.php';

$n = new NikePlusPHP('dannysaban@gmail.com', '22691711Danny');



 print_r($my = get_object_vars($n));
 echo "<hr>"; 
 print_r($my['loginCookies']);
 echo "<hr>";
 print_r($my['userId']);
 echo "<hr>";
 var_dump($activity = $my["allTime"]);
 echo "<hr>"; 
 //foreach ($activity as $m){
 print_r($myactive = get_object_vars($activity)); 
  echo "<hr>"; 
 print_r($myactive2 = get_object_vars($myactive['lifetimeTotals']));
 //}
 
?>
@endsection

