<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        //DBよりテーブルの値を全て取得
        $articles = article::all();

        return view('board/index', compact('articles'));
    }
}
