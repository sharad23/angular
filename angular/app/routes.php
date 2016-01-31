<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/login',function(){
    
       return View::make('login');
});
Route::post('/login',function(){
    
        if(Auth::attempt(array('username'=>$_POST['username'],'password'=>$_POST['password']))) {
						
				return Redirect::to('/')->with('success', 'You are now logged in.');
		 } 
		 else 
		 {
				return Redirect::to('/login');
		 }

});
//Route::group(array('before' =>'auth'), function()
//{
	Route::get('/', function()
	{
		return View::make('hello');
		
	});
	Route::resource('users', 'UsersController');
	Route::resource('transactions', 'TransactionsController');
	Route::post('validate-user','UsersController@validate');
	Route::get('/logout',function(){

            Auth::logout();
            
	});
	Route::get('/test','TransactionsController@test');
	Route::resource('people', 'PeopleController');
    Route::get('/data-user/{id}/{page}/{limit}/{search?}','UsersController@dataTable');
	


//});
