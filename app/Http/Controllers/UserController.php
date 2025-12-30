<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\User;
use App\View\Components\ConfirmDelete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $pageTitle = 'Kelola Pengguna';
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $users = User::paginate(10);
        ConfirmDelete('Apakah Anda yakin ingin menghapus user ini?');
        return view('manage-user.index', compact('pageTitle', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        toast()->success('User berhasil ditambahkan.');
        return redirect()->route('manage-user.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, User $manage_user)
    {
        $manage_user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $manage_user->update(['password' => Hash::make($request->password)]);
        }
        toast()->success('User berhasil diperbarui.');
        return redirect()->route('manage-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        toast()->success('User berhasil dihapus.');
        return redirect()->route('manage-user.index');
    }
}