<?php

namespace App\Http\Controllers\simrs\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\rolesService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class rolesController extends Controller
{

    protected $rolesService;
    public function __construct(rolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SIMRS.roles.roles');
    }

    public function table()
    {
        $roles = $this->rolesService->getRolesData();
        $dataRoles = [];
        foreach ($roles as $r) {
            $dataRoles[] = [
                'id' => $r['id'],
                'name' => $r['name'],
                'created_at' => $r['created_at'],
                'updated_at' => $r['updated_at'],
            ];
        }

        return DataTables::of($dataRoles)
        ->addIndexColumn()
        ->addColumn('actions', function ($dataRoles) {
            return '
                <button class="btn btn-sm btn-success" onclick="editRoles(' . $dataRoles['id'] . ')"> <i class=" ri-edit-2-fill "></i></button> 
                <button class="btn btn-sm btn-danger" onclick="deleteRoles(' . $dataRoles['id'] . ')">  <i class=" ri-delete-bin-fill"></i></button>
            ';
        })
        ->rawColumns(['actions'])
        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
