<?php

namespace App\Http\Controllers;

use App\LineTimeGraphic;
use App\TimeGraphic;
use App\TypeData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpParser\Node\Expr\Array_;
use PHPUnit\Runner\Exception;
use Psy\Util\Json;

use DateTimeZone;
use App\Device;
use App\User;
use App\Data;
use App\FavoriteTimeGraphics;
use Jenssegers\Date\Date;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        switch ($request->input('get')) {
            case 'token':
                return response()->json(ServiceController::getToken(Auth::user()->id, $request->input('id'), $request->input('target')));
                break;
            case 'graphic':
                return response()->json(ServiceController::getGraphic(Auth::user()->id, $request->input('id'), $request->input('target')));
                break;
            default:
                return response()->json(['res' => 'fail']);
                break;
        }
    }

    public function store(Request $request)
    {
        switch ($request->input('target')) {
            case 'device':
                return response()->json(ServiceController::postDevice(Auth::user()->id, $request->all('token', 'device_id', 'description', 'name')));
                break;
            case 'typeofdevice':
                return response()->json(ServiceController::postTypeOfData(Auth::user()->id, $request->all('alias', 'device_id', 'description', 'name')));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::postTimeGraphic(Auth::user()->id, $request->all()));
                break;
            case 'data':
                return response()->json(ServiceController::postData(Auth::user()->id, $request->all()));
                break;
            default:
//                return response()->json(['res' => 'fail']);
                return response()->json($request->all());
                break;
        }

    }

    public function update(Request $request)
    {
        switch ($request->input('target')) {
            case 'device':
                return response()->json(ServiceController::updateDevice(Auth::user()->id, $request->all('token', 'device_id', 'description', 'name')));
                break;
            case 'typeofdevice':
                return response()->json(ServiceController::updateTypeOfData(Auth::user()->id, $request->all('alias', 'device_id', 'description', 'name', 'typeofdevice_id')));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::updateTimeGraphic(Auth::user()->id, $request->all()));
                break;
            default:
//                return response()->json(['res' => 'fail']);
                return response()->json($request->all());
                break;
        }
    }

    public function destroy(Request $request)
    {

        switch ($request->input('target')) {
            case 'device':
                return response()->json(ServiceController::delDevice(Auth::user()->id, $request->input('id')));
                break;
            case 'typeofdata':
                return response()->json(ServiceController::delTypeOfData(Auth::user()->id, $request->input('id')));
                break;
            case 'data':
                return response()->json(ServiceController::delData(Auth::user()->id, $request->input('id')));
                break;
            case 'all_data':
                return response()->json(ServiceController::delAllData(Auth::user()->id, $request->all()));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::delTimeGraphic(Auth::user()->id, $request->input('id')));
                break;
            default:
                return response()->json(['res' => 'fail']);
                break;
        }

    }

    public function updateDevice($user_id, $all)
    {

        $target = Device::where('id', '=', $all['device_id'])->where('user_id', $user_id)->firstOrFail();
        $target->update(['name' => $all['name'], 'description' => $all['description'], 'token' => $all['token']]);
        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'confirmed'
            ],
            'mes' => 'Устройство "' . $all['name'] . '" обновлено!'
        ];
    }

    public function postDevice($user_id, $all)
    {

        Device::Create(['user_id' => $user_id, 'name' => $all['name'], 'description' => $all['description'], 'token' => $all['token']]);
        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'saveDevice'
            ],
            'mes' => 'Устройство "' . $all['name'] . '" добалено!'
        ];
    }

    public function postTypeOfData($user_id, $all)
    {
        $device = Device::where('id', $all['device_id'])->where('user_id', $user_id)->firstOrFail();

        if(TypeData::all()->where('device_id', $device->id)->where('alias', $all['alias'])->count() == 0){
            TypeData::Create(['device_id' => $device->id, 'name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias']]);
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'saveTypeOfDevice'
                ],
                'mes' => 'Тип данных "' . $all['name'] . '" добален!'
            ];
        }else{
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'notconfirmed'
                ],
                'mes' => 'Совпадение псевдонимов недопустимо!'
            ];
        }


    }

    public function postData($user_id, $all)
    {

        if($all['rol'] == 'demo'){

            foreach (Device::all()->where('user_id', $user_id) as $device){

                foreach (TypeData::all()->where('device_id', $device->id) as $type_device){

                    if($type_device->id == $all['id']){

                        for ($i = 1; $i <= 100; $i++){
//                            Data::firstOrCreate(['device_id' => $device->id, 'value' => rand(5, 200), 'alias' => $type_device->alias, 'time' => (new Date(1519731325, new DateTimeZone('Europe/Moscow')))->add($i.' hour')->format('U')]);
                            Data::firstOrCreate(['device_id' => $device->id, 'value' => rand(5, 200), 'alias' => $type_device->alias, 'time' => (new Date(1519731325))->add($i.' hour')->format('U')]);
                        }

                        return [
                            'res' => 'ok',
                            'callback' => [
                                'type' => 'add_demo_data'
                            ],
                            'mes' => 'Демо данные добавлены.'
                        ];

                    }

                }

            }

            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'notconfirmed'
                ],
                'mes' => 'Добавить демо данные не удалось!'
            ];

        }

    }

    public function postTimeGraphic($user_id, $all)
    {

        if(TimeGraphic::all()->where('user_id', $user_id)->where('alias', $all['alias'])->count() == 0){

//            $time_graphic = TimeGraphic::firstOrCreate(['name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias'], 'user_id' => $user_id, 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00', new DateTimeZone('Europe/Moscow')))->format('U')))]);
            $time_graphic = TimeGraphic::firstOrCreate(['name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias'], 'user_id' => $user_id, 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00'))->format('U')))]);

            if(! empty($all['time_line']) ){

                for($i = 0; $i < count($all['time_line']); $i += 3){

                    LineTimeGraphic::firstOrCreate(['graphics_id' => $time_graphic->id, 'name' => $all['time_line'][$i], 'data_alias' => $all['time_line'][$i+1], 'color' => $all['time_line'][$i+2]]);

                }

            }

            if(! empty($all['favorites']) ){
                FavoriteTimeGraphics::firstOrCreate(['time_graphic_id' => $time_graphic->id]);
            }

            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'confirmed'
                ],
                'mes' => 'График "' . $all['name'] . '" добален!'
            ];

        }else{
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'notconfirmed'
                ],
                'mes' => 'Совпадение псевдонимов недопустимо!'
            ];
        }
    }

    public function updateTimeGraphic($user_id, $all)
    {
        $time_graphic = TimeGraphic::where('id', $all['timegraphic_id'])->where('user_id', $user_id)->firstOrFail();
        if($time_graphic->alias == $all['alias'] || ($time_graphic->alias != $all['alias'] && TimeGraphic::all()->where('user_id', $user_id)->where('alias', $all['alias'])->count() == 0)){
//            $time_graphic->update(['alias' => $all['alias'], 'name' => $all['name'], 'description' => $all['description'], 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00', new DateTimeZone('Europe/Moscow')))->format('U')))]);
            $time_graphic->update(['alias' => $all['alias'], 'name' => $all['name'], 'description' => $all['description'], 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00'))->format('U')))]);
            foreach (LineTimeGraphic::all()->where('graphics_id', $time_graphic->id) as $line_time_graphic){
                LineTimeGraphic::destroy($line_time_graphic->id);
            }
            if(! empty($all['time_line']) ){

                for($i = 0; $i < count($all['time_line']); $i += 3){

                    LineTimeGraphic::firstOrCreate(['graphics_id' => $time_graphic->id, 'name' => $all['time_line'][$i], 'data_alias' => $all['time_line'][$i+1], 'color' => $all['time_line'][$i+2]]);

                }

            }

            foreach (FavoriteTimeGraphics::all()->where('time_graphic_id', $time_graphic->id) as $favorite_time_graphics){
                FavoriteTimeGraphics::destroy($favorite_time_graphics->id);
            }

            if(! empty($all['favorites']) ){
                FavoriteTimeGraphics::firstOrCreate(['time_graphic_id' => $time_graphic->id]);
            }

            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'confirmed'
                ],
                'mes' => 'График "' . $all['name'] . '" обновлен!'
            ];
        }else{
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'notconfirmed'
                ],
                'mes' => 'Совпадение псевдонимов недопустимо!'
            ];
        }

    }

    public function updateTypeOfData($user_id, $all){

        $target = TypeData::where('id', $all['typeofdevice_id'])->firstOrFail();

        Device::where('id', $target->device_id)->where('user_id', $user_id)->firstOrFail();

        $device = Device::where('id', $all['device_id'])->where('user_id', $user_id)->firstOrFail();

        $target->update(['device_id' => $device->id, 'name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias']]);

        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'confirmed'
            ],
            'mes' => 'Тип данных "' . $all['name'] . '" обновлено!'
        ];
    }

    public function getToken($user_id, $device_id, $target)
    {


        switch ($target) {
            case 'device':
                $target = Device::where('id', $device_id)->where('user_id', $user_id)->firstOrFail();
                $target_id = $target->id;
                $target_token = $target->token;
                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'showToken',
                        'name' => 'device',
                        'id' => $target_id
                    ],
                    'mes' => $target_token
                ];
                break;
            default:
                return ['res' => 'fail'];
                break;
        }

    }

    public function sortedByTime($data){
        return $data->time;
    }

    public function getGraphic($user_id, $graphic_id, $target)
    {


        switch ($target) {
            case 'timegraphic_simple':

                $timegraphic = TimeGraphic::where('user_id', $user_id)->where('id', $graphic_id[0])->firstOrFail();

                $data = [];

                foreach (LineTimeGraphic::all()->where('graphics_id', $timegraphic->id) as $time_line){

                    $arrdata = [];

                    foreach (Device::all()->where('user_id', $user_id) as $device){

                        foreach (TypeData::all()->where('device_id', $device->id)->where('alias', $time_line->data_alias) as $type_data){

                            $data_unsorted = Data::all()->where('device_id', $device->id)->where('alias', $type_data->alias)->where('time', '>', $timegraphic->border_time);

                            $data_sorted = $data_unsorted->sortBy("time");

                            foreach ($data_sorted as $one_data){

                                array_push($arrdata, [ $one_data->time * 1000, $one_data->value ]);

                            }

                        }

                    }

                    array_push($data, [ 'name' => $time_line->name, 'data' => $arrdata, 'color' => $time_line->color ]);

                }

                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'graphic_show',
                        'graphic_type' => 'timegraphic',
                        'target' => [
                            [
                                'selector' => ('timegraphic-'.$timegraphic->id),
                                'title' => $timegraphic->name,
                                'data' => $data,
                                'mes' => 'График "'.$timegraphic->name.'" сформирован!'
                            ]
                        ]
                    ]
                ];
                break;
            case 'timegraphic_multi':

                $target = [];

                foreach ($graphic_id as $g_id){

                    $timegraphic = TimeGraphic::where('user_id', $user_id)->where('id', $g_id)->firstOrFail();

                    $data = [];

                    foreach (LineTimeGraphic::all()->where('graphics_id', $timegraphic->id) as $time_line){

                        $arrdata = [];

                        foreach (Device::all()->where('user_id', $user_id) as $device){

                            foreach (TypeData::all()->where('device_id', $device->id)->where('alias', $time_line->data_alias) as $type_data){

                                $data_unsorted = Data::all()->where('device_id', $device->id)->where('alias', $type_data->alias)->where('time', '>', $timegraphic->border_time);

                                $data_sorted = $data_unsorted->sortBy("time");

                                foreach ($data_sorted as $one_data){

                                    array_push($arrdata, [ $one_data->time * 1000, $one_data->value ]);

                                }

                            }

                        }

                        array_push($data, [ 'name' => $time_line->name, 'data' => $arrdata, 'color' => $time_line->color ]);

                    }

                    array_push($target, ['selector' => ('timegraphic-'.$timegraphic->id), 'title' => $timegraphic->name, 'data' => $data, 'mes' => 'График "'.$timegraphic->name.'" сформирован!']);

                }

                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'graphic_show',
                        'graphic_type' => 'timegraphic',
                        'target' => $target
                    ]
                ];
                break;
            default:
                return ['res' => 'fail'];
                break;
        }

    }

    public function delDevice($user_id, $device_id)
    {

        $target = Device::where('id', '=', $device_id)->where('user_id', $user_id)->firstOrFail();

        $target_id = $target->id;
        $target_name = $target->name;
        Device::destroy($target_id);

        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'remove',
                'name' => 'device',
                'id' => $target_id
            ],
            'mes' => 'Устройство "' . $target_name . '" удалено!'
        ];
    }

    public function delTypeOfData($user_id, $id_typeofdata)
    {

        foreach (Device::all()->where('user_id', $user_id) as $device){

            foreach (TypeData::all()->where('device_id', $device->id) as $target){

                if($target->id == $id_typeofdata){
                    $target_id = $target->id;
                    $target_name = $target->name;

                    TypeData::destroy($target_id);
                    return [
                        'res' => 'ok',
                        'callback' => [
                            'type' => 'remove',
                            'name' => 'typeofdata',
                            'id' => $target_id
                        ],
                        'mes' => 'Тип данных "' . $target_name . '" удалено!'
                    ];
                }

            }

        }

        return ['res' => 'fail'];
    }

    public function delData($user_id, $data_id)
    {

        foreach (Device::all()->where('user_id', $user_id) as $device){

            foreach (TypeData::all()->where('device_id', $device->id) as $type){

                foreach (Data::all()->where('alias', $type->alias)->where('device_id', $device->id) as $target){

                    if($target->id == $data_id){
                        $target_id = $target->id;
                        $target_created_at = $target->created_at;
                        Data::destroy($target_id);

                        return [
                            'res' => 'ok',
                            'callback' => [
                                'type' => 'remove',
                                'name' => 'data',
                                'id' => $target_id
                            ],
                            'mes' => 'Данные за "' . $target_created_at . '" удалено!'
                        ];

                    }

                }

            }

        }

        return ['res' => 'fail'];
    }

    public function delAllData($user_id, $all)
    {



        foreach (Device::all()->where('user_id', $user_id) as $device){

            foreach (TypeData::all()->where('device_id', $device->id) as $type_device){

                if($type_device->id == $all['id']){

                    $data = Data::all()->where('alias', $type_device->alias)->where('device_id', $device->id)->modelKeys();
                    Data::destroy($data);

                    return [
                        'res' => 'ok',
                        'callback' => [
                            'type' => 'add_demo_data'
                        ],
                        'mes' => 'Все данные удалены.'
                    ];

                }

            }

        }

        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'notconfirmed'
            ],
            'mes' => 'Удалить все данные не удалось!'
        ];

    }

    public function delTimeGraphic($user_id, $id)
    {

        $target = TimeGraphic::where('id', $id)->where('user_id', $user_id)->firstOrFail();

        $target_id = $target->id;
        $target_name = $target->name;
        TimeGraphic::destroy($target_id);

        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'remove',
                'name' => 'timegraphic',
                'id' => $target_id
            ],
            'mes' => 'График "' . $target_name . '" удалено!'
        ];
    }
}
