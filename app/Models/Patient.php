<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medication;


class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','password','age','weight','health'];

    public function medications(){
        $this->belongsToMany(Medication::class);
    }

    public function users(){
        $this->belongsToMany(Medication::class);
    }

}
