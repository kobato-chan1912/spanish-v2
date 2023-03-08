<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    //
    public function index()
    {
        $ads = Ad::all();
        return view("ads.index", compact('ads'));
    }

    public function create(Request $request)
    {
        $adsName = $request->get("ads_name");
        $adsScript = $request->get("ads_script");
        Ad::create(["name" => $adsName, "script" => $adsScript]);
        return redirect()->back()->with(["message" => "Tạo ads thành công!"]);
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            "ads_name" => 'required'
        ]);
        $adsName = $request->get("ads_name");
        $adsScript = $request->get("ads_script");
        Ad::where("id", $id)->update(["name" => $adsName, "script" => $adsScript]);

        return redirect()->back()->with(["message" => "Cập nhật ads thành công!"]);

    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        Ad::where("id", $id)->delete();
        return response()->json(["message" => "Ads is deleted successfully!"]);
    }

    public function setHomeAd($id){
        if(Ad::where("home_ads", 1)->exists()){
            Ad::where("home_ads", 1)->update(["home_ads" => 0]);
        }
        Ad::where("id", $id)->update(["home_ads" => 1]);
        return redirect()->back()->with(["message" => "Home Ads Set Successfully!"]);
    }
}
