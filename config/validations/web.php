<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24.03.2017
 * Time: 15:52
 */

return [
	'profileEdit' => [
		'employer' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'phone'                     => 'required',
			'email'                     => 'required|email|unique:users,email',
			'password'                  => 'min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		],
		'candidate' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'phone'                     => 'required',
			'email'                     => 'required|email|unique:users,email',
			'password'                  => 'min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		],
	],
	'user' => [
		'create' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
            'username'                  => 'required|unique:users,username',
			'email'                     => 'required|email|unique:users,email',
			'password'                  => 'required|min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		],
		'update' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'email'                     => 'required|email|unique:users,email',
			'password'                  => 'min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		]
	],
	'category' => [
        'store' => [
            'name'                      => 'required|min:2|max:255|unique:categories,name',
        ],
        'update' => [
            'name'                      => 'required|min:2|max:255|unique:categories,name',
        ]
    ],
    'jobs' => [
        'store' => [
            'name'                      => 'required|string|max:255',
            'category_id'               => 'required|integer',
            'experience'                => 'required|string|max:255',
            'salary'                    => 'required|string|max:255',
            'description'               => 'string',
        ],
        'update' => [
            'name'                      => 'required|string|max:255',
            'category_id'               => 'required|integer',
            'experience'                => 'required|string|max:255',
            'salary'                    => 'required|string|max:255',
            'description'               => 'string',
        ]
    ],
];