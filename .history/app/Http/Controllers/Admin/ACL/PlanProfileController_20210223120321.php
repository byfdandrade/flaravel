<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
    }


    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $profiles = $this->plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
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
