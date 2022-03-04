<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGroup;

class GroupController extends Controller
{
    public function __construct(Group $group)
    {
        $this->repository = $group;

        $this->middleware(['can:groups']);
    }

    protected $repository;

    public function index(Group $group)
    {
        $groups = $this->repository->paginate();

        return view('admin.pages.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.pages.groups.create');
    }

    public function store(StoreUpdateGroup $request)
    {
        $group = $this->repository->create($request->all());

        return redirect()
                        ->route('groups.index')
                        ->with('message', 'Registro Cadastrado com sucesso!');

    }

    public function show($id)
    {
        if (!$group = $this->repository->find($id)) {
            return redirect()->back()->with('success', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.groups.show', compact('group'));
    }

    public function edit($id)
    {
        if (!$group = $this->repository->find($id)) {
            return redirect()
                            ->back()
                            ->with('error', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.groups.edit', compact('group'));
    }

    public function update(StoreUpdateGroup $request, $id)
    {
        if (!$group = $this->repository->find($id)) {
            return redirect()
                            ->back()
                            ->with('error', 'Nenhum registro encontrado');
        }
        
        $group->update($request->all());

        return redirect()
                        ->route('groups.index')
                        ->with('message', 'Registro alterado com sucesso!');
    }

    public function destroy($id)
    {
        if(!$group = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado');
        }

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Registro deletado com sucesso!');
    }

    public function search (Request $request)
    {

        $filters = $request->only('filter');

        $groups = $this->repository
                            ->where(function($query) use ($request) {
                                if($request->filter) {
                                    $query->where('name', 'LIKE', "%{$request->filter}%")
                                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();
        
        return view('admin.pages.groups.index', compact('groups', 'filters'));
    }
}
