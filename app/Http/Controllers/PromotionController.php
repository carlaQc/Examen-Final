<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Promotion;

class PromotionController extends Controller
{
    public function getPromotion(){
    	$promotion = Promotion::where('center_id',auth()->user()->center_id)->get();
    	return view('promotion.index',[
    		'promotion' => $promotion
    	]);
    }

    public function createPromotion(){
    	return view('promotion.create');
    }

    public function storePromotion(Request $request){
    	$p = new Promotion;
    	$p->center_id = auth()->user()->center_id;
    	$p->description_promotion = $request->description;
    	$p->date = date('Y-m-d H:m:i');
    	$p->save();
    	return redirect()->route('promotion.get');
    }

    public function deletePromotion($id){
    	$p = Promotion::findOrFail($id);
        if($p->state == 0){
            $p->state = 1;            
        }else{
            $p->state = 0;
        }
        $p->save();
    	return redirect()->route('promotion.get');
    }
}
