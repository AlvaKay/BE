<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histories extends Model
{
    use HasFactory;
    protected $table = "histories";
    protected $primaryKey = 'history_id'; // Tên cột khóa chính
    
    

}