<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\TypeData;
use App\Device;
use App\Data;

use Illuminate\Http\Request;

class TypesDataController extends Controller
{
    public function index(Request $request, $device_id)
    {
        if (View::exists('listTypesOfDevice')) {
            //Исключил неправильный параметр - если передадут стоку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 10 элементов

            $c = 10; // Количество показываемых элементов

            $device = Device::where('id', $device_id)->where('user_id', Auth::user()->id)->firstOrFail();

            $types = TypeData::all()->where('device_id', $device->id)->splice(($c * $page - $c), $c);
            $count = TypeData::all()->where('device_id', $device->id)->count();

            return view('listTypesOfDevice', [
                'count_page' => (int)ceil($count/$c),
                'title' => 'Типы данных "'.$device->name.'".',
                'showPage' => $page,
                'device_id' => $device->id,
//                'device_name' => $device->name,
                'items' => $types
            ]);
        }
    }
    public function getPageCreater()
    {
        $devices = Device::all()->where('user_id', Auth::user()->id);

        return view('createTypeOfDevice', [
            'title' => 'Создание типа данных',
            'type' => 'POST',
            'devices' => $devices,
            'device' => null,
            'name' => null,
            'alias' => null,
            'description' => null
        ]);
    }
    public function getPageUpdate($alias)
    {

        $type = TypeData::where('alias', $alias)->firstOrFail();

        $device = Device::where('id', $type->device_id)->where('user_id', Auth::user()->id)->firstOrFail();

        $devices = Device::all()->where('user_id', Auth::user()->id);

        return view('createTypeOfDevice', [
            'title' => 'Устройство '.$type->name,
            'type' => 'PUT',
            'devices' => $devices,
            'device' => $device,
            'typeofdevice_id' => $type->id,
            'name' => $type->name,
            'alias' => $type->alias,
            'description' => $type->description
        ]);
    }
    public function showTypeData(Request $request, $device_id, $alias_type)
    {
        if (View::exists('listDataOfType')) {
            //Исключил неправильный параметр - если передадут стоку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 50 элементов
            $c = 50; // Количество показываемых элементов

            $device = Device::where('id', $device_id)->where('user_id', Auth::user()->id)->firstOrFail();
            $type = TypeData::where('alias', $alias_type)->where('device_id', $device->id)->firstOrFail();

            $data = Data::all()->where('device_id', $device->id)->where('alias', $type->alias)->splice(($c * $page - $c), $c);
            $count = Data::all()->where('device_id', $device->id)->where('alias', $type->alias)->count();

            return view('listDataOfType', [
                'count_page' => (int)ceil($count/$c),
                'showPage' => $page,
                'device_id' => $device->id,
                'type_id' => $type->id,
                'type_name' => $type->name,
                'items' => $data
            ]);
        }
    }
    public function showAllTypeData(Request $request, $alias_type){
        if (View::exists('listDataOfType')) {

            //Исключил неправильный параметр - если передадут строку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 50 элементов
            $c = 50; // Количество показываемых элементов

            foreach (Device::all()->where('user_id', Auth::user()->id) as $device){

                if(TypeData::all()->where('alias', $alias_type)->where('device_id', $device->id)->count() == 1){

                    $type = TypeData::where('alias', $alias_type)->where('device_id', $device->id)->firstOrFail();

                    $data = Data::all()->where('device_id', $device->id)->where('alias', $type->alias)->splice(($c * $page - $c), $c);
                    $count = Data::all()->where('device_id', $device->id)->where('alias', $type->alias)->count();

                    return view('listDataOfType', [
                        'count_page' => (int)ceil($count/$c),
                        'showPage' => $page,
                        'device_id' => $device->id,
                        'type_id' => $type->id,
                        'type_name' => $type->name,
                        'items' => $data
                    ]);
                }
            }

            return view('404');

        }

    }
    public function showTypesData(Request $request)
    {

        if (View::exists('listTypesOfDevice')) {
            //Исключил неправильный параметр - если передадут стоку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 10 элементов

            $c = 10; // Количество показываемых элементов

            $devices = Device::all()->where('user_id', Auth::user()->id);

            $subArr = [];
            foreach ($devices as $device){
                if(TypeData::all()->where('device_id', $device->id)->count() != 0){
                    foreach (TypeData::all()->where('device_id', $device->id) as $type){
                        array_push($subArr, [ 'id' => $type->id, 'name' => $type->name, 'alias' => $type->alias, 'description' => $type->description, '	device_id' => $type->device_id ]);
                    }
                }
            }
            $count = count($subArr);

            $subArr = array_slice($subArr, ($c * $page - $c), $c);

            return view('listTypesOfDevice', [
                'count_page' => (int)ceil($count/$c),
                'title' => 'Все типы данных',
                'all' => 'all', // Маркировка страницы всех типов данных для таблицы
                'showPage' => $page,
                'device_id' => null,
                'device_name' => null,
                'items' => $subArr
            ]);
        }
    }
}
