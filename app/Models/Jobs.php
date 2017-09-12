<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $timestamps = true;
    protected $table = 'jobs';
    protected $fillable = ['name', 'experience', 'salary', 'description'];
    protected $dates = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function candidates()
    {
        return $this->belongsToMany(User::class, 'applied_jobs', 'job_id','user_id');
    }
}
