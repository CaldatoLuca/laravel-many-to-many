<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded = ['slug'];


    //nome plurale perchè ha piu projects
    public function projects()
    {
        // ha tanti projects
        return $this->hasMany(Project::class);
    }
}
