<?php

namespace App\Http\Controllers\API;

use App\Data;
use App\Device;
use App\Http\Controllers\Controller;
use App\TypeData;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class DataController extends Controller
{

    public function index()
    {
        return "index";
    }
    public function store(Request $request)
    {

        $token = $request->input('token','error');
        if($token=="error") {
            $strReq = str_replace(array("nan", "NaN", "Nan", "NAN"), "null", $request->getContent());
//            return $strReq;
            $data = json_decode($strReq, true);
            $request->replace($data);
        }

        $device = Device::where('token', $request->input('token'))->firstOrFail();

        foreach ($request->input('fulldata') as $one_data){

            $type_data = TypeData::where('alias', $one_data['alias'])->where('device_id', $device->id)->firstOrFail();
            
            if($one_data['data'] != null && ! empty($one_data['data']) && !is_nan($one_data['data'])){
                Data::firstOrCreate(['device_id' => $device->id, 'value' => (double)$one_data['data'], 'alias' => $type_data->alias, 'time' => (new Date())->format('U')]);
            }
        }

//        return $request->input('fulldata')[0]['alias'];
        return 'ok';
    }
    public function update()
    {
        return "update";
    }
    public function destroy()
    {
        return "destroy";
    }

}
