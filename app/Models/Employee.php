<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'position',
        'department', 'phone', 'is_admin'
    ];

    protected $hidden = ['password'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'employee_product');
    }
}
