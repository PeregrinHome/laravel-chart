<?php

namespace App\Http\Controllers;
use App\Data;
use App\Device;
use App\TypeData;
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
    protected $devices;

    /**
     * DevicesController constructor.
     * @param Device $devices
     */
    public function __construct(Device $devices)
    {
        $this->devices = $devices;
//        Route::model('device',Device::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (View::exists('listDevices')) {
            //Исключил неправильный параметр - если передадут стоку, преобразование закончится не 0, а 1.
            $page = (int)$request->query('page', '1');
            $page = ($page == 0)? 1 : $page;

            // Пагинация, по 10 элементов

            $c = 10; // Количество показываемых элементов

            $devices = Device::all()->where('user_id', Auth::user()->id)->splice(($c * $page - $c), $c);
            $count = Device::all()->where('user_id', Auth::user()->id)->count();

            return view('listDevices', [
                'count_page' => (int)ceil($count/$c),
                'showPage' => $page,
                'items' => $devices
            ]);
        }
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
    public function getPageUpdate($id_device)
    {
        if(Device::all()->where('id', $id_device)->where('user_id', Auth::user()->id)->count() == 1){
            $device = Device::where('id', $id_device)->firstOrFail();

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
