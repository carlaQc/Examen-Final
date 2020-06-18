<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->rol_id == 2 || auth()->user()->rol_id == 3){
            $promotion = Promotion::leftjoin('info_centers','info_centers.center_id','info_promotions.center_id')
                                    ->select('info_promotions.description_promotion','info_centers.name_center','info_centers.address','info_centers.activity','info_centers.cellphone','info_centers.photo')
                                    ->where('info_promotions.state',1)
                                    ->where('info_promotions.center_id',auth()->user()->center_id)
                                    ->orderBy('info_promotions.promotion_id','desc')
                                    ->get();
        }else{
            $promotion = Promotion::leftjoin('info_centers','info_centers.center_id','info_promotions.center_id')
                                    ->select('info_promotions.description_promotion','info_centers.name_center','info_centers.address','info_centers.activity','info_centers.cellphone','info_centers.photo')
                                    ->where('info_promotions.state',1)
                                    ->orderBy('info_promotions.promotion_id','desc')
                                    ->get();
        }
        return view('home',[
            'promotion' => $promotion
        ]);
    }
}
