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


//Show all the query
/*
  Event::listen('illuminate.query', function($query)
 {
	var_dump($query);
  });
*/


Route::get('/',function(){

 if(Auth::check() && Auth::user()->userInfo->owner_approve== 1){


	 return Redirect::route('dashboard');
 }
 elseif(Auth::check() && Auth::user()->userInfo->owner_approve== 0){
	 return Redirect::route('user.show');
 }

	else
		return Redirect::route('index');
});


   Route::get('contact',['as'=>'contact','uses'=>'ContactController@viewContact']);
   Route::post('contact','ContactController@getContactUsForm');

Route::group(['before' => 'guest'], function(){


	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'AuthController@login']);
	Route::post('login', array('uses' => 'AuthController@doLogin'));
	Route::get('register',['as'=>'user.create','uses'=>'UserController@create']);
	Route::post('register',['as'=>'user.store','uses'=>'UserController@store']);
	Route::get('register/activation/{key}',['uses'=>'ActivationController@activate']);
	Route::get('activationRequest', ['as'=>'activationRequest', 'uses'=>'ActivationController@viewActivationRequest']);
	Route::post('sendActivationLink',['as'=>'sendActivationLink','uses'=>'ActivationController@sendActivationLink']);
	Route::get('index', array('as' => 'index', 'uses' => 'HomeController@home'));
});




Route::group(array('before' => 'auth'), function()
{
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'AuthController@dashboard'));
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'AuthController@doChangePassword'));
	Route::get('profile', ['as'=>'user.show', 'uses'=>'UserController@show']);
	Route::get('user-profile/{id}', ['as'=>'user.allShow', 'uses'=>'UserController@allShow']);
	Route::get('edit-profile',['as'=>'user.edit', 'uses'=>'UserController@edit']);
	Route::post('update-profile',['as'=>'user.update', 'uses'=>'UserController@update']);
	Route::get('upload-avatar',['as'=>'upload.avatar', 'uses'=>'UserController@uploadAvatarForm']);
	Route::post('upload-avatar',['as'=>'upload.avatar', 'uses'=>'UserController@uploadAvatar']);


	Route::get('logs',['as'=> 'log.index','uses'=>'LoggersController@index']);
	Route::get('log/create',['as'=> 'log.create','uses'=>'LoggersController@create']);
	Route::post('log',['as'=> 'log.store','uses'=>'LoggersController@store']);
	Route::get('log/{id}/edit',['as'=> 'log.edit','uses'=>'LoggersController@edit']);
	Route::put('log/{id}',['as'=> 'log.update','uses'=>'LoggersController@update']);
	Route::delete('logs/{id}',['as'=> 'log.delete','uses'=>'LoggersController@destroy']);
	Route::get('logs/show/{id}',['as'=> 'log.show','uses'=>'LoggersController@show']);
	Route::get('logs/all',['as'=> 'log.all','uses'=>'LoggersController@allShow']);

	//finance
	Route::get('myfinance',['as' => 'finance.index.normal', 'uses' => 'MoneyController@index_normal']);


   //My flat members
	Route::get('flat-members',['as' => 'flats.members', 'uses' => 'UserController@member']);


	Route::get('messages', ['as' => 'messages', 'uses' => 'MessagesController@index']);
	Route::get('messages/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
	Route::post('messages/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
	Route::get('messages/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
	Route::put('messages/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
	Route::get('Messages/{id}', ['as' => 'messages.all', 'uses' => 'MessagesController@all']);


});



Route::group(array('before' => 'auth|admin'), function()
{
	// members
	Route::get('members', array('as' => 'members', 'uses' => 'MemberController@index'));
	Route::get('view-allOwner', array('as' => 'members.view.distributor', 'uses' => 'MemberController@viewDistributor'));
	Route::get('view-Members', array('as' => 'members.view.client', 'uses' => 'MemberController@viewClient'));
	Route::get('members/add/{id}', array('as' => 'members.add', 'uses' => 'MemberController@acceptManager'));
	Route::get('members/{id}', array('as' => 'members.delete', 'uses' => 'MemberController@userDelete'));
	Route::get('view-member/{id}', array('as' => 'client.delete', 'uses' => 'MemberController@clientDelete'));
	Route::get('view-owner/{id}', array('as' => 'owner.delete', 'uses' => 'MemberController@ownerDelete'));


	Route::get('issuedepts',['as' => 'issuedept.index', 'uses' => 'IssueDeptsController@index']);
	Route::get('issuedept/create',['as' => 'issuedept.create', 'uses' => 'IssueDeptsController@create']);
	Route::post('issuedepts',['as' => 'issuedept.store', 'uses' => 'IssueDeptsController@store']);
	Route::get('issuedept/{id}/edit',['as' => 'issuedept.edit', 'uses' => 'IssueDeptsController@edit']);
	Route::put('issuedept/{id}',['as' => 'issuedept.update', 'uses' => 'IssueDeptsController@update']);
	Route::delete('issuedepts/{id}',['as' => 'issuedept.delete', 'uses' => 'IssueDeptsController@destroy']);


   //Flat Based Finance Module
	Route::get('finance',['as' => 'finance.index', 'uses' => 'MoneyController@index']);
	Route::get('finance/list',['as' => 'finance.list', 'uses' => 'MoneyController@devlist']);
	Route::get('finance/show/{id}',['as' => 'finance.show', 'uses' => 'MoneyController@show']);
	Route::get('finance/create',['as' => 'finance.create', 'uses' => 'MoneyController@create']);
	Route::post('finance',['as' => 'finance.store', 'uses' => 'MoneyController@store']);


	Route::get('announces',['as' => 'announces.index', 'uses' => 'AnnouncesController@index']);
	Route::get('announces/create',['as' => 'announces.create', 'uses' => 'AnnouncesController@create']);
	Route::post('announces',['as' => 'announces.store', 'uses' => 'AnnouncesController@store']);
	Route::get('announces/{id}/edit',['as' => 'announces.edit', 'uses' => 'AnnouncesController@edit']);
	Route::put('announces/{id}',['as' => 'announces.update', 'uses' => 'AnnouncesController@update']);
	Route::delete('announces/{id}',['as' => 'announces.delete', 'uses' => 'AnnouncesController@destroy']);


	Route::get('flats',['as' => 'flats.index', 'uses' => 'FlatsController@index']);
	Route::get('flats/create',['as' => 'flats.create', 'uses' => 'FlatsController@create']);
	Route::post('flats',['as' => 'flats.store', 'uses' => 'FlatsController@store']);
	Route::get('flats/{id}/edit',['as' => 'flats.edit', 'uses' => 'FlatsController@edit']);
	Route::put('flats/{id}',['as' => 'flats.update', 'uses' => 'FlatsController@update']);
	Route::delete('flats/{id}',['as' => 'flats.delete', 'uses' => 'FlatsController@destroy']);
	//payment from flat page
	Route::get('flats/{id}/payment',['as' => 'flats.payment', 'uses' => 'FlatsController@paymentVerification']);


	//all members
	Route::get('all-members',['as' => 'flats.allMembers', 'uses' => 'UserController@allMember']);
	//Route::get('flat-members',['as' => 'flats.members', 'uses' => 'UserController@flatMember']);

	Route::get('1', 'UserInfoController@getIndex');
	Route::get('api', 'UserInfoController@getApi');

	//terms and condition
	Route::get('terms/edit',['as' => 'terms.edit', 'uses' => 'TermsController@edit']);
	Route::put('terms/update',['as' => 'terms.update', 'uses' => 'TermsController@update']);

	// sending mail later
	Route::get('mailInTime',['as' => 'mail.create', 'uses' => 'MailController@create']);
	Route::post('mailSend',['as' => 'mail.send', 'uses' => 'MailController@mailSender']);


});
	//terms of Condition
	Route::get('termsOfConditions',['as' => 'terms.index', 'uses' => 'TermsController@index']);

	//Route::group(array('before' => 'owner'), function(){
	Route::get('waitingMember',['as' => 'manager.index', 'uses' => 'ManagerController@waitingMember']);
    Route::get('members/add/{id}', array('as' => 'members.add', 'uses' => 'ManagerController@acceptMember'));
	//});



	//for unknown url
	Route::get('missing',['as' => 'error.404', 'uses' => 'HomeController@missing']);
    Route::get('errors',['as' => 'error.500', 'uses' => 'HomeController@error']);


	 // for user accept mail sending
	Route::get("sendmail/{key}",['as'=>'mail.varification','uses'=>'MemberController@varifyMail']);
	Route::get("recover/{key}",['as'=>'mail.recovery','uses'=>'MemberController@mailRecover']);


	//Notifications
	Route::get('notification',['as' => 'notifications.index', 'uses' => 'NotificationsController@admin']);
	Route::get('notification',['as' => 'notifications.manager', 'uses' => 'NotificationsController@manager']);
	Route::get('notification',['as' => 'notifications.user', 'uses' => 'NotificationsController@user']);




	Route::get('time',function(){
		return $countNoti = Notification::where('type','=','money')
		->orWhere('type','=','announce')
		->count();

	});











//php artisan migrate --package=cmgmyr/messenger
//php artisan config:publish cmgmyr/messenger
