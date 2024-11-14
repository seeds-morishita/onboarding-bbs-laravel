<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\DeleteRequest;


class ArticleController extends Controller
{
    /** 編集機能 */
    public function edit(Article $article)
    {
        // セッションにIDを保存
        Session::put('id', $article->id);

        // トークン発行
        $token = strval(time());
        Session::put('token', $token);

        return view('boards.edit', compact('article'));
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
    
        return view('boards.edit_complete');
    }


    /** 新規投稿機能 */
    public function postConfirm(Article $article)
    {
        Session::put('id', $article->id);

        $token = strval(time());
        Session::put('token', $token);

        return view('boards.post_confirm', compact('article'));
    }

    public function postComplete(PostRequest $request, Article $article)
    {
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
    public function deleteConfirm(Article $article)
    {
        Session::put('id', $article->id);

        $token = strval(time());
        Session::put('token', $token);

        return view('boards.delete_confirm', compact('article'));
    }

    public function deleteComplete(DeleteRequest $request, Article $article)
    {
        $article -> delete();

        Session::forget('id');
        Session::forget('token');

        return view('boards.delete_complete');
    }
}
