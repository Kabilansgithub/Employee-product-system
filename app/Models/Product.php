<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description'];

    public function employees()
{
    return $this->belongsToMany(Employee::class)
                ->withPivot('capable_from')
                ->withTimestamps();
}


    // public function employees()
    // {
    //     return $this->belongsToMany(Employee::class, 'employee_product');
    // }
}
