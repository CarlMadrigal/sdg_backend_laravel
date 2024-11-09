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
        'waypoints',
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

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tags_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class, 'environment_id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resources_id');
    }

    public function mechanism()
    {
        return $this->belongsTo(Mechanism::class, 'mechanism_id');
    }
}
