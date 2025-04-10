<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->is_admin === 1) {
            return redirect()->route('admin.users')->with('error', '管理者は削除できません');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'ユーザーを削除しました');
    }
}
