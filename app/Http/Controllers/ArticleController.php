<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $items = Article::orderBy('updated_at')->paginate(20);
        return view('dashboard.articles.index', compact('items'));
    }

    public function edit(Article $item = null){
        if($item === null) $item = new Article();
        return view('dashboard.articles.edit', compact('item'));
    }
}
