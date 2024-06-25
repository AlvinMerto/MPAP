<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\themap;
use App\Models\ProjectsTbl;
use App\Models\theperarea;
use App\Models\theyield;

class ThemapController extends Controller
{
    //

    function index() {
        return view("themap");
    }

    function theareas(Request $req) {
        $sector = $req->input("sector");
        $funder = $req->input("funder");

        // $collection = themap::all();

        $collection;

        $collection = ProjectsTbl::all(); 
        
        if ($sector == "false" && $funder == "false") {
            $collection = ProjectsTbl::all();    
        }
        
        if ($sector != "false") {
            $collection = ProjectsTbl::where("sector",$sector)->get();
        }

        if ($funder != "false") {
            $collection = ProjectsTbl::where("projectdonortext",$funder)->get();
        }

        if ($sector != "false" && $funder != "false") {
            $collection = ProjectsTbl::where(["sector"=>$sector,"projectdonortext"=>$funder])->get();
        }
        
        $areas      = [];

        foreach($collection as $c) {
            array_push($areas, [$c->longitude,$c->latitude]);
        }

        return response()->json($areas);
    }

    function project_details(Request $req) {
        $lat   = $req->input("lat");
        $lng   = $req->input("lng");

        $collection = ProjectsTbl::join("projectinformation","projectstbl.projectid","=","projectinformation.projectid")
                                    ->where(["projectstbl.latitude"=>$lat,"projectstbl.longitude"=>$lng])
                                    ->get();

        return response()->json($collection);
    }

    function the_sectors() {
        $collection = ProjectsTbl::get("sector")->toArray();

        $the_return = [];

        foreach($collection as $c) {
            if (!in_array($c['sector'], $the_return)) {
                array_push($the_return, $c['sector']);
            }
        }

        return response()->json($the_return);
    }

    function the_funder() {
        $collection = ProjectsTbl::get(["projectdonortext"])->toArray();

        $the_return = [];

        foreach($collection as $c) {
            if (!in_array($c['projectdonortext'], $the_return)) {
                array_push($the_return, $c['projectdonortext']);
            }
        }

        return response()->json($the_return);
    }

    function getthe_area_info(Request $req) {
        list($lat, $lng)  = explode("_",$req->input("latlng"));

        // $lat = "8.481525556812972";
        // $lng = "124.65137784106474";

        $areaid     = themap::where(["latitude"=>$lat,"longitude"=>$lng])->get("areaid")->toArray();

       // var_dump($areaid[0]['areaid']);
        // $areaid  = 2;
        $collection = theperarea::where("areaid",$areaid[0]['areaid'])->get();

        $theinvs    = [];
        foreach($collection as $c) {
            array_push( $theinvs, [$c->theinvestments[0]['theinvestments'],$c->theinvestments[0]['theinv_id']] );
        }

        return response()->json($theinvs);
    }

    function specific_commo_data(Request $req) {
        $inv_id = 4; //$req->input("inv_id");
        $areaid = 2;

        $collection = theperarea::join("theyields","theperareas.theinv_id","=","theyields.invperarea_id")
                                ->where(["theperareas.areaid"=>$areaid,"theperareas.theinv_id" => $inv_id])
                                ->orderby("theyields.year","ASC")
                                ->get();

        $yields     = [];

        foreach($collection as $c) {
            array_push($yields,$c->yield);
        }

        return response()->json($yields);
    }

    function thelistof_specificareas(Request $req) {

    }

    function get_yields(Request $req) {
        $area_id     = 2;
        $industry_id = "";

        $collection = theperarea::join("theyields","theperareas.invperarea_id","=","theyields.invperarea_id")
                                  ->join("theinvs","theperareas.theinv_id","=","theinvs.theinv_id")
                                  ->where("theperareas.areaid",$area_id)
                                  ->orderby("year","ASC")
                                  ->get(["theperareas.*","theyields.*","theinvs.*"]);

        $industrydistribution = [];
        $perindustryperyear   = [];

        foreach($collection as $c) {
            // compute for the industry distribution
                if (array_key_exists($c->theinvestments, $industrydistribution)) {
                    $industrydistribution[$c->theinvestments] += $c->yield;
                } else {
                    $industrydistribution[$c->theinvestments] = $c->yield;
                }
            // =================== end 
        }

        foreach ($industrydistribution as $key => $value) {
            $data = [];

            foreach($collection as $cc) {
                if ($cc->theinvestments == $key) {
                    array_push($data,$cc->yield);
                }
            }

            $loc_perindustryperyear = [
                "label" => $key,
                "data"  => $data
            ];

            array_push($perindustryperyear,$loc_perindustryperyear);
        }

            // compute for the per industry distribution per year
                /*
                    {
                      label: 'Dataset 1',
                      data: [12, 19, 3, 5, 2, 3],
                      borderColor: Utils.CHART_COLORS.red,
                      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
                    },
                */

            // =================== end   

        return response()->json(["perindustryperyear"     => $perindustryperyear,
                                 "industrydistribution"   => array_values($industrydistribution),
                                 "industrykeys"           => array_keys($industrydistribution)]);
    }
}
