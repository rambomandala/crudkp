<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kosrambo;

class Kosan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at'];



    public function kosrambos(){
        return $this->belongsTo(Kosrambo::class,'id_kosrambos','id');
    }
}
