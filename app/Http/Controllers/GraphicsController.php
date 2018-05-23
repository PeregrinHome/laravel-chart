<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\FavoriteTimeGraphics;
use App\Device;
use App\TypeData;
use App\TimeGraphic;
use App\LineTimeGraphic;
use Jenssegers\Date\Date;
use Psy\Util\Json;

class GraphicsController extends Controller
{
    public function index(Request $request)
    {
        if (View::exists('listGraphics')) {
            //Исключил неправильный параметр - если передадут стоку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 10 элементов

            $c = 10; // Количество показываемых элементов

            $grathics = TimeGraphic::all()->where('user_id', 'user_id', Auth::user()->id)->splice(($c * $page - $c), $c);
            $count = TimeGraphic::all()->where('user_id', 'user_id', Auth::user()->id)->count();

            return view('listGraphics', [
                'count_page' => (int)ceil($count/$c),
                'title' => 'Графики',
                'showPage' => $page,
                'items' => $grathics
            ]);
        }
    }
    public function getPageCreater(Request $request)
    {

        $devices = Device::all()->where('user_id', Auth::user()->id);

        $subArr = [];
        foreach ($devices as $device){
            if(TypeData::all()->where('device_id', $device->id)->count() != 0){
                foreach (TypeData::all()->where('device_id', $device->id) as $type){
                    array_push($subArr, [ 'id' => $type->alias, 'name' => $type->name ]);
                }
            }
        }

        return view('createTimeGraphic', [
            'title' => 'Создание графика',
            'types_data_JSON' => Json::encode($subArr),
            'types_data' => $subArr,
            'type' => 'POST'
        ]);
    }
    public function getPageUpdata(Request $request, $alias)
    {
        $devices = Device::all()->where('user_id', Auth::user()->id);

        $time_graphic = TimeGraphic::where('user_id', Auth::user()->id)->where('alias', $alias)->firstOrFail();

        $lines_time_graphic = LineTimeGraphic::all()->where('graphics_id', $time_graphic->id);

        $favorite_time_graphic_count = FavoriteTimeGraphics::all()->where('time_graphic_id', $time_graphic->id)->count();

        $subArr = [];
        foreach ($devices as $device){
            if(TypeData::all()->where('device_id', $device->id)->count() != 0){
                foreach (TypeData::all()->where('device_id', $device->id) as $type){
                    array_push($subArr, [ 'id' => $type->alias, 'name' => $type->name ]);
                }
            }
        }
        Date::setLocale('ru');
        return view('createTimeGraphic', [
            'title' => 'Изменение графика',
            'types_data_JSON' => Json::encode($subArr),
            'types_data' => $subArr,
            'timegraphic_id' => $time_graphic->id,
            'favorite_time_graphic' => (($favorite_time_graphic_count != 0)? 'checked': null),
            'name' => $time_graphic->name,
            'alias' => $time_graphic->alias,
//            'border_time' => (($time_graphic->border_time != 0)?((new Date($time_graphic->border_time, new DateTimeZone('Europe/Moscow')))->format('d-m-Y')): null),
            'border_time' => (($time_graphic->border_time != 0)?((new Date($time_graphic->border_time))->format('d-m-Y')): null),
            'description' => $time_graphic->description,
            'lines_time_graphic' => $lines_time_graphic,
            'type' => 'PUT'
        ]);
    }
    public function showGraphic(Request $request, $alias)
    {
        $time_graphic = TimeGraphic::where('user_id', Auth::user()->id)->where('alias', $alias)->firstOrFail();


        return view('showGraphic', [
            'type' => 'simple',
            'graphic_type' => 'timegraphic_simple',
            'graphic_id' => $time_graphic->id,
            'graphic_name' => $time_graphic->name
        ]);
    }
}

