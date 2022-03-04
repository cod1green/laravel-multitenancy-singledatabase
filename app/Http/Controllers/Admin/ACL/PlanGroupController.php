<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanGroupController extends Controller
{
    protected $plan, $group;

    public function __construct(Plan $plan, Group $group)
    {
        $this->plan = $plan;
        $this->group = $group;

        $this->middleware(['can:plans']);
    }

    public function groups ($idPlan)
    {
        $plan = $this->verifyPlan($idPlan);

        $groups = $plan->groups()->paginate();

        return view('admin.pages.plans.groups.index', compact('plan', 'groups'));
    }

    public function groupsAvailable(Request $request, $idPlan)
    {
        $plan = $this->verifyPlan($idPlan);

        $filters = $request->except('_token');

        $groups = $plan->groupsAvailable($request->filter)->paginate();

        return view('admin.pages.plans.groups.available', compact('plan', 'groups', 'filters'));
    }

    public function planGroupsAttach(Request $request, $idPlan)
    {
        $plan = $this->verifyPlan($idPlan);

        $groups = $request->groups;

        if (!$groups || count($groups) == 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option'));
        }

        $plan->groups()->attach($groups);

        return redirect()->route('plans.groups', $plan->id)->with('message', __('messages.record_linked'));
    }

    public function planGroupsDetach ($idPlan, $idGroup)
    {
        $plan = $this->verifyPlan($idPlan);
        $group = $this->verifyGroup($idGroup);

        $group->plans()->detach($plan);

        return redirect()->route('plans.groups', $plan->id)->with('message', __('messages.record_unlinked'));
    }

    public function verifyPlan($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $plan;
    }

    public function verifyGroup($idGroup)
    {
        if (!$group = $this->group->find($idGroup)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $group;
    }
}