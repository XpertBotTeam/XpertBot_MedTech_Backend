<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = ['dose', 'frequency', 'reminder-time', 'prescription', 'user-id', 'patient-id', 'medicine-id'];



    public function users()
    {
        $this->belongsToMany(User::class);
    }

    public function patients()
    {
        $this->belongsToMany(Patient::class);
    }

    public function medicines()
    {
        $this->belongsToMany(Medicine::class);
    }
}
