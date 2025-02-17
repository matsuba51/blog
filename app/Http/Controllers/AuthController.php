<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログインフォーム表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/blogs');  // ログイン後に /blogs にリダイレクト
        }

        return back()->withErrors([
            'email' => '認証に失敗しました。',
        ]);
    }

    // ユーザー登録フォーム
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ユーザー登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/blogs');
    }

    // 登録完了後にリダイレクトするためのページ
    public function registerComplete()
    {
        return view('auth.register_complete');
    }

    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
