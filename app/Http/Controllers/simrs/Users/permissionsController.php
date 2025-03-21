<?php

namespace App\Http\Controllers\simrs\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\PermissionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class permissionsController extends Controller
{
    protected $permissionsService;
    public function __construct(PermissionsService $permissionsService)
    {
        $this->permissionsService = $permissionsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SIMRS.permission.permission');
    }

     public function table()
    {
        $permissions = $this->permissionsService->getPermissionsData();
        $dataPermissions = [];
        foreach ($permissions as $r) {
            $dataPermissions[] = [
                'id' => $r['id'],
                'name' => $r['name'],
                'created_at' => $r['created_at'],
                'updated_at' => $r['updated_at'],
            ];
        }

        return DataTables::of($dataPermissions)
        ->addIndexColumn()
        ->addColumn('actions', function ($dataPermissions) {
            return '
                <button class="btn btn-sm btn-success" onclick="editPermissions(' . $dataPermissions['id'] . ')"> <i class=" ri-edit-2-fill "></i></button> 
                <button class="btn btn-sm btn-danger" onclick="deletePermissions(' . $dataPermissions['id'] . ')">  <i class=" ri-delete-bin-fill"></i></button>
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
        //
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
        $this->permissionsService->createPermissions(
            $request->name,
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Permission Created successful!',
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
        $permissions = $this->permissionsService->findPermissions($id);
        return response()->json($permissions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $roles = $this->permissionsService->findPermissions($id);
        $roles->update(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions updated successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari role berdasarkan ID
            $permission = $this->permissionsService->findPermissions($id);
            // Hapus role
            $permission->delete();

            // Berikan respons JSON sukses
            return response()->json([
                'success' => true,
                'message' => 'permission berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
