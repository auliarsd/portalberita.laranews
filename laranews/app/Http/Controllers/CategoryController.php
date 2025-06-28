<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Berita',
            'categories' => Category::get(),
        ];

        return view('category.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $slug = strtolower($request->category_name);
        $slug = str_replace(' ', '-', $slug);

        $cek = Category::where('category_slug', $slug)->first();

        if($cek != null){
            return redirect()->back()->with('error', 'Kategori Berita Sudah Ada');
        }
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
        ]);
        return redirect('dashboard/kategori')->with('success', 'Berhasil Tambah Kategori Berita');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();

        $slug = strtolower($request->category_name);
        $slug = str_replace(' ', '-', $slug);
        $cek = Category::where('category_slug', $slug)->first();

        if($cek != null && $slug != $category->category_slug){
            return redirect()->back()->with('error', 'Kategori Berita Sudah Ada');
        }
        
        Category::where('id', $id)->update([
            'category_name' => $request->category_name,
            'category_slug' => $slug
        ]);
        return redirect('dashboard/kategori')->with('success', 'Berhasil Update Kategori Berita');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return  redirect('dashboard/kategori')->with('success', 'Berhasil Hapus Kategori Berita');
    }
}
