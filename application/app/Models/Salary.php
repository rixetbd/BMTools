<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    function getEmpName(){
        return $this->belongsTo(Employee::class, 'emp_id')->withDefault([
            'id' => '',
            'name' => 'N/A',
        ]);
    }
}
