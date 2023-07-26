<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elements extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'type',
        'value',
        'steps_id',
        'elements_id',
    ];

    public function Steps()
    {
        return $this->belongsTo(Steps::class);
    }


}
