<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignSkills extends Model
{
    use HasFactory;

    protected $table = "design_skills";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function scopeStatusActive($query){
        return $query->where('status',1);
    }
}
