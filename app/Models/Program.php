<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Program extends Model
{
    use HasFactory;
protected $fillable=[
    'title',
'slogan',
'price',
'discount',
'duration',
'limit',
'remain_place',
];
    // program has many benfit
    public function benfits(){
        return $this->hasMany(ProgramBenefit::class);
    }
    public function subscriptions(){
        return $this->hasMany(Subscribe::class);
    }
}
