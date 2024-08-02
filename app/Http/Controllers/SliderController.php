<?php

namespace App\Http\Controllers;

use App\Models\SliderButton;
use App\Models\SliderItem;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function slider(){

	    return view('dashboard.slider.index');
    }

    public function main(){
        $slides = SliderItem::with('image', 'buttons')->where('status', true)->orderBy('order')->get();
        return response(['slides' => $slides]);
    }

    public function sliderData(){
	    $slides = SliderItem::with('image', 'buttons')->orderBy('order')->get();

	    return response(compact('slides'));
    }

    public function removeSlide($id){
	    $slide = SliderItem::find($id);
	    if($slide):
            $slide->buttons()->delete();
            $slide->image()->delete();
            $slide->delete();
	        return response(['status' => true]);
        else:
            return response(['status' => false]);
        endif;
    }

    public function updateSlide(Request $request, $id = null){
	    $data = $request->except(['_token', 'file']);
	    if($id) $slide = SliderItem::with('buttons', 'image')->find($id);

	    if($request->hasFile('file')):
            if($id) unlink(public_path().$slide->image);
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $filepath = 'upload/slides/'.$filename;
            $image->move(public_path('upload/slides'), $filename);
            $data['image'] = '/'.$filepath;
        endif;
        if($id):
            $slide->update($data);
        else:
            $data['order'] = SliderItem::count() + 1;
            $slide = SliderItem::create($data); 
        endif;


        return response(['result' => $slide]);
    }

    public function updateButton(Request $request){
        $data = $request->except(['_token']); 
        if($request->has('id') and $data['id']):
            $btn = SliderButton::find($data['id']);
            if($btn):
                $btn->update($data);
            endif;
        else:
            $btn = SliderButton::create($data); 
        endif;

        return response(['result' => $btn]);
    }

    public function removeButton(Request $request){
        $btn = SliderButton::find($request['id']);
        $btn->delete();

        return response(['status' => true]);
    }

    public function updateOrdering(Request $request){
        $items = $request->input('items');

        foreach ($items as $item):
            SliderItem::where('id', $item['id'])->update(['ordering' => $item['ordering']]);
        endforeach;

        return response(['status' => true]);
    }
}
