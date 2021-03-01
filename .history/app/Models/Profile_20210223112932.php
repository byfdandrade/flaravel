<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];


    //Relacionamento - Get Permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    //Busca as Permissões não vinculadas ao Perfil
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })->where(function ($queryFilter) use ($filter) {
            if ($queryFilter) {
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            }
        })->paginate();

        return $permissions;
    }

    //Relacionamento - Get Planos
    public function plans()
    {
       return $this=>BelongsToMany(Plan::class);
    }

}
