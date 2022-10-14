<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'User')->orderByRaw('updated_at - created_at DESC')->get();
        return view('admin.table.user.main', [
            'title' => 'Table User',
            'active' => 'table',
            'act' => 'tableuser',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.table.user.register', [
        //     'title' => 'Form Register',
        //     'active' => 'form',
        //     'act' => 'formtambahpengguna',
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            $validatedData['password'] = Hash::make($request->password);
            $user = User::all();
            if ($user->isEmpty()) {
                $validatedData['role'] = 'Admin';
                $validatedData['status'] = 'Aktif';
            } else {
                $validatedData['role'] = 'User';
                $validatedData['status'] = 'Non Aktif';
            }
            User::create($validatedData);
            return back()->with('status', 'success')->with('message', 'Berhasil tambah user');
        } catch (\Throwable $th) {
            return back()->with('status', 'success')->with('message', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
            ]);
            if (!empty($request->password)) {
                $validatedData['password'] = $request->password;
            } else {
                $validatedData['password'] = $user->password;
            }
            if ($request->username != $user->username) {
                $request->validate(['username' => 'required|unique:users']);
            }
            if ($request->email != $user->email) {
                $request->validate(['email' => 'required|unique:users']);
            }
            $validatedData['status'] = $user->status;
            $validatedData['role'] = $user->role;
            $user->update($validatedData);
            return back()->with('status', 'success')->with('message', 'berhasil mengupdate data');
        } catch (\Throwable $th) {
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return back()->with('status', 'success')->with('message', 'Berhasil menghapus status');
        } catch (\Throwable $th) {
            return back()->with('status', 'success')->with('message', $th->getMessage());
        }
    }
    public function status($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->status == 'Aktif') {
            $user->status = 'Non Aktif';
            $user->save();
        } elseif ($user->status == 'Non Aktif') {
            $user->status = 'Aktif';
            $user->save();
        }
        return back()->with('status', 'success')->with('message', 'Berhasil merubah status');
    }
}
