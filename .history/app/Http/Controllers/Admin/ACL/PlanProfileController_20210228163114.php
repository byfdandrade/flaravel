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



    public function profilesAvailable(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);


        if (!$plan) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }


    public function attachProfilesPlan(Request $request, $idPlan)
    {
        $plan = $this->profile->find($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()->with('info', 'Precisa escolher pelo um Plano!');
        }

        //Vinculando Perfil ao Plano
        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }


    public function detachPermissionProfile($idProfile, $idPlan)
    {
        $profile = $this->profile->find($idProfile);
        $plan = $this->plan->find($idPlan);

        if (!$profile || !$plan) {
            return redirect()->back()->with('info', 'Oops, Perfil ou Permissão não encontradas!');
        }

        //Desvincula as permissões do Perfil
        $profile->permissions()->detach($profile);

        return redirect()->route('plans.profiles', $profile->id)->with('success', 'Desvinculado com Sucesso!');
    }
}
