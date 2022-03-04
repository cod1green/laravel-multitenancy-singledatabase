<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware(['can:plans']);
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();
        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index')->with('message', __('messages.store_success'));
    }

    public function show($url)
    {
        $plan = $this->verifyPlan($url);

        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    /**
     * Verify Plan
     */
    public function verifyPlan($url)
    {
        if (!$plan = $this->repository->where('url', $url)->first()) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $plan;
    }

    public function edit($url)
    {
        $plan = $this->verifyPlan($url);

        return view('admin.pages.plans.edit', [
            'plan' => $plan
        ]);
    }

    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->verifyPlan($url);

        if($request->recommended == 1) {
            $r = $plan->where('recommended', 1)
                    ->update(['recommended' => 0]);
        }
        // dd($request->all());
        $plan->update($request->all());

        return redirect()->route('plans.index')->with('message', __('messages.update_success'));
    }

    public function destroy($url)
    {
        $plan = $this->repository
                        ->with('details')
                        ->where('url', $url)
                        ->first();

        if (!$plan)
            return redirect()->back();

        if ($plan->details->count() > 0) {
            return redirect()
                        ->back()
                        ->with('error', __('messages.impossible_remove_plan'));
        }

        $plan->delete();

        return redirect()->route('plans.index')->with('message', __('messages.delete_success'));
    }

    public function search(Request $request) {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
