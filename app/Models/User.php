<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
	use SoftDeletes, EntrustUserTrait {
		SoftDeletes::restore insteadof EntrustUserTrait;
		EntrustUserTrait::restore insteadof SoftDeletes;
	}

	const USER_STATUS_UNACTIVE  = 0;
	const USER_STATUS_ACTIVE    = 1;

	public $timestamps	= true;

	protected $table	= 'users';

	protected $fillable = [
		'first_name',
		'last_name',
        'username',
		'phone',
		'email',
		'address',
		'experience',
		'skills_description',
		'wanted_salary',
		'remember_token',
        'password'
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function created_jobs()
    {
        return $this->hasMany(Jobs::class, 'user_id', 'id');
    }

    public function applied_jobs()
    {
        //return $this->belongsToMany(Jobs::class);
        return $this->belongsToMany(Jobs::class, 'applied_jobs', 'user_id', 'job_id');
    }

}