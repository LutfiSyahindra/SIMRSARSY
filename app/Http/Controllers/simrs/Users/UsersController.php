<?php

namespace App\Http\Controllers\simrs\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Users\UsersService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    protected $usersService;
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SIMRS.users.users');
    }

    public function table(){
        $users = $this->usersService->getUsersData();
        $dataUsers = [];
        foreach ($users as $u) {
            $dataUsers[] = [
                'id' => $u['id'],
                'name' => $u['name'],
                'created_at' => $u['created_at'],
                'updated_at' => $u['updated_at'],
            ];
        }

        return DataTables::of($dataUsers)
        ->addIndexColumn()
        ->addColumn('actions', function ($dataUsers) {
            return '
                <button class="btn btn-sm btn-success" onclick="editUsers(' . $dataUsers['id'] . ')"> <i class=" ri-edit-2-fill "></i></button> 
                <button class="btn btn-sm btn-danger" onclick="deleteUsers(' . $dataUsers['id'] . ')">  <i class=" ri-delete-bin-fill"></i></button>
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Simpan data ke database dengan password yang di-hash
        $this->usersService->createUsers(
            $request->name,
            $request->email,
            $request->password,
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Signup successful!',
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
        $users = $this->usersService->findUser($id);
        Log::info($users);
        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $users = $this->usersService->findUser($id);
        $users->update($request->only(['name', 'email']));

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari role berdasarkan ID
            $user = $this->usersService->findUser($id);
            // Hapus role
            $user->delete();

            // Berikan respons JSON sukses
            return response()->json([
                'success' => true,
                'message' => 'user berhasil dihapus.'
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
