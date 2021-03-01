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
}
