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
    public function index(Request $request)
    {

//        dump(Device::all()->slice(0, 10));
//        dump(TypeData::all()->slice(0, 10));
//        dump(User::all()->slice(0, 10));
//        dump(Data::all()->slice(0, 10));
//        dump(TimeGraphic::all()->slice(0, 10));
//        dump(LineTimeGraphic::all()->slice(0, 10));
//        dump(FavoriteTimeGraphics::all()->slice(0, 10));
        if (View::exists('home')) {
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

    }
    public function home(Request $request){

        $subarray = [];
        foreach (TimeGraphic::all()->where('user_id', Auth::user()->id) as $time_graphic){

            if(FavoriteTimeGraphics::all()->where('time_graphic_id', $time_graphic->id)->count() == 1){
                array_push($subarray, ['id' => $time_graphic->id, 'name' => $time_graphic->name]);
            }

        }

        return view('showGraphic', [
            'type' => 'multi',
            'graphic_type' => 'timegraphic_multi',
            'items' => $subarray
        ]);
    }
}
