<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master_data;
use App\Models\geolocation;
use App\Models\Otherinfo;
use App\Models\Sdgtbl;

class TheperareaController extends Controller
{
    //

    function index() {
        $collection = Master_data::get(["title","masterid"]);
        $sdg        = Sdgtbl::all();

        return view("input_dashboard", compact("collection","sdg"));
    }

    function province_info() {
        return view("province_input");
    }

    function get_location(Request $req) {
        $masterid   = $req->input("masterid");

        $collection = Master_data::where("masterid",$masterid)->get(["target_location"])->toArray();
        $location   = geolocation::where("master_dataid",$masterid)->get(["lat","lng"])->toArray();

        return response()->json([$collection,$location]);
    }

    function save_sdg(Request $req) {
        $activity_id = $req->input("activityid");
        $sdgid       = $req->input("sdgid");

        $update      = Master_data::where("masterid",$activity_id)->update(["thrust_1_sdg"=>$sdgid]);

        return response()->json($update);
    }

    function save_location(Request $req) {
        $masterid       = $req->input("masterid");
        $columnplace    = $req->input("columnplace");
        $lat            = $req->input("lat");
        $lng            = $req->input("lng");

        $data                = new geolocation();
        $data->master_dataid = $masterid;
        $data->columnplace   = $columnplace;
        $data->lat           = $lat;
        $data->lng           = $lng;
        $data->save();

        return response()->json($data);
    }

    function save_province_info(Request $req) {
        $location    = $req->input("location");
        $loc_text    = $req->input("loc_text");
        $htmlmap     = $req->input("htmlmap");
        $theheader   = $req->input("theheader");
        $thevalue    = $req->input("thevalue");

        $otherinfo             = new Otherinfo();
        $otherinfo->theplace   = $location;
        $otherinfo->htmlmap    = $htmlmap;
        $otherinfo->theheader  = $theheader;
        $otherinfo->thevalue   = $thevalue;
        $otherinfo->save();

        return response()->json($otherinfo);
    }
}
