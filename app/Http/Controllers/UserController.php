<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    private UsersService $usersService;

    /**
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

     /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $title = 'Manage Users';
        $users = User::all();

        return response()->view('manageusers.index', compact('title','users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $title = 'Tambah User';

        return response()->view('manageusers.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(UsersRequest $request)
    public function store(UsersRequest $request) : RedirectResponse
    {
        if ($this->usersService->store($request)) {
            return redirect()->route('manageusers')->with('success', 'Data User Berhasil Ditambahkan.');
        } else {
            return redirect('/manageusers/create')->withInput()->with('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        if ($request->header('X-Requested-With') !== 'fetch') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $id = $request->input('id');
        $user = User::find($id);

        return response()->json(['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $title = 'Ubah Data User';

        $user = User::find($id);

        return response()->view('manageusers.edit', compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request)
    {
        if ($this->usersService->update($request)) {
            return redirect()->route('manageusers')->with('success', 'Data User Berhasil Diubah.');
        } else {
            return redirect('/manageusers/create')->withInput()->with('error', 'Perubahan data gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->usersService->destroy($request);

        if ($result) {
            return redirect()->route('manageusers')->with('success', 'Data User Berhasil Dihapus.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Penghapus data gagal. Silahkan coba lagi.');
        }
    }
}
