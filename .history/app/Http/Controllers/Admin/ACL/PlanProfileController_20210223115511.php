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
        # code...
    }


    public function profiles($idPlan)
{
    $plan = $this->plan->find($idPlan);

        if (!$plan) {
            return redirect()->back();
        }
    {
        $profiles = $this->plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }
}
