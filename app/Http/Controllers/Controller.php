<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;    // this class was included to connect to database

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
//this is the function to return my data
function  getdistrict(){
$data['data']= DB::table('districts')->join('agents','agents.AgentId','=','districts.AgentHead')->select('districts.DistrictId','agents.firstName','districts.DistrictName','districts.DistrictInitial')->get(); //code to get data 4rom tb districts 
if (count($data) >0)
{// if data is fetched then fill data in the table in view 'tables'
return view('tables', $data);
}

else
{// return form to fill data
return view ('registerDistrict');
}
}
//this is the function to return my data
function  getdonation(){
$data['data']= DB::select('select * from donations'); //code to get data 4rom tb donations

$array['xampp']= DB::table('donations')->select('amount')->sum('amount'); //code to get data 4rom 
return view('dontable', $data + $array);


}


function  agents(){
$data['data'] = DB::table('agents')
            ->join('districts', 'agents.DistrictId', '=', 'districts.DistrictId')
            ->select('agents.agentSignature','agents.gender','agents.AgentId','agents.email', 'agents.lastName', 'agents.firstName','districts.DistrictName')
            ->get();
if (count($data) >0)
{
return view('agents', $data);
}

else
{
return view ('agents');
}
}



public function showmembers(){


	$data['data'] = DB::table('members')
            ->join('agents', 'members.agentID', '=', 'agents.AgentId')

             ->join('districts', 'agents.districtId', '=', 'districts.DistrictId')
            ->select('members.memberId','members.memberName','districts.DistrictName')
            ->get();


            if (count($data) >0)
{
}

else
{
return  ('np members available now');
}

//i want to get total number of members
$array['money'] = DB::table('members')
            ->select("select * from members ")
            ->count();
            if (count($array) >0)
{
//return view('bydistrict', $array);
}

else
{
return view ('registerDistrict');
}

return view( 'bydistrict', $array +$data);
//return($array);


}
	






public function member(){

$data['data'] = DB::table('members')
            ->join('agents', 'members.agentID', '=', 'agents.AgentId')

            ->select('members.memberName', 'agents.firstName','agents.lastName')
            ->get();


            if (count($data) >0)
{
return view('members', $data);
}

else
{
return view ('registerDistrict');
}




}




















function  getpay(){
$data['data']= DB::select('select sum(amount) as total from donations'); //code to get data 4rom tb donations
if (count($data) >0)
{
return view('payment', $data);
}

else
{
return view ('donations');
}
}


}

