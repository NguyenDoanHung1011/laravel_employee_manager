<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['name', 'description', 'deleted'];

    // Quan hệ với User
    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
