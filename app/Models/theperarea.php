<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theperarea extends Model
{
    use HasFactory;

    protected $table      = "theperareas";
    protected $primaryKey = "invperarea_id";
    protected $fillable   = ["areaid","theinv_id","created_at","updated_at"];

    function theinvestments() {
        return $this->hasMany(theinvs::class,"theinv_id","theinv_id");
    }

    function theyields() {
        return $this->hasMany(theyield::class,"invperarea_id","theinv_id");
    }
}
