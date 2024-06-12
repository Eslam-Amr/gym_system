<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nutrition extends Model
{
    use HasFactory;

    protected $table='nutritions';
    protected $fillable=['user_id','program_id','plan'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function program(){
        return $this->belongsTo(Program::class);
    }
}
