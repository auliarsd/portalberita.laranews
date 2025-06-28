<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role != 1){
            $news = News::where('user_id', auth()->user()->id)->count();
            $category = DB::table('news')->distinct('category_id')->where('user_id', auth()->user()->id)->count('category_id');
        }else{
            $news = News::count();
            $category = Category::count();
        }
        $data = [
            'title' => 'Dashboard',  
            'category' => $category,
            'news' => $news,
            'user' => User::count()
        ];

        return view('dashboard', $data);
    }

    public function profile(Request $request){

        if ($request->isMethod('POST')) {
            $post = $request->validate([
                'name' => 'required',
                'password' => 'required|min:6',
                'image' => 'image|file|max:2048',
                'password2' => 'required|same:password',
            ], [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
                'image.image' => 'File Hanya Menerima Gambar!',
                'image.max' => 'Maksimal Ukuran File Hanya 2 MB!',
                'password2.required' => 'Konfirmasi Password Tidak Boleh Kosong',
                'password.min' => 'Password Minimal 6 Karakter',
                'password2.same' => 'Konfirmasi Password Salah',
            ]);
            if ($request->file('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $post['image'] = $request->file('image')->storeAs('foto-profil', $fileName, 'public');
            }

            $post['password'] = Hash::make($post['password']);

            $user = User::find(auth()->user()->id);
            $user->password = $post['password'];
            $user->name = $post['name'];
            if ($request->file('image')) {
                $user->image = $post['image'];
            }
            $user->save();

            return redirect()->back()->with('success', 'Berhasil Update Profil');
        }

        $data = [
            'title' => 'Profile Admin',
            'user' => User::where('id', auth()->user()->id)->first()
        ];

        return view('profile', $data);
    }
}
