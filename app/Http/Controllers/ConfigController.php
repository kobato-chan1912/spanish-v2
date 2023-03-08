<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //
    public function index()
    {
        $configs = Config::all();
        return view("config.index", compact('configs'));
    }

    public function update(Request $request)
    {
        $requests = $request->all();
        foreach ($requests as $key => $data){
            Config::where("config_name", $key)->update(["config_value" => $data]);
        }
        return redirect()->back()->with(["message" => "Update thành công!"]);
    }
}
