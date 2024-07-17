<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        return view('dashboard.categories.index');
    }

    public function data(){
        $items = Categories::withCount('articles')->orderByDesc('articles_count')->get();
        return response(['items' => $items]);
    }

    public function create(Request $request){
        $data = $request->all();
        $item = Categories::create($data);
        $item->articles_count = 0;
        return response(['item' => $item]);
    }

    public function update(Request $request){
        $data = $request->all();
        $item = Categories::withCount('articles')->find($data['id']);
        $item->update($data);

        return response(['item' => $item]);
    }

    public function remove(Request $request){
        $item = Categories::withCount('articles')->find($request['id']);
        if(!$item->articles_count):
            $item->delete();
            return response(['status' => true]);
        else:
            return response(['error' => 'Невозможно удалить категорию, содержащую статьи']);
        endif;
    }
}
