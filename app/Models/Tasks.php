<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'long_Description',
        'priority',
        'completed',
        'start_date'
    ];

    public function user() {
        return $this->BelongTo(User::class,'user_id');
    }

    public function categories(){
        return $this->HasMany(Categories::class,'task_categories','tasks_id','categories_id');
    }
}
