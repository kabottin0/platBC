<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Steps extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'flow_id'       
        
    ];



    public function Flow()
    {
        return $this->belongsTo(Flow::class);
    }

    public function Elements()
    {
        return $this->hasMany(Elements::class);
    }



}
