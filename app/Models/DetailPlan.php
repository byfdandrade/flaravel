<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{

    protected $table = 'detail_plans';
    protected $fillable = ['name'];

    //Relacionamento - belongsTo => Muitos para um (n:1)
    public function plan(){

        $this->belongsTo(Plan::class);

    }

}
