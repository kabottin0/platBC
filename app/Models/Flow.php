<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message'
        
    ];

    public function Steps(){

        return $this->hasMany(Steps::class);
    }







}
