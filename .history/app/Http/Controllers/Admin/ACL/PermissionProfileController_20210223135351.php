<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{

    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }


    //Lista as permissões de um Perfil
    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        dd($profile->attributes());

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }


    //Lista os Perfils vinculados a uma Permissão
    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }


    public function permissionsAvailable(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);


        if (!$profile) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }


    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('info', 'Precisa escolher pelo menos uma permissão!');
        }

        //Vinculando permissões ao Perfil
        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }


    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back()->with('info', 'Oops, Perfil ou Permissão não encontradas!');
        }

        //Desvincula as permissões do Perfil
        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id)->with('success', 'Desvinculado com Sucesso!');
    }
}
