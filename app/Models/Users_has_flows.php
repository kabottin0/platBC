<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flow;

class Users_has_flows extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'flow_id'
    ];

public function Users()
{
    return $this->hasMany(Flow::class);
}

}
