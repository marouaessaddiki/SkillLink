<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'mission_id',
        'freelance_id',
        'cover_letter',
        'status',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function freelance()
    {
        return $this->belongsTo(User::class, 'freelance_id');
    }
}