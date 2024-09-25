<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_data extends Model
{
    use HasFactory;

    protected $primaryKey = "masterid";
    protected $fillable   = ["development_partner","title","description","plan","program","project","policy_and_procedure","financial_mechanism","class","personal_services","maintenance_and_other_operating_expense","capital_outlays","technical_assistance","emergency_relief","technical_cooperation","capital_grants","mixed_grants","others","loan","sector","sub_sector","sector_function","sub_sector_impact_output","thrust_1_sdg","thrust_2_bimp_eaga","thrust_3_pdp_2023_2028","neda_classification","mindanao_9_point_agenda","mindanao_2030","target_location","general_location","zamboanga_del_norte","zamboanga_del_sur","zamboanga_sibugay","bukidnon","camiguin","lanao_del_norte","misamis_occidental","misamis_oriental","davao_de_oro","davao_del_norte","davao_del_sur","davao_occidental","davao_oriental","north_cotabato","sarangani","south_cotabato","sultan_kudarat","agusan_del_norte","agusan_del_sur","dinagat_islands","surigao_del_sur","surigao_del_norte","basilan","lanao_del_sur","maguindanao_del_norte   maguindanao_del_sur     sulu    tawi_tawi   region_9    region_10   region_11   region_12   caraga  barmm   mindanao","national","implementing_agency","type","loan_currency","loan_amount","loan_amount_in_peso","grant_currency","grant_amount","grant_amount_in_peso"];
    protected $table      = "master_data";
}
