<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'tags_id',
        'subject_id',
        'environment_id',
        'resources_id',
        'mechanism_id',
        'title',
        'logo',
        'description',
        'abstract',
        'overview',
        'image',
        'objectives',
        'content',
        'waypoint',
        'launched',
        'proponent',
        'progress',
        'problems',
        'solutions',
        'completion',
        'impact',
        'output',
        'costing',
        'future',
    ];

    public function tag(){
        return $this->hasOne(Tag::class);
    }

    public function subject(){
        return $this->hasOne(Subject::class);
    }

    public function environment(){
        return $this->hasOne(Environment::class);
    }

    public function resource(){
        return $this->hasOne(Resource::class);
    }

    public function mechanism(){
        return $this->hasOne(Mechanism::class);
    }
}
