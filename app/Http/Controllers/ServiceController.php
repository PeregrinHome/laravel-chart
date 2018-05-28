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
                return response()->json(ServiceController::getToken(Auth::user(), $request->input('id'), $request->input('target')));
                break;
            case 'graphic':
                return response()->json(ServiceController::getGraphic(Auth::user(), $request->input('id'), $request->input('target')));
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
                return response()->json(ServiceController::postDevice(Auth::user(), $request->all('token', 'device_id', 'description', 'name')));
                break;
            case 'typeofdevice':
                return response()->json(ServiceController::postTypeOfData(Auth::user(), $request->all('alias', 'device_id', 'description', 'name')));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::postTimeGraphic(Auth::user(), $request->all()));
                break;
            case 'data':
                return response()->json(ServiceController::postData(Auth::user(), $request->all()));
                break;
            default:
                return response()->json(['res' => 'fail']);
//                return response()->json($request->all());
                break;
        }

    }

    public function update(Request $request)
    {
        switch ($request->input('target')) {
            case 'device':
                return response()->json(ServiceController::updateDevice(Auth::user(), $request->all('token', 'device_id', 'description', 'name')));
                break;
            case 'typeofdevice':
                return response()->json(ServiceController::updateTypeOfData(Auth::user(), $request->all('alias', 'device_id', 'description', 'name', 'typeofdevice_id')));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::updateTimeGraphic(Auth::user(), $request->all()));
                break;
            default:
                return response()->json(['res' => 'fail']);
//                return response()->json($request->all());
                break;
        }
    }

    public function destroy(Request $request)
    {

        switch ($request->input('target')) {
            case 'device':
                return response()->json(ServiceController::delDevice(Auth::user(), $request->input('id')));
                break;
            case 'typeofdata':
                return response()->json(ServiceController::delTypeOfData(Auth::user(), $request->input('id')));
                break;
            case 'data':
                return response()->json(ServiceController::delData(Auth::user(), $request->input('id')));
                break;
            case 'all_data':
                return response()->json(ServiceController::delAllData(Auth::user(), $request->all()));
                break;
            case 'timegraphic':
                return response()->json(ServiceController::delTimeGraphic(Auth::user(), $request->input('id')));
                break;
            default:
                return response()->json(['res' => 'fail']);
                break;
        }

    }

    public function updateDevice($user, $all)
    {
        $device = $user->devices()->find($all['device_id']);
        if($device){
            $device->update(['name' => $all['name'], 'description' => $all['description'], 'token' => $all['token']]);
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'confirmed'
                ],
                'mes' => 'Устройство "' . $device->name . '" обновлено!'
            ];
        }
        return ['res' => 'fail'];
    }

    public function postDevice($user, $all)
    {

        Device::create(['user_id' => $user->id, 'name' => $all['name'], 'description' => $all['description'], 'token' => $all['token']]);
        return [
            'res' => 'ok',
            'callback' => [
                'type' => 'saveDevice'
            ],
            'mes' => 'Устройство "' . $all['name'] . '" добалено!'
        ];
    }

    public function postTypeOfData($user, $all)
    {
        $device = $user->devices()->find($all['device_id']);
        if($device){
            if(TypeData::where('device_id', $device->id)->where('alias', $all['alias'])->get()->count() == 0){
                TypeData::create(['device_id' => $device->id, 'name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias']]);
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
        return ['res' => 'fail'];
    }

    public function postData($user, $all)
    {

        if($all['rol'] == 'demo'){
            $type = $user->allTypes()->find($all['id']);
            if($type){
                date_default_timezone_set("UTC");
                $save = [];
                for ($i = 1; $i <= 100; $i++){
                    $save[] = ['device_id' => $type->device_id, 'value' => rand(5, 200), 'alias' => $type->alias, 'time' => (new Date())->add($i.' hour')->format('U')];
                }
                $type->data()->createMany($save);
                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'add_demo_data'
                    ],
                    'mes' => 'Демо данные добавлены.'
                ];
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

    public function postTimeGraphic($user, $all)
    {
        $user_id = $user->id;
        if(TimeGraphic::where('user_id', $user_id)->where('alias', $all['alias'])->get()->count() == 0){

            $time_graphic = TimeGraphic::create(['name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias'], 'user_id' => $user_id, 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00'))->format('U')))]);

            if(! empty($all['time_line']) ){

                for($i = 0; $i < count($all['time_line']); $i += 3){

                    LineTimeGraphic::create(['graphics_id' => $time_graphic->id, 'name' => $all['time_line'][$i], 'data_alias' => $all['time_line'][$i+1], 'color' => $all['time_line'][$i+2]]);

                }

            }

            if(! empty($all['favorites']) ){
                FavoriteTimeGraphics::create(['time_graphic_id' => $time_graphic->id]);
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

    public function updateTimeGraphic($user, $all)
    {
        $time_graphic = TimeGraphic::where('id', $all['timegraphic_id'])->where('user_id', $user->id)->firstOrFail();
        if($time_graphic->alias == $all['alias'] || ($time_graphic->alias != $all['alias'] && TimeGraphic::where('user_id', $user->id)->where('alias', $all['alias'])->get()->count() == 0)){
            $time_graphic->update(['alias' => $all['alias'], 'name' => $all['name'], 'description' => $all['description'], 'border_time' => (($all['border_time'] == null)? 0 : ((new Date($all['border_time'].' 00:00:00'))->format('U')))]);
            LineTimeGraphic::where('graphics_id', $time_graphic->id)->delete();
            if(! empty($all['time_line']) ){

                for($i = 0; $i < count($all['time_line']); $i += 3){

                    LineTimeGraphic::create(['graphics_id' => $time_graphic->id, 'name' => $all['time_line'][$i], 'data_alias' => $all['time_line'][$i+1], 'color' => $all['time_line'][$i+2]]);

                }

            }

            FavoriteTimeGraphics::where('time_graphic_id', $time_graphic->id)->delete();

            if(! empty($all['favorites']) ){
                FavoriteTimeGraphics::create(['time_graphic_id' => $time_graphic->id]);
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

    public function updateTypeOfData($user, $all){

            $type = $user->allTypes()->find($all['typeofdevice_id']);
            $device = $user->device($all['device_id']);
            if($type && $device){
                $type->update(['device_id' => $device->id, 'name' => $all['name'], 'description' => $all['description'], 'alias' => $all['alias']]);
                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'confirmed'
                    ],
                    'mes' => 'Тип данных "' . $all['name'] . '" обновлено!'
                ];
            }else{
                return [
                    'res' => 'ok',
                    'callback' => [
                        'type' => 'notconfirmed'
                    ],
                    'mes' => 'Обновить тип данных не удалось!'
                ];
            }

    }

    public function getToken($user, $device_id, $target)
    {
        switch ($target) {
            case 'device':
                $device = $user->device($device_id);
                if($target){
                    $device_id = $device->id;
                    $device_token = $device->token;
                    return [
                        'res' => 'ok',
                        'callback' => [
                            'type' => 'showToken',
                            'name' => 'device',
                            'id' => $device_id
                        ],
                        'mes' => $device_token
                    ];
                }else{
                    return ['res' => 'fail'];
                }
                break;
            default:
                return ['res' => 'fail'];
                break;
        }

    }

    public function sortedByTime($data){
        return $data->time;
    }

    public function getGraphic($user, $graphic_id, $target)
    {
        switch ($target) {
            case 'timegraphic_simple':
                $timegraphic = $user->graphics()->findOrFail($graphic_id[0]);

                $data = [];

                foreach (LineTimeGraphic::where('graphics_id', $timegraphic->id)->get() as $time_line){

                    $arrdata = [];

                    //TODO: Пагинация тут необходима, но пока оставим так.
                    $data_unsorted = $user->allTypes()->where('alias', $time_line->data_alias)->get()->first()->data()->where('time', '>', $timegraphic->border_time)->get();
                    $data_sorted = $data_unsorted->sortBy("time");
                    foreach ($data_sorted as $one_data){

                        $arrdata[] = [ $one_data->time * 1000, $one_data->value ];

                    }

                    $data[] = [ 'name' => $time_line->name, 'data' => $arrdata, 'color' => $time_line->color ];

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

                    $timegraphic = $user->graphics()->findOrFail($g_id);

                    $data = [];

                    foreach (LineTimeGraphic::where('graphics_id', $timegraphic->id)->get() as $time_line){

                        $arrdata = [];

                        $data_unsorted = $user->allTypes()->where('alias', $time_line->data_alias)->get()->first()->data()->where('time', '>', $timegraphic->border_time)->get();
                        $data_sorted = $data_unsorted->sortBy("time");
                        foreach ($data_sorted as $one_data){

                            $arrdata[] = [ $one_data->time * 1000, $one_data->value ];

                        }

                        $data[] = [ 'name' => $time_line->name, 'data' => $arrdata, 'color' => $time_line->color ];

                    }

                    $target[] = ['selector' => ('timegraphic-'.$timegraphic->id), 'title' => $timegraphic->name, 'data' => $data, 'mes' => 'График "'.$timegraphic->name.'" сформирован!'];

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

    public function delDevice($user, $device_id)
    {
        $device = $user->devices()->find($device_id);
        if($device){
            $device_id = $device->id;
            $device_name = $device->name;
            $device->delete();
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'remove',
                    'name' => 'device',
                    'id' => $device_id
                ],
                'mes' => 'Устройство "' . $device_name . '" удалено!'
            ];
        }
        return ['res' => 'fail'];
    }

    public function delTypeOfData($user, $id_typeofdata)
    {
        $type = $user->allTypes()->find($id_typeofdata);

        if($type){
            $type_id = $type->id;
            $type_name = $type->name;
            $type->delete();
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'remove',
                    'name' => 'typeofdata',
                    'id' => $type_id
                ],
                'mes' => 'Тип данных "' . $type_name . '" удалено!'
            ];
        }

        return ['res' => 'fail'];
    }

    public function delData($user, $data_id)
    {
            $data = Data::find($data_id);
            if($data){
                $device = $user->devices()->find($data->device_id);
                if($device){
                    $data_id = $data->id;
                    $data_created_at = $data->created_at;
                    $data->delete();
                    return [
                        'res' => 'ok',
                        'callback' => [
                            'type' => 'remove',
                            'name' => 'data',
                            'id' => $data_id
                        ],
                        'mes' => 'Данные за "' . $data_created_at . '" удалено!'
                    ];
                }
            }

        return ['res' => 'fail'];
    }

    public function delAllData($user, $all)
    {
        $type = $user->allTypes()->find($all['id']);
        if($type){
            Data::where('device_id', $type->device_id)->where('alias', $type->alias)->delete();
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'add_demo_data'
                ],
                'mes' => 'Все данные удалены.'
            ];
        }else{
            return [
                'res' => 'ok',
                'callback' => [
                    'type' => 'notconfirmed'
                ],
                'mes' => 'Удалить все данные не удалось!'
            ];
        }
    }

    public function delTimeGraphic($user, $id)
    {

        $target = TimeGraphic::where('id', $id)->where('user_id', $user->id)->firstOrFail();

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
