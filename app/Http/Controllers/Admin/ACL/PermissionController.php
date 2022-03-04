<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    protected Permission $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permissions']);
    }

    public function index(): View
    {
        $permissions = $this->repository->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('admin.pages.permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro cadastrado com sucesso!');
    }

    public function show($id): View
    {
        $permission = $this->verifyPermission($id);

        return view('admin.pages.permissions.show', compact('permission'));
    }

    public function verifyPermission($id): RedirectResponse
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        return $permission;
    }

    public function edit($id): View
    {
        $permission = $this->verifyPermission($id);

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $permission = $this->verifyPermission($id);

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro cadastrado com sucesso!');
    }

    public function destroy($id): RedirectResponse
    {
        $permission = $this->verifyPermission($id);

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Registro cadastrado com sucesso!');
    }

    public function search(Request $request): RedirectResponse|View
    {
        $filters = $request->only('filter');

        if (!$permissions = $this->repository->search($request->filter)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
