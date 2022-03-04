<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected Role $repository;

    public function __construct(Role $repository)
    {
        $this->repository = $repository;

        $this->middleware(['can:roles']);
    }

    public function index(): View
    {
        $roles = $this->repository->latest()->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('admin.pages.roles.create');
    }

    public function store(StoreUpdateRole $request): RedirectResponse
    {
        $role = $this->repository->create($request->all());

        return redirect()->route('roles.index')->with('message', __('messages.store_success'));
    }

    public function show($id): View
    {
        $role = $this->verifyRole($id);

        return view('admin.pages.roles.show', compact('role'));
    }

    public function verifyRole($id): RedirectResponse
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $role;
    }

    public function edit($id): View
    {
        $role = $this->verifyRole($id);

        return view('admin.pages.roles.edit', compact('role'));
    }

    public function update(StoreUpdateRole $request, $id): RedirectResponse
    {
        $role = $this->verifyRole($id);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', __('messages.update_success'));
    }

    public function destroy($id): RedirectResponse
    {
        $role = $this->verifyRole($id);

        $role->delete();

        return redirect()->route('roles.index')->with('success', __('messages.delete_success'));
    }

    public function search(Request $request): View
    {
        $filters = $request->except('_token');

        $roles = $this->repository->where(
            function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->filter}%");
                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        )
            ->latest()
            ->paginate();

        return view('admin.pages.roles.index', compact('roles', 'filters'));
    }
}
