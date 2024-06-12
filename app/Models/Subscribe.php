<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscribe extends Model
{
    use HasFactory;
    protected $fillable=['program_id','user_id','to','nutrition_id'];
public function user(){
    return $this->belongsTo(User::class);
}
public function nutrition(){
    return $this->belongsTo(Nutrition::class);
}
public function program(){
    return $this->belongsTo(Program::class);
}
}

