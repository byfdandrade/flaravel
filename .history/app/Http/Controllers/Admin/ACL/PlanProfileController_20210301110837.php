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

        $profiles = $plan->profiles()->paginate();


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
            return redirect()->back()->with('info', 'Precisa escolher pelo um Perfil!');
        }


        dd($request->profiles);

        //Vinculando Perfil ao Plano
        $t = $this->plan->profiles()->attach($request->profiles);

        dd($t);
        return redirect()->route('plans.profiles', $plan->id);
    }



    public function detachProfilePlan($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }
}
