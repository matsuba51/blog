<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('dashboard')->with('success', 'ユーザー情報が更新されました');
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user(); 

        if ($user->id != $id) {
            return redirect()->route('dashboard')->with('error', 'アカウント削除権限がありません');
        }

        $user->delete();

        Auth::logout();

        return redirect('/blogs')->with('success', 'アカウントが削除されました');
    }
}