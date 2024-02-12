<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['slug', 'thumb', 'technologies'];

    //relazione con type
    //singolare perchè ha solo un type
    public function type()
    {
        //ha solo un type
        return $this->belongsTo(Type::class);
    }

    //relazione con technology via tabella pivot
    //plurale perchè puo a vere + technology
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
