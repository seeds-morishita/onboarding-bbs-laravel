<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BoardController extends Controller
{
    public function index()
    {
        return view('boards.index');
    }

    public function postConfirm(Request $request)
    {
        // フォームから送信されたデータを取得
        $exampleInput = $request->input('example_input');

        // データをビューに渡す
        return view('boards.post_confirm', ['exampleInput' => $exampleInput]);
    }

    public function postComplete(Request $request)
    {
        $exampleInput = $request->input('example_input');
        return view('boards.post_complete', ['exampleInput' => $exampleInput]);
    }

    public function edit($id)
    {
        $article = User::find($id);
        return view('boards.edit', compact('article'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:articles,id',
            'name' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = User::find($request->id);
        $article->name = $request->name;
        $article->content = $request->content;
        $article->save();

        return redirect()->route('index')->with('success', '投稿を更新しました');
    }

    public function editComplete()
    {
        return view('boards.edit_complete');
    }

    public function deleteConfirm(Request $request)
    {
        $exampleInput = $request->input('example_input');
        return view('boards.delete_confirm', ['exampleInput' => $exampleInput]);
    }

    public function deleteComplete()
    {
        return view('boards.delete_complete');
    }
}
