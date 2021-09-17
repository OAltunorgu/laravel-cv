<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolyoImage extends Model
{
    use HasFactory;
    protected $table = "portfolyos_images";
    protected $primaryKey = "id";
    protected $guarded = [];
}
