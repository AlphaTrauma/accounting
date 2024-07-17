<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\File;
use Carbon\Carbon; 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 

class ArticleController extends Controller
{
    public function index(){
        $items = Article::orderBy('updated_at')->paginate(20);
         
        return view('dashboard.articles.index', compact('items'));
    }

    public function edit($id = null) {
        return view('dashboard.articles.edit', compact('id'));
    }

    public function data($id){
        $item = Article::with('user', 'images')->find($id);
        if(!$item) return response(['errors', ['Статья не найдена']]);
        
        return response(compact('item'));
    }

    public function store(ArticleRequest $request): Response 
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['published_at'] = !!$data['status'] ? Carbon::now() : null;
        $item = Article::create($data);
        preg_match_all('/src="([^"]+)"/', $item->content, $matches);
        $pathsInContent = $matches[1]; 
        foreach ($pathsInContent as $path):
            $file = File::where('entity_type', 'App\\Models\\Article')->where('filepath', $path)->first();
                if ($file):
                    $file->entity_id = $item->id;
                    $file->save();
                endif;
        endforeach;
        $time = date('H:i:s');
        return response(compact('item', 'time'));
    }

    public function update(ArticleRequest $request): Response 
    {
         
        $data = $request->all();
        $item = Article::with('images')->find($data['id']);
        $data['user_id'] = Auth::id(); 
        $data['published_at'] = (!!$data['status'] AND !$item->published_at) ? Carbon::now() : null;
        $time = date('H:i:s');
        $item->update($data); 
        preg_match_all('/src="([^"]+)"/', $item->content, $matches);
        $pathsInContent = $matches[1]; 
        $imagePaths = $item->images->pluck('filepath')->toArray(); 
        foreach ($item->images as $image):
            if (!in_array($image->filepath, $pathsInContent)):
               $image->delete();
            endif;
        endforeach;
        foreach ($pathsInContent as $path):
            if (!in_array($path, $imagePaths)):
                $file = File::where('entity_type', 'App\\Models\\Article')->where('filepath', $path)->first();
                if ($file):
                    $file->entity_id = $item->id;
                    $file->save();
                endif;
            endif;
        endforeach;

        return response(compact('item', 'time'));
    }

    public function destroy($id){
        $article = Article::find($id);
        if($article):
            $article->delete();
            return back();
        else:
            return back();
        endif;
        
       
    }

    public function show($identifier){
        if(is_numeric($identifier)):
            $item = Article::find($identifier);
        else:
            $item = Article::where('slug', $identifier)->first();
        endif;
        if(!$item) abort(404);
        $item->update(['views', $item->views + 1]);
        return view('article.show', compact('item'));
    }
}
