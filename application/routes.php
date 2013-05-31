<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
  ---------------------------------------------------------------------*/


//Route::controller('home');
//Route::controller('facebook');
//Route::controller('nike');
//Route::controller('users');

Route::controller(Controller::detect());

Route::post('test', 'home@test');
Route::post('/', 'facebook@index');

Route::get('/', 'facebook@index' );
Route::get('me', 'facebook@me' );

Route::get('user', 'user@index');
Route::get('nike', 'nike@index');
Route::get('users', 'users@index');
Route::get('all', 'users@all');
Route::get('location', 'users@location');


//Route::get('/', function (){	
//return Response::json(array('name' => 'Batman'));});



/*
Route::resource('offices', 'OfficesController');
Route::post('offices/store', 'OfficesController@postStore');
Route::get('offices/edit/{id}', 'OfficesController@edit');
Route::post('offices/update/{id}', 'OfficesController@postUpdate');
Route::get('offices/destroy/{id}', 'OfficesController@getDestroy');
*/




Route::get('title', function(){
	

	
$users = new Title();
$cursors = $users->_get();


echo "<br>";

foreach ($cursors as $c){
	//print_r($c);//1 book
	$my = get_object_vars($c);
	echo "<br>";
	
	$cursor = $my['attributes'];
	
	$_oneBook = Array($cursor["author"], $cursor["title"]); 
	print_r($_oneBook[0]." -- ".$_oneBook[1]);
	
	
	
	//$_allBooks .= $_oneBook;
	//$_allBooks;//$_allBooks .= $_oneBooks;
	echo json_encode($cursor);
	echo "<br>";
	//return View::make('mongo.title')->with('users', $get);
	
	//$_allBooks .= $_oneBook;
}

//print_r($_allBooks);

return View::make('mongo.title')->with('users', 'end of data');
//return View::make('mongo.title', Array('users'=> $get) );
//return View::make('mongo.title')->with('users', $my);
//echo $cursors['title'];

 //connect to mongoDB
  

// connect
//$m = new MongoClient();

// select a database
//$db = $m->test;

// select a collection (analogous to a relational database's table)
//$collection = $db->mytest;
//$collection2 = $db->mytest2;
//$collection3 = $db->authors;
//$collection3 = $db->titles;


// add a record
//$document = array( "title" => "Linux OS", "author" => "maldorn joe" );
//$document2 = array( "title" => "Ajax for start", "author" => "coraso gampole" );
//$document3 = array( "title" => "mySQL2", "author" => "joe daleen" );
//$document4 = array( "title" => "couchDB", "author" => "steev halow" );
//$document5 = array( "title" => "PHP for XML", "author" => "pual foln" );
//$document6 = array( "title" => "Perl", "author" => "jimmy tokal" );

/*
$collection3->insert($document);
$collection3->insert($document1);
$collection3->insert($document2);
$collection3->insert($document3);
$collection3->insert($document4);
$collection3->insert($document5);
 */

// find everything in the collection
//$cursors = $collection3->find();



	
	//return View::make('mongo.title')->with('users', $mycr);
});



		
		
Route::post('test', function () {
	$actor = Input::get('name');//dd($_POST);
//return base_convert(rand(18918,23000), 10 ,36);
 
 	$name = Actor::where('first_name', '=', $actor)->only('last_name');
 	
 if ($name){	
 	return $name;
 }
	
		return 'no such name in database!';
			
	//dd($record);
});


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});