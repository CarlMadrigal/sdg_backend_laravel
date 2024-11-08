<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'initiator',
        'leader',
        'members'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'subject_id', 'id');
    }
}
