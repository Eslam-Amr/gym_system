<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramBenefit extends Model
{
    use HasFactory;
    protected $fillable=['program_id'
    ,'benfit'];

    //benfit belong to single program
    public function program(){
        return $this->belongsTo(Program::class);
    }
}
