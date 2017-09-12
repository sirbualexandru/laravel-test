<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;
    protected $table = 'categories';
    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];

    public function jobs()
    {
        return $this->hasMany(Jobs::class, 'category_id', 'id');
    }

}
