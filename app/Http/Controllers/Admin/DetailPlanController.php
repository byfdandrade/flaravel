<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {

        //Busca o Plano pela URL
        $plan = $this->plan->where('url', $urlPlan)->first();

        if (!$plan) {
            return redirect()->back();
        }

        // $details = $plan->details();
        $details = $plan->details()->paginate();
        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }


    public function create($urlPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        if (!$plan) {
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,

        ]);
    }


    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        if (!$plan) {
            return redirect()->back();
        }
        //$data = $request->all();
        // $data['plan_id'] = $plan->id;
        // $this->repository->create($data);
        // Ou assim

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }


    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }


    public function edit($urlPlan, $idDetail)
    {

        $plan = $this->plan->where('url', $urlPlan)->first();

        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }


    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }


    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('details.plan.index', $plan->url)
            ->with('message', 'Registro deletado com Sucesso!');
    }
}
