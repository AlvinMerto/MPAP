<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class themap extends Model
{
    use HasFactory;

    protected $table      = "themaps"; 
    protected $primaryKey = "areaid";
    protected $fillable   = ["thearea","latitude","longitude","created_at","updated_at"];

}
