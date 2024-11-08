<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'tags_id', 'id');
    }
}
