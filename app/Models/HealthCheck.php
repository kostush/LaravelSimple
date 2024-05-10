<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner',
        'db',
        'cache',
    ];

    public function getDb()
    {
        return $this->attributes['db'];
    }

    public function getCache()
    {
        return $this->attributes['cache'];
    }

    public function getOwner()
    {
        return $this->attributes['owner'];
    }
}