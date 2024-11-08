<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanism extends Model
{
    protected $fillable = [
        'planning',
        'design',
        'installation',
        'testing',
        'monitoring'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'mechanism_id', 'id');
    }
}
