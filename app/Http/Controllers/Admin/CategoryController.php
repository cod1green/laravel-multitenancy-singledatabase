<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;

        $this->middleware(['can:categories']);
    }

    public function index()
    {
        $categories = $this->repository->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('categories.index')->with('message', __('messages.store_success'));
    }

    public function show($id)
    {
        $category = $this->verifyCategory($id);

        return view('admin.pages.categories.show', compact('category'));
    }

    public function verifyCategory($id)
    {
        if (!$category = $this->repository->findOrFail($id)) {
            return redirect()->back()->with('error',  __('messages.empty_register'));
        }

        return $category;
    }

    public function edit($id)
    {
        $category = $this->verifyCategory($id);

        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(StoreUpdateCategory $request, $id)
    {
        $category = $this->verifyCategory($id);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('message', __('messages.update_success'));
    }

    public function destroy($id)
    {
        $category = $this->verifyCategory($id);

        $category->delete();

        return redirect()->route('categories.index')->with('message', __('messages.delete_success'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $categories = $this->repository->search($request->filter)->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
