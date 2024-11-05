<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Guide;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    public function index(){
        $guides = Guide::withCount('files')->where('status', 1)->get();
        $purchased = [];
        if(Auth::check()):
            $purchased = Purchase::where('user_id', Auth::id())->pluck('guide_id')->toArray();
        endif;
        $title = 'Гайды';
        return view('guides.index', compact('guides', 'purchased', 'title'));
    }

    public function list(){
        $guides = Guide::withCount('files')->latest()->paginate(20);

        return view('dashboard.guides.index', compact('guides'));
    }

    public function create(){
        return view('dashboard.guides.create');
    }

    public function store(Request $request)
    {
        
        $guide = Guide::create($request->all());
        
        return redirect()->route('guides.edit', compact('guide'));
    }

    public function edit(Guide $guide)
    {
        return view('dashboard.guides.edit', compact('guide'));
    }

    public function update(Request $request, Guide $guide)
    { 
        $guide->update($request->all()); 

        return redirect()->route('guides.list')->with('success', 'Гайд обновлён');
    }

    public function destroy(Guide $guide)
    {
        $guide->loadCount('purchases');
        if($guide->purchases_count > 0):
            return redirect()->route('guides.list')->with('error', 'Гайд уже куплен, его нельзя удалить'); 
        else:
            $guide->delete();
            return redirect()->route('guides.list')->with('success', 'Гайд удалён'); 
        endif;
        
    }

    public function success(Request $request){
        $data = $request->all();
        $purchase = Purchase::create(['user_id' => Auth::id(), 'guide_id' => $data['guide_id']]);
        
        if($purchase):
            return redirect()->route('lk.purchases')->with('success', 'Гайд успешно приобретён и добавлен в личный кабинет');
        else:
            return back()->with('error', 'Ошибка оплаты');
        endif;
    }

    public function purchase(Guide $guide){
        $parent = ['title' => 'Гайды', 'url' => '/guides'];
        $title = "Покупка";
        return view('guides.purchase', compact('guide', 'parent', 'title'));
    }

    public function purchases(){
        $purchases = Purchase::with('guide.files')->where('user_id', Auth::id())->get();
        $parent = ['url' => '/personal', 'title'=> 'Личный кабинет'];
        $title = 'Покупки';
        return view('lk.purchases', compact('purchases', 'parent', 'title'));
    }

    public function download($file_id){
        $file = File::find($file_id);
        $purchased = Purchase::where('user_id', Auth::id())
        ->with('guide.files:id,entity_id')
        ->get()->flatMap(function ($purchase) {
            return $purchase->guide->files->pluck('id');
        })->toArray();
        if(in_array($file_id, $purchased)):
            return response()->download(Storage::disk('public')->path($file->filepath), $file->filename);
        else:
            abort(403);
        endif;
    }
}
