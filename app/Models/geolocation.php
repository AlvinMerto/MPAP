<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class geolocation extends Model
{
    use HasFactory;

    protected $primaryKey = "geolocationid";
    protected $fillable   = [
        "master_dataid","lat","lng","columnplace","updated_at","created_at"
    ];
    protected $table      = "geolocation";
}
