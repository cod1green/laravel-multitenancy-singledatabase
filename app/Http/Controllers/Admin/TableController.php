<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    protected $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;

        $this->middleware(['can:tables']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->paginate();
        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateTable  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        $table = $this->repository->create($request->all());

        return redirect()->route('tables.index')->with('message', __('messages.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = $this->repository->find($id);

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = $this->verifyTable($id);

        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateTable  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        $table = $this->verifyTable($id);
        $table->update($request->all());

        return redirect()->route('tables.index')->with('message', __('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = $this->verifyTable($id);
        $table->delete();

        return redirect()->route('tables.index')->with('message', __('messages.delete_success'));
    }

    public function qrcode($idTable)
    {
        $table = $this->verifyTable($idTable);

        $tenant = auth()->user()->tenant;
        $uri = env('URI_CLIENT') . "/{$tenant->uuid}/{$table->uuid}";

        $qrcode = QrCode::size(300)->generate($uri);

        return view('admin.pages.tables.qrcode', compact('uri','qrcode'));
    }

    public function search(Request $request) {
        
        $filters = $request->except('_token');

        $tables = $this->repository->search($request->filter)->paginate();

        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }

    public function verifyTable($id) {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $table;
    }
}
