<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [ 
        'client_id',
         'title',
          'description',
           'budget', 'deadline', 
           'status',
            ];
            public function client() 
            { 
                return $this->belongsTo(User::class, 'client_id');
                 }
                  public function applications()
    {
        return $this->hasMany(Application::class);
    }
    //
}
