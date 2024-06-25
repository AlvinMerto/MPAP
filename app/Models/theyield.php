<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theyield extends Model
{
    use HasFactory;

    protected $table = "theyields";
    protected $primaryKey = "yieldid";
    protected $fillable = [
        " invperarea_id","yield","year","created_at","updated_at"
    ];
}
