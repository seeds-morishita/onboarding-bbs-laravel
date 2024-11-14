<?php

namespace App\Http\Controllers;
use App\Models\Article; 

class BoardController extends Controller
{
    public function index()
    {
        $articles = Article::all(); // 記事を取得

        // ビューに$articlesを渡す
        return view('boards.index', compact('articles'));
    }
}
