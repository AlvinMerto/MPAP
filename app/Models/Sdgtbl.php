<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdgtbl extends Model
{
    use HasFactory;

    protected $table      = "sdg";
    protected $primaryKey = "sdgid";

    protected $fillable   = ["thesdg","sdg_num"];
    
}
