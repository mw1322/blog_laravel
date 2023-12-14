<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $users = User::where('role_as', '0')->count();

        return view('user.dashboard', compact('categories', 'posts', 'users'));
    }
}
