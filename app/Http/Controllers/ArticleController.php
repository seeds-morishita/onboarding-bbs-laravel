<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request; 
use App\Http\Requests\PostRequest;
use App\Http\Requests\EditRequest;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all(); // 記事を取得

        // ビューに$articlesを渡す
        return view('articles.index', compact('articles'));
    }

    public function postConfirm(Request $request)
    {
        Session::put($request->input('name'));
        Session::put($request->input('content'));
        
        $token = strval(time());
        Session::put('token', $token);

        return view('articles.post_confirm', ['request' => $request]);
    }

    public function postComplete(PostRequest $request)
    {
        $article = new Article();
        $article->name = $request->input('name');
        $article->content = $request->input('content');
        
        // データベースに保存
        $article->save();
        
        // セッションのデータ削除
        Session::forget('id');
        Session::forget('token');
        
        return view('articles.post_complete');
    }

    /** 編集機能 */
    public function edit(Article $article)
    {
        // セッションにIDを保存
        Session::put('id', $article->id);

        // トークン発行
        $token = strval(time());
        Session::put('token', $token);

        return view('articles.edit', compact('article'));
    }

    public function editComplete(EditRequest $request , Article $article)
    {    
        // 送信されたデータを更新
        $article->name = $request->input('name');
        $article->content = $request->input('content');
    
        // データベースに保存
        $article->save();
    
        // セッション内のデータ削除
        Session::forget('id');
        Session::forget('token');
    
        return view('articles.edit_complete');
    }

    /** 削除機能 */
    public function deleteConfirm(Article $article)
    {
        Session::put('id', $article->id);

        $token = strval(time());
        Session::put('token', $token);

        return view('articles.delete_confirm', compact('article'));
    }

    public function deleteComplete(Article $article)
    {
        $article -> delete();

        Session::forget('id');
        Session::forget('token');

        return view('articles.delete_complete');
    }
}
