<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'human',
        'financial',
        'technical'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'resources_id', 'id');
    }
}
