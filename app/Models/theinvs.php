<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theinvs extends Model
{
    use HasFactory;

    protected $table      = "theinvs";
    protected $primaryKey = "theinv_id";
    protected $fillable   = ["theinv_id","created_at","updated_at"];

    
}
