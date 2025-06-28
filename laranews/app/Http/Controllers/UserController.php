<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penulis',
            'users' => User::get(),
        ];

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Penulis',
        ];

        return view('user.add_user', $data);
    }

    public function store(Request $request)
    {
        $post = $request->validate(
            [
                'username' => 'required|unique:users,username',
                'name' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'username.required' => 'Username Tidak Boleh Kosong',
                'username.unique' => 'Username Sudah Digunakan',
                'name.required' => 'Nama Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
                'password.min' => 'Minimal Password 6 Karakter!',
            ]
        );

        $post['password'] = Hash::make($post['password']);

        User::create([
            'username' => $post['username'],
            'name' => $post['name'],
            'role' => 2,
            'password' => $post['password'],
        ]);

        return redirect('/dashboard/penulis')->with('success', 'Berhasil Tambah Penulis Berita!');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Hapus Data User');
    }
}
