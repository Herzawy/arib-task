<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'image',
        'manager_name',
        'department_id',
        'manager_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }
}