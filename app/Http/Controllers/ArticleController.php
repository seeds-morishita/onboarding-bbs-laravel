<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ArticleController extends Controller
{
    /** 編集機能 */
    public function edit(Request $request, Article $article)
    {
        // セッションにIDを保存
        Session::put('id', $article->id);

        // トークン発行
        $token = strval(time());
        Session::put('token', $token);

        return view('boards.edit', compact('article'));
    }

    public function editComplete(Request $request , Article $article)
    {
        // CSRFトークンの検証
        $request->validate([
            'token' => 'required|in:' . session('token'),
            'name' => 'required|string',
            'content' => 'required|string',
        ]);
    
        // 送信されたデータを更新
        $article->name = $request->input('name');
        $article->content = $request->input('content');
    
        // データベースに保存
        $article->save();
    
        // セッション内のデータ削除
        Session::forget('id');
        Session::forget('token');
    
        return view('boards.edit_complete');
    }


    /** 新規投稿機能 */
    public function postConfirm(Request $request, Article $article)
    {
        Session::put('id', $article->id);

        $token = strval(time());
        Session::put('token', $token);

        return view('boards.post_confirm', compact('article'));
    }

    public function postComplete(Request $request, Article $article)
    {
        // CSRFトークンの検証
        $request->validate([
            'token' => 'required|in:' . session('token'),
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article->name = $request->input('name');
        $article->content = $request->input('content');
        
        // データベースに保存
        $article->save();
        
        // セッション内のデータ削除
        Session::forget('id');
        Session::forget('token');
        
        return view('boards.post_complete');
    }
    

    /** 削除機能 */
    public function deleteConfirm(Request $request, Article $article)
    {
        Session::put('id', $article->id);

        $token = strval(time());
        Session::put('token', $token);

        return view('boards.delete_confirm', compact('article'));
    }

    public function deleteComplete(Request $request, Article $article)
    {
        // CSRFトークンの検証
        $request->validate([
            'token' => 'required|in:' . session('token'),
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article -> delete();

        Session::forget('id');
        Session::forget('token');

        return view('boards.delete_complete');
    }
}
