<?php

namespace App\Models;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $fillable = [
        'category'
    ];
    public function tasks(){
        return $this->BelongToMany(Tasks::class,'task_categories','categories_id','tasks_id');
    }
}
