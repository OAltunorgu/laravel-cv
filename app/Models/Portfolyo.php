<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolyo extends Model
{
    use HasFactory;
    protected $table = "portfolyos";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function featuredImage(){
        return $this->hasOne('App\Models\PortfolyoImage', 'portfolyo_id', 'id')
            ->where('featured', 1);
    }
    public function images()
    {
        return $this->hasMany('App\Models\PortfolyoImage', 'portfolyo_id','id');
    }
}
