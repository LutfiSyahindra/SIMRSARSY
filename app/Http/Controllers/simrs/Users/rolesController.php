<?php

namespace App\Http\Controllers\simrs\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\rolesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Simpan data ke database dengan password yang di-hash
        $this->rolesService->createRoles(
            $request->name,
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Roles Created successful!',
        ], 201);
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
        $roles = $this->rolesService->findRoles($id);
        return response()->json($roles);
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
