<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherinfo extends Model
{
    use HasFactory;

    protected $table      = "otherinfo";
    protected $primaryKey = "otherinfoid";
    protected $fillable   = [
        "theplace","htmlmap","theheader","thevalue","created_at","updated_at"
    ];
}
