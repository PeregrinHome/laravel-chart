<?php

namespace App\Http\Controllers;
use App\Data;
use App\FavoriteTimeGraphics;
use App\LineTimeGraphic;
use App\TimeGraphic;
use App\TypeData;
use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Device;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home', ['title' => env('SITE_TITLE'), 'nav_items' =>
            [
                [
                    'name' => 'Графики',
                    'link' => '/login'
                ],
                [
                    'name' => 'Типы данных',
                    'link' => '/register'
                ]
            ]
        ]);

    }
    public function home(){

        $subarray = [];
        foreach (Auth::user()->graphics()->get() as $time_graphic){
            if(FavoriteTimeGraphics::where('time_graphic_id', $time_graphic->id)->get()->first()){
                $subarray[] = ['id' => $time_graphic->id, 'name' => $time_graphic->name];
            }
        }

        return view('showGraphic', [
            'type' => 'multi',
            'graphic_type' => 'timegraphic_multi',
            'items' => $subarray
        ]);
    }
}
