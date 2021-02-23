<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];


    //Relacionamento - Get Perfils
    public function profiles()
    {

        return $this->belongsToMany(Profile::class, 'permission_profile');
    }
}
