<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $latest = News::latest()->first();
        if($latest == null){
            abort(404);
        }
        $threelatest = News::latest()->limit(3)->get();
        $three = News::where('id', '!=', $latest->id)->orderBy('id', 'desc')->limit(3)->get();
        $category = Category::latest()->first();
        $catNewsLatest = News::where('category_id', $category->id)->first();
        if($catNewsLatest != null){
            $threCatNewsLatest = News::where('id', '!=', $catNewsLatest->id)->where('category_id', $category->id)->orderBy('id', 'desc')->limit(3)->get(); 
        }else{
            $threCatNewsLatest = null;
        }
        $data = [
            'title' => 'Beranda',
            'latestnews' => $latest,
            'three' => $three,
            'categories' => Category::latest()->limit(3)->get(),
            'threelatest' => $threelatest,
            'category' => $category,
            'catNewsLatest' => $catNewsLatest,
            'threCatNewsLatest' => $threCatNewsLatest
        ];

        return view('index', $data);
    }

    public function kategori($params){
        if($params == 'lainnya'){
            $news = News::orderBy('id', 'DESC')->paginate(4);
            $category = 'Lainnya';
        }else{
            $ct = Category::where('category_slug', $params)->first();
            $category = $ct->category_name;
            $news = News::where('category_id', $ct->id)->orderBy('id', 'DESC')->paginate(4);
        }
        $data = [
            'title' => 'Kategori Berita',
            'categories' => Category::latest()->limit(3)->get(),
            'listcat' => Category::latest()->get(),
            'news' => $news,
            'category' => $category,
        ];

        return view('category', $data);
    }

    public function tentang(){
        $data = [
            'title' => 'Tentang Kami',
            'categories' => Category::latest()->limit(3)->get()
        ];

        return view('about', $data);
    }

    public function kontak(){
        $comments = DB::table('comments')->select('comments.*')->where('parent_id', '0')->where('cm_type' ,0)->get();
        $count = DB::table('comments')->select('comments.*')->where('cm_type' ,0)->count();
        
        $comments->each(function ($comment) {
            $comment->replies = Comment::where('parent_id', $comment->id)->orderBy('created_at', 'asc')->get();
        });
        $data = [
            'title' => 'Hubungi Kami',
            'categories' => Category::latest()->limit(3)->get(),
            'comment' => $comments, 
            'count' => $count
        ];

        return view('contact', $data);
    }

    public function detail($slug){
        $news = News::where('slug', $slug)->first();
        $latest = News::where('slug', '!=', $slug)->orderBy('created_at','desc')->limit(5)->get();
    
        $trending = News::leftJoin('comments', 'news.id', '=', 'comments.news_id')
            ->select('news.*', DB::raw('COUNT(comments.id) as comment_count'))
            ->groupBy('news.id')
            ->orderBy('comment_count', 'desc')->limit(5)->get();

        $comments = DB::table('comments')->select('comments.*')->leftJoin('news', 'comments.news_id', '=', 'news.id')->where('parent_id', 0)->where('news_id' ,$news->id);

        $count = DB::table('comments')->select('comments.*')->leftJoin('news', 'comments.news_id', '=', 'news.id')->where('news_id' ,$news->id)->count();
        
        $comments = $comments->get();
        $comments->each(function ($comment) {
            $comment->replies = Comment::where('parent_id', $comment->id)->orderBy('created_at', 'asc')->get();
        });

        $data = [
            'title' => 'Detail Berita',
            'categories' => Category::latest()->limit(3)->get(),
            'news' => $news,
            'latest' => $latest,
            'trending' => $trending,
            'comments' => $comments,
            'count' => $count,
            'listcat' => Category::latest()->get()
        ];

        return view('detail', $data);
    }

    public function komentar(Request $request, $type, $id){
        if($type == 'berita'){
            $cm_type = 1;
        }else{
            $cm_type = 0;
        }
        
        Comment::create([
            'cm_type' => $cm_type,
            'news_id' => $id,
            'parent_id' => $request->reply_id,
            'cm_name' => $request->cm_name,
            'cm_email' => $request->cm_email,
            'cm_message' => $request->cm_message
        ]);

        return redirect()->back();
    }

    public function search(Request $request){
        if ($request->isMethod('POST')) {
            $news = News::whereRaw('LOWER(title) LIKE ?', ['%'.strtolower($request->keyword).'%'])->paginate(4);
            $category = 'search';
            $data = [
                'title' => 'Search Berita',
                'categories' => Category::latest()->limit(3)->get(),
                'news' => $news,
                'category' => $category,
                'listcat' => Category::latest()->get()
            ];

            return view('category', $data);
        }else{
            return redirect('/kategori-berita/lainnya');
        }
    }
}
