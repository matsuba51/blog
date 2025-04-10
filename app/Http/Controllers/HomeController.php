<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();  
        $authUser = Auth::user(); 

        return view('welcome', compact('blogs', 'authUser'));  
    }
}