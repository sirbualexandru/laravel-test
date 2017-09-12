<?php

Route::auth();

Route::group(['middleware' => 'auth'], function() {

	Route::get('/', 'HomeController@index');

	Route::get('/profile/edit'				    	, 'UserController@profileEdit');
	Route::post('/profile/update'			    	, 'UserController@profileUpdate');

	Route::group(['middleware' => ['role:candidate']], function() {
		// Jobs
		Route::get('/jobs/{id}/see'		, 'JobsController@seeJob');
		Route::post('/jobs/apply'		, 'JobsController@applyForJob');
	});

	Route::group(['middleware' => ['role:employer']], function() {
		// Categories
		Route::post('/categories/datatable'		, 'CategoryController@datatable');
		Route::resource('/categories'		    , 'CategoryController', ['except' => ['show']]);

		// Candidates
		Route::get('/candidates/{id}/see_candidate'	, 'CandidateController@seeCandidate');
		Route::get('/candidates/{id}/see_job'		, 'CandidateController@seeJob');
		Route::post('/candidates/datatable'			, 'CandidateController@datatable');
		Route::resource('/candidates'		    	, 'CandidateController', ['except' => ['show']]);

		// Jobs
        Route::post('/jobs/save_hour'	, 'JobsController@saveHour');
        Route::post('/jobs/update_hour'	, 'JobsController@updateHour');
        Route::post('/jobs/delete_hour'	, 'JobsController@deleteHour');
        Route::post('/jobs/{id}/update'	, 'JobsController@update');
	});

	// Jobs
	Route::post('/jobs/datatable'	, 'JobsController@datatable');
    Route::resource('/jobs'			, 'JobsController', ['except' => ['show']]);



});
