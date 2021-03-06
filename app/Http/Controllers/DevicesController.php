<?php

namespace App\Http\Controllers;
use App\Data;
use App\Device;
use App\TypeData;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Predis\Cluster\Distributor\EmptyRingException;

class DevicesController extends Controller
{
    /**
     * @var Device
     */
//    protected $devices;

    /**
     * DevicesController constructor.
     * @param Device $devices
     */
    public function __construct(Device $devices)
    {
//        $this->devices = $devices;
//        Route::model('device',Device::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $devices = Auth::user()->devices()->paginate(10);
        return view('listDevices', [
            'items' => $devices
        ]);
    }
    public function getPageCreater()
    {
        return view('createDevice', [
            'title' => 'Создание устройств',
            'type' => 'POST',
            'token' => null,
            'name' => null,
            'description' => null
        ]);
    }
//    public function getPageUpdate(Device $device)
    public function getPageUpdate($id_device)
    {
        $device = Auth::user()->device($id_device);


        if($device){
            return view('createDevice', [
                'title' => 'Устройство '.$device->name,
                'type' => 'PUT',
                'device_id' => $device->id,
                'token' => $device->token,
                'name' => $device->name,
                'description' => $device->description
            ]);
        }else{
            return view('404', [
                'title' => 'Устройство не найдено.'
            ]);
        }
    }
    public function showDevice()
    {
        return "showDevice - показывает типы даннных этого устройства";
    }
}
