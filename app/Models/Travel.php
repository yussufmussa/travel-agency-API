<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Travel extends Model
{
    use HasFactory, HasUuids, Sluggable;
    protected $table = 'travels';
    protected $fillable = ['is_public', 'name', 'slug', 'description', 'number_of_days'];
    

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function getNumberOfNightsAttribute()
    {
        return $this->number_of_days - 1;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
