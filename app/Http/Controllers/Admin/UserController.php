<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ユーザー一覧表示
    public function index()
    {
        $users = User::all();  // すべてのユーザーを取得
        return view('admin.users.index', compact('users'));  // ユーザー一覧ページにデータを渡す
    }

    // 新規ユーザー作成フォーム
    public function create()
    {
        return view('admin.users.create');  // 新規ユーザー作成フォームを表示
    }

    // 新規ユーザーの保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 新しいユーザーを保存
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // パスワードをハッシュ化して保存
        ]);

        return redirect()->route('admin.users.index')->with('success', 'ユーザーが作成されました。');
    }

    // ユーザー詳細表示
    public function show($id)
    {
        $user = User::findOrFail($id);  // 指定されたIDのユーザーを取得
        return view('admin.users.show', compact('user'));  // 詳細ページにユーザーを渡す
    }

    // ユーザー編集フォーム
    public function edit($id)
    {
        $user = User::findOrFail($id);  // 指定されたIDのユーザーを取得
        return view('admin.users.edit', compact('user'));  // 編集フォームにデータを渡す
    }

    // ユーザーの更新
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,  // 自分のメールアドレスは除外
            'password' => 'nullable|string|min:8|confirmed',  // パスワードの変更は任意
        ]);

        $user = User::findOrFail($id);  // 指定されたIDのユーザーを取得

        // ユーザー情報を更新
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,  // パスワード変更があればハッシュ化
        ]);

        return redirect()->route('admin.users.index')->with('success', 'ユーザーが更新されました。');
    }

    // ユーザーの削除
    public function destroy($id)
    {
        $user = User::findOrFail($id);  // 指定されたIDのユーザーを取得
        $user->delete();  // ユーザーを削除

        return redirect()->route('admin.users.index')->with('success', 'ユーザーが削除されました。');
    }
}