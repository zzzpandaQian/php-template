<?php
namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $results = News::where('status', 1)->paginate(1);
        return view('news.index', compact('results'));
    }

    public function detail($id)
    {
        $item = News::find($id);
        return view('news.detail', compact('item'));
    }
}
