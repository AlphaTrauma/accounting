<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuItemsController extends Controller
{
    public function index(){
        return view('dashboard.menu.index');
    }

    public function data()
    {
        $items = MenuItem::orderBy('order')->get();
        $pages = Page::query()->get(['title', 'slug']);
        return response(['items' => $items, 'pages' => $pages]);
    }

    // Получение одного пункта меню
    public function show($id)
    {
        return MenuItem::findOrFail($id);
    }

    // Создание нового пункта меню
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'integer',
            'parent_id' => 'nullable|exists:menu_items,id'
        ]);

        $menuItem = MenuItem::create($request->all());

        return response()->json($menuItem, 201);
    }

    // Обновление существующего пункта меню
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'integer',
            'parent_id' => 'nullable|exists:menu_items,id'
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->update($request->all());

        return response()->json($menuItem, 200);
    }

    // Удаление пункта меню
    public function destroy($id)
    {
        MenuItem::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
