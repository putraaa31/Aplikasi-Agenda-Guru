<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = "kelas";
    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }
}
