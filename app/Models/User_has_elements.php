<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_elements extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_has_flow_id',
        'u_steps_id',
        'label',
        'type',
        'value'
    ];

    public function Elements(){
        return $this->hasMany(Steps::class);
    }
}
