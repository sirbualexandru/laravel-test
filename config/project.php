<?php

return [

	/**
	 * Name of the application
	 */
	'name' => env('APP_NAME', 'My APP'),

	/**
	 * Date format used in output for datatables
	 *
	 * Must be a valid SQL date format string
	 */
	'date_format'   => '%d %M %Y %H:%i',
	'datepicker'	=> 'yy-mm-dd',
	'formatAPI'		=> 'U',
	'formatUI'      => 'Y-m-d',
	'uploadPath'	=> 'uploads/',
	'faIconsPath'	=> 'fa-icons/png/256/',
	
	//TODO Change Links
	'sociallinks'	=> array(
		'facebook'	=> 'http://www.facebook.com/',
		'twitter'	=> 'http://twitter.com/?lang=en',
		'google'	=> 'http://plus.google.com/'
	),
	'contcat_info' => array(
		'email' => 'myapp@gmail.com',
		'phone' => '+39 0536 941 018',
		'site'	=> 'www.myapp.com',
	),

	'terms_link'	=> '',
	'privacy_link'	=> '',

	'recovery_email_subject'	=> 'hello'
];