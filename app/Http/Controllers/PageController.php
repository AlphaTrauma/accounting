<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\File;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $items = Page::orderBy('updated_at')->paginate(20);

        return view('dashboard.pages.index', compact('items'));
    }


    public function edit($id = null)
    {
        return view('dashboard.pages.edit', compact('id'));
    }

    public function data($id)
    {
        $item = Page::with('images')->find($id);
        if (!$item) return response(['errors', ['Страница не найдена']]);

        return response(compact('item'));
    }

    public function store(PageRequest $request): Response
    {
        $data = $request->all();
        $data['user_id'] = Auth::id(); 
        $item = Page::create($data);
        preg_match_all('/src="([^"]+)"/', $item->content, $matches);
        $pathsInContent = $matches[1];
        foreach ($pathsInContent as $path) :
            $file = File::where('entity_type', 'App\\Models\\Page')->where('filepath', $path)->first();
            if ($file) :
                $file->entity_id = $item->id;
                $file->save();
            endif;
        endforeach;
        $time = date('H:i:s');
        return response(compact('item', 'time'));
    }

    public function update(PageRequest $request): Response
    {

        $data = $request->all();
        $item = Page::with('images')->find($data['id']); 
        $time = date('H:i:s');
        $item->update($data);
        preg_match_all('/src="([^"]+)"/', $item->content, $matches);
        $pathsInContent = $matches[1];
        $imagePaths = $item->images->pluck('filepath')->toArray();
        foreach ($item->images as $image) :
            if (!in_array($image->filepath, $pathsInContent)) :
                $image->delete();
            endif;
        endforeach;
        foreach ($pathsInContent as $path) :
            if (!in_array($path, $imagePaths)) :
                $file = File::where('entity_type', 'App\\Models\\Page')->where('filepath', $path)->first();
                if ($file) :
                    $file->entity_id = $item->id;
                    $file->save();
                endif;
            endif;
        endforeach;

        return response(compact('item', 'time'));
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        if ($page) :
            $page->delete();
            return back();
        else :
            return back();
        endif;
    }

    public function show($slug)
    {
        $item = Page::where('slug', $slug)->first();
        if (!$item) abort(404); 
        return view('page.show', compact('item'));
    }
}
