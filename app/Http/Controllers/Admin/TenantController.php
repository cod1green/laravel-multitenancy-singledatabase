<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Plan;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    protected Tenant $repository;
    protected Plan $plan;

    public function __construct(Tenant $tenant, Plan $plan)
    {
        $this->repository = $tenant;
        $this->plan = $plan;

        $this->middleware(['can:tenants']);
    }

    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $plans = $this->plan->latest()->get();
        return view('admin.pages.tenants.create', compact('plans'));
    }

    public function store(StoreUpdateTenant $request)
    {
        $plan = $this->plan->find($request->plan_id);

        $data = $request->all();
        $data['password'] = bcrypt(Str::random(8));

        $tenantService = app(TenantService::class);

        $user = $tenantService->make($plan, $data);

        return redirect()->route('tenants.index')->with('message', __('messages.store_success'));
    }

    public function show($id)
    {
        $tenant = $this->verifyTenant($id);

        $user = $tenant->users->first();

        return view('admin.pages.tenants.show', compact('tenant', 'user'));
    }

    public function verifyTenant($id)
    {
        if (!$tenant = $this->repository->with('categories')->find($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $tenant;
    }

    public function edit($id)
    {
        if (!$tenant = $this->repository->with('plan')->find($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        $plans = $this->plan->latest()->get();

        $user = $tenant->users->first();

        return view('admin.pages.tenants.edit', compact('tenant', 'user', 'plans'));
    }

    public function update(StoreUpdateTenant $request, $id)
    {
        $tenant = $this->verifyTenant($id);

        $data = $request->all();

        if ($request->hasFile('logo') && $request->logo->isValid()) {
            if (Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }

            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/logo");
        }

        $tenant->update($data);

        return redirect()->route('tenants.index')->with('message', __('messages.update_success'));
    }

    public function destroy($id)
    {
        $tenant = $this->verifyTenant($id);

        if (Storage::allDirectories("tenants/{$tenant->uuid}")) {
            // Storage::delete($tenant->logo);
            Storage::deleteDirectory("tenants/{$tenant->uuid}"); //deleta a pasta da empresa
        }

        $tenant->delete();

        return redirect()->route('tenants.index')->with('message', __('messages.delete_success'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $tenants = $this->repository->where(
            function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->filter}%");
            }
        )
            ->latest()
            ->paginate();

        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
