<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all(); 
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags', 
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.tags')->with('success', 'タグを追加しました');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id, 
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect()->route('admin.tags')->with('success', 'タグを更新しました');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tags')->with('success', 'タグを削除しました');
    }
}
