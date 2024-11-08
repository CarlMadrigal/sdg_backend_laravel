<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $fillable = [
        'nature',
        'industry',
        'government'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'environment_id', 'id');
    }
}
