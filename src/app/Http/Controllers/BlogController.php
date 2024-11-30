<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::orderByDesc('id')->paginate(24);

        return view('blogs', ['blogs' => $blogs]);
    }

    public function get(Request $request, string $slug): View
    {
        return view('blog', ['blog' => Blog::where('slug', $slug)->firstOrFail()]);
    }
}
