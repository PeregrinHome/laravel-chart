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
//        dd(Auth::user()->typesOfDevice($device_id)->get());
        $device = Auth::user()->device($device_id);
        if($device){
            $types = $device->typesData()->paginate(10);
            return view('listTypesOfDevice', [
                'title' => 'Типы данных "'.$device->name.'".',
                'device_id' => $device->id,
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
        $device = Auth::user()->device($device_id);
        $type = Auth::user()->typeOfDevice($device_id, $alias_type)->get()->first();
        if($device && $type){
            $data = Data::where('alias', $type->alias)->where('device_id', $device->id)->paginate(10);
            return view('listDataOfType', [
                'device_id' => $device->id,
                'type_id' => $type->id,
                'type_name' => $type->name,
                'items' => $data
            ]);
        }
        return view('404');
    }
    public function showAllTypeData(Request $request, $alias_type){


        foreach (Auth::user()->devices as $device){

            $type = $device->typeData($alias_type)->get()->first();
            if($type){
                $data = Data::where('device_id', $device->id)->where('alias', $type->alias)->paginate(10);
                return view('listDataOfType', [
                    'device_id' => $device->id,
                    'type_id' => $type->id,
                    'type_name' => $type->name,
                    'items' => $data
                ]);
            }
        }

        return view('404');

    }
    public function showTypesData(Request $request)
    {
        $allTypes = Auth::user()->allTypes()->paginate(10);

        return view('listTypesOfDevice', [
            'title' => 'Все типы данных',
            'all' => 'all', // Маркировка страницы всех типов данных для таблицы
            'device_id' => null,
            'device_name' => null,
            'items' => $allTypes
        ]);
    }
}
