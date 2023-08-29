<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function medications(){
        $this->belongsToMany(Medication::class);
    }

    public function userss(){
        $this->belongsToMany(Medication::class);
    }

}
