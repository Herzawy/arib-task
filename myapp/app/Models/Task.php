<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'employee_id', 'task_name', 'task_status','task_description','due_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}