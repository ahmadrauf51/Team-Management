<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'duration', 'difficulty'
    ];

    public function developers()
    {
        return $this->belongsToMany(Developer::class,'developer_tasks');
    }
}
