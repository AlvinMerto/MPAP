<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\themap;
use App\Models\ProjectsTbl;
use App\Models\theperarea;
use App\Models\theyield;
use App\Models\Master_data;
use App\Models\geolocation;
use App\Models\Theinformation;

class ThemapController extends Controller
{
    //

    function index() {
        $collection = Master_data::get("development_partner");

        $funders = [];

        foreach($collection as $c) {
            if (!in_array($c->development_partner, $funders)) {
                array_push($funders, $c->development_partner);
            }
        }

        // $sectors = ProjectsTbl::get("sector")->toArray();

        // $the_return = [];

        // foreach($sectors as $c) {
        //     if (!in_array($c['sector'], $the_return)) {
        //         array_push($the_return, $c['sector']);
        //     }
        // }

        return view("themap", compact("funders"));
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
        
        if ($sector != "false" && $funder == "false") {
            $collection = ProjectsTbl::where("sector",$sector)->get();
        }

        if ($funder != "false" && $sector == "false") {
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

    function get_project_per_region(Request $req) {
        $province       = $req->input("region"); // province
        $sector         = $req->input("sector");
        $subsector      = $req->input("sub_sector");
        $sub_function   = $req->input("sub_function");
        $impact_output  = $req->input("impact_output");
        $funder         = $req->input("funder");

        $province_procs = str_replace(" ","_",strtolower($province));

        $look_for = [
            "sector"                    => $sector,
            "sub_sector"                => $subsector,
            "sector_function"           => $sub_function,
            "sub_sector_impact_output"  => $impact_output,
            "development_partner"       => $funder,
            "columnplace"               => $province_procs
        ];

        if ($sector == "false") {
            unset($look_for['sector']);
        }

        if ($subsector == "false") {
            unset($look_for['sub_sector']);
        }

        if ($sub_function == "false") {
            unset($look_for['sector_function']);
        }

        if ($impact_output == "false") {
            unset($look_for['sub_sector_impact_output']);
        }

        if ($funder == "false") {
            unset($look_for['development_partner']);
        }

        if ($province == "false") {
            unset($look_for['columnplace']);
        }

        $collection = Master_data::join("geolocation","master_data.masterid","=","geolocation.master_dataid")
                                    ->where($look_for)->get();

        $areas      = [];

        foreach($collection as $c) {
            if ($province != "false") {
                if ($c->columnplace == $province_procs) {
                    array_push($areas, [$c->lng,$c->lat]);
                }
            } else {
                array_push($areas, [$c->lng,$c->lat]);
            }
        }

        return response()->json($areas);
    }

    function project_details(Request $req) {
        $lat   = $req->input("lat");
        $lng   = $req->input("lng");

        // $collection = ProjectsTbl::join("projectinformation","projectstbl.projectid","=","projectinformation.projectid")
        //                             ->where(["projectstbl.latitude"=>$lat,"projectstbl.longitude"=>$lng])
        //                             ->get();

        $collection    = geolocation::join("master_data","geolocation.master_dataid","=","master_data.masterid")
                                    ->where(["geolocation.lat"=>$lat,"geolocation.lng"=>$lng])->get();

        return response()->json($collection);
    }

    function the_sectors() {
        // $collection = ProjectsTbl::get("sector")->toArray();
        $collection    = Master_data::get("sector")->toArray();

        $the_return = [];

        foreach($collection as $c) {
            if (!in_array($c['sector'], $the_return)) {
                if ($c['sector'] != 0 || $c['sector'] != "0") {
                    array_push($the_return, $c['sector']);
                }
            }
        }

        return response()->json($the_return);
    }

    function the_sub_sectors() {
        // $collection = ProjectsTbl::get("sector")->toArray();
        $collection    = Master_data::get("sub_sector")->toArray();

        $the_return = [];

        foreach($collection as $c) {
            if (!in_array($c['sub_sector'], $the_return)) {
                if ($c['sub_sector'] != 0 || $c['sub_sector'] != "0") {
                    array_push($the_return, $c['sub_sector']);
                }
            }
        }

        return response()->json($the_return);
    }

    function the_sector_function() {
        $collection    = Master_data::get("sector_function")->toArray();

        $the_return = [];

        foreach($collection as $c) {
            if (!in_array($c['sector_function'], $the_return)) {
                if ($c['sector_function'] != 0 || $c['sector_function'] != "0") {
                    array_push($the_return, $c['sector_function']);
                }
            }
        }

        return response()->json($the_return);
    }

    function the_sector_impact_output() {
        $collection    = Master_data::get("sub_sector_impact_output")->toArray();

        $the_return    = [];

        foreach($collection as $c) {
            if (!in_array($c['sub_sector_impact_output'], $the_return)) {
                if ($c['sub_sector_impact_output'] != 0 || $c['sub_sector_impact_output'] != "0") {
                    array_push($the_return, $c['sub_sector_impact_output']);
                }
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

    function get_funder_in_area(Request $req) {
        $region       = $req->input("region");

        $region_procs = str_replace(" ","_",strtolower($region));

        $collection   = Master_data::where($region_procs,1)->get("development_partner")->toArray();

        $areas        = [];
        $counts       = [];

        foreach($collection as $c) {
            if (!in_array($c['development_partner'], $areas)) {
                $counts[ str_replace(" ","_",strtolower($c['development_partner'])) ] = 1;
                array_push($areas, $c['development_partner']);
            } else {
                $counts[str_replace(" ","_",strtolower($c['development_partner']))] += 1;
            }
        }

        return response()->json([$areas,$counts]);
    }

    function oda_distribution(Request $req) {
        $agenda = $req->input("agenda");
        $region = $req->input("region");

        // $agenda    = "Mindanao Agenda 1: People's Well-being";
        // $region    = "region_10";

        $collection = Master_data::where([$region=>1, "mindanao_9_point_agenda"=>$agenda])->get(["loan_amount_in_peso","grant_amount_in_peso","type"]);
        
        $type_loan   = [
            "Non Government Organization" => 0,
            "National Government Agency"  => 0,
            "Local Government Unit"       => 0,
            "Private Sector"              => 0,
            "Multi-agency"                => 0
        ];

        $type_grant   = [
            "Non Government Organization" => 0,
            "National Government Agency"  => 0,
            "Local Government Unit"       => 0,
            "Private Sector"              => 0,
            "Multi-agency"                => 0
        ];

        foreach($collection as $c) {
            $loan                    = str_replace(",","",$c['loan_amount_in_peso']);
            $grant                   = str_replace(",","",$c['grant_amount_in_peso']);

            $type_loan[$c['type']]  += $loan;
            $type_grant[$c['type']] += $grant;
        }   

        $total_loan = 0;
        foreach($type_loan as $tl) {
            $total_loan += $tl;
        }

        $total_grant = 0;
        foreach($type_grant as $tg) {
            $total_grant += $tg;
        }

        array_push($type_loan, $total_loan);
        array_push($type_grant, $total_grant);

        $loan = array_map(function($a){
            return number_format($a);
        }, $type_loan);

        $grant = array_map(function($a){
            return number_format($a);
        }, $type_grant);

        return response()->json([$loan,$grant]);

    }

    function get_programs_projects(Request $req) {
        $region = $req->input("region");
        $agenda = $req->input("agenda");
        // $agenda    = "Mindanao Agenda 1: People's Well-being";
        // $region    = "region_10";

        $collection = Master_data::where([$region=>1, "mindanao_9_point_agenda"=>$agenda])->get(["plan","program","project","policy_and_procedure"]);

        $count  = [
            "plan"                    => 0,
            "program"                 => 0,
            "project"                 => 0,
            "policy_and_procedure"    => 0
        ];

        foreach($collection as $c) {
           $count['plan']                   += $c['plan'];
           $count['program']                += $c['program'];
           $count['project']                += $c['project'];
           $count['policy_and_procedure']   += $c['policy_and_procedure'];
        }

        return response()->json($count);
    }

    function typeofasst(Request $req) {
        $region = $req->input("region");
        $agenda = $req->input("agenda");

        $collection = Master_data::where([$region=>1, "mindanao_9_point_agenda"=>$agenda])
                                    ->get(["technical_assistance","emergency_relief","technical_cooperation","capital_grants","mixed_grants","others","loan"]);

        $counts = [
            "technical_assistance"  => 0,
            "emergency_relief"      => 0,
            "technical_cooperation" => 0,
            "capital_grants"        => 0,
            "mixed_grants"          => 0,
            "others"                => 0,
            "loan"                  => 0
        ];

        foreach($collection as $c) {
            $counts['technical_assistance']     += $c['technical_assistance'];
            $counts['emergency_relief']         += $c['emergency_relief'];
            $counts['technical_cooperation']    += $c['technical_cooperation'];
            $counts['capital_grants']           += $c['capital_grants'];
            $counts['mixed_grants']             += $c['mixed_grants'];
            $counts['others']                   += $c['others'];
            $counts['loan']                     += $c['loan'];
        }

        return response()->json($counts);
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

    function the_province_info(Request $req) {
        $province       = $req->input("province");
        $province_procs = str_replace(" ","_",strtolower($province));
        $collection     = Theinformation::where("theplace",$province_procs)->get()->toArray();

        return response()->json($collection);
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

    function odaspertype(Request $req) {
        $region     = $req->input("region");

        // in case of province
        $region = strtolower(str_replace(" ","_", $region));
        // end 

        $collection = Master_data::where([$region=>1])->get(["loan_amount_in_peso","grant_amount_in_peso"])->toArray();

        $colls = [
            "loans"  => 0,
            "grants" => 0
        ];

        foreach($collection as $c) {
            if ($c['loan_amount_in_peso'] != "0.00") {
                $colls['loans'] +=1;
            } else if ($c['grant_amount_in_peso'] != "0.00") {
                $colls['grants'] +=1;
            }
        }

        return response()->json([array_keys($colls), $colls]);
    }

    function odafundspertype(Request $req) {
        $province = $req->input("region");

        $province = strtolower(str_replace(" ","_", $province));

        $collection = Master_data::where($province,1)->get(["loan_amount_in_peso","grant_amount_in_peso"])->toArray();

        $new = array_map(function($a) {
            return str_replace(",","", $a);
        }, $collection);

        $values = [
            "loan"  => 0,
            "grant" => 0
        ];

        foreach($new as $n) {
            $values['loan']     += $n['loan_amount_in_peso'];
            $values['grant']    += $n['grant_amount_in_peso'];
        }

        // $new_vals = array_map(function($a){
        //     return number_format($a,2);
        // }, $values);

        return response()->json([array_keys($values),$values]);
    }

    function odafundspersector(Request $req) {
        // $province   = $req->input("region");
        $province   = $req->input("region");

        $province   = strtolower(str_replace(" ","_", $province));

        $collection = Master_data::where($province,1)->get(["loan_amount_in_peso","grant_amount_in_peso","sector"])->toArray();

        $values     = [];
        $graph      = [];

        foreach($collection as $c) {
            if (!in_array($c['sector'], $values)) {
                array_push($values, $c['sector']);
            }
        }

        foreach($values as $vv) {
            $graph[$vv] = [
                "loan"  => 0,
                "grant" => 0
            ];

            foreach($collection as $cc) {
                if ($vv == $cc['sector']) {
                    $graph[$vv]['loan'] += str_replace(",","", $cc['loan_amount_in_peso']);
                    $graph[$vv]['grant'] += str_replace(",","", $cc['grant_amount_in_peso']);
                }
            }
        }
        // Social Reform and Community Development

        // return response()->json($graph);

        $loans  = [];
        $grants = [];

        foreach($graph as $g) {
            array_push($loans, $g['loan']);
            array_push($grants, $g['grant']);
        }

        // return response()->json($province);

        return response()->json([$values,$grants, $loans]);
    }

    function sdg_thrust() {
        // $collection = Master_data::get(["sector","thrust_1_sdg"]);

        // // $values = [
        // //     "sector1" => [0,0,35,346,343,723,626,568,524,272,372,738,715,216,348,216,183],
        // //     "sector2" => [0,0,35,346,343,723,626,568,524,272,372,738,715,216,348,216,183]
        // // ];

        // $sectors = [];
        // $values  = [];

        // foreach($collection as $c) {
        //     if(!in_array($c->sector,$sectors)) {
        //         array_push($sectors,$c->sector);
        //     }
        // }

        // foreach($sectors as $s) {
        //     $count = 0;
        //     foreach($collection as $c) {
        //         if ($s == $c->sector) {
        //             $count++;
        //         }
        //     }

        //     $values[$s] = [$];
        // }

        // return response()->json($values);
    }
}
