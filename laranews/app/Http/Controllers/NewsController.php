<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 1){
            $news = News::where('user_id', auth()->user()->id)->get();
        }else{
            $news = News::get();
        }
        $data = [
            'title' => 'Berita',
            'news' => $news,
        ];
        return view('news.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Berita',
            'categories' => Category::get(),
        ];

        return view('news.add_news', $data);
    }

    public function store(Request $request)
    {
        $validatedData =  $this->validateData($request);
        $validatedData['user_id'] = auth()->user()->id;

        $validatedData['slug'] = strtolower($validatedData['title']);
        $validatedData['slug'] = str_replace(' ', '-', $validatedData['slug']);

        $cek = News::where('slug', $validatedData['slug'])->first();

        if($cek != null){
            return redirect()->back()->with('error', 'Judul Berita Sudah Ada');
        }
        if ($request->file('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validatedData['image'] = $request->file('image')->storeAs('foto-berita', $fileName, 'public');
        }

        News::create($validatedData);
       
        return redirect('dashboard/berita')->with('success', 'Berhasil Tambah Berita');
    }


    public function show(News $news)
    {
        //
    }

    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        $data = [
            'title' => 'Edit Berita',
            'categories' => Category::get(),
            'news' => $news
        ];

        return view('news.update_news', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData =  $this->validateData($request);
        if ($request->file('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validatedData['image'] = $request->file('image')->storeAs('foto-berita', $fileName, 'public');
        }

        $validatedData['slug'] = strtolower($validatedData['title']);
        $validatedData['slug'] = str_replace(' ', '-', $validatedData['slug']);

        $cek = News::where('slug', $validatedData['slug'])->first();

        if($cek != null && $request->slug != $validatedData['slug']){
            return redirect()->back()->with('error', 'Judul Berita Sudah Ada');
        }

        if ($request->old_image) {
            Storage::delete($request->old_image);
        }

        News::where('id', $id)->update($validatedData);
       
        return redirect('dashboard/berita')->with('success', 'Berhasil Update Berita');
    }

    public function destroy($id)
    {
        $news = News::where('id', $id)->first();
        Storage::delete($news->image);
        News::destroy($id);
        return  redirect('dashboard/berita')->with('success', 'Berhasil Hapus Berita');
    }

    protected function validateData(Request $request){
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'caption' => 'required',
            'content' => 'required',
            'post_date' => 'required',
        ];

        $message = [
            'title.required' => 'Judul Berita Harus Diisi',
            'category_id.required' => 'Kategori Berita Harus Diisi!',
            'image.image' => 'File Hanya Menerima Gambar!',
            'image.max' => 'Maksimal Ukuran File Hanya 2 MB!',
            'caption.required' => 'Caption Foto Harus Diisi',
            'content.required' => 'Konten Berita Harus Diisi',
        ];

        return $request->validate($rules, $message);
    }
}
