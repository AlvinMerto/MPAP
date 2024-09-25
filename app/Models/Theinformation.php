<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theinformation extends Model
{
    use HasFactory;

    protected $primaryKey = "otherinfoid ";
    protected $fillable   = ["theplace","htmlmap","theheader","thevalue"];
    protected $table      = "otherinfo";
}
