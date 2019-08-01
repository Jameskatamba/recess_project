<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TrialController extends Controller
{
   
    public function allocat(){

       $i=1;
    	$data['data']=collect(\DB::select("SELECT AgentID from agents WHERE DistrictId=$i"))->first();


    	//return $data;
    	foreach ($data  as $value) {
    		$g=$value->AgentID;
    	       }
         $y=(int)$g;
    	DB::table('districts')
            ->where('DistrictId', $i)
            ->update(['AgentHead' => $y]);


            echo "okay";
    }


public function allocate(){
    //this is to lie this pc

$lie['data'] = DB::table('districts')->select('districtId','districtName')
                    ->where('AgentHead', '=', 0)
                    ->first();




$data['data'] = DB::table('districts')->select('districtId')
                    ->where('AgentHead', '=', null)
                    ->first();
if (count($data)>=1&& $data!=$lie ) {

return $data;


    }

else{


	$data = DB::select("SELECT   districts.districtId  from agents join districts on agents.DistrictId = districts.DistrictId  group by agents.districtId ,districts.districtName having count(agents.DistrictId) order by count(agents.DistrictId) asc limit 1 ");
     
   if (count($data)>=1&& $data!=$lie ) {
foreach ($data[0] as $data1) {
    $b= (int)$data1 ;
    return $b;
}
}

}
   // $data['data'] = DB::select("SELECT MIN(mycount) FROM (SELECT agents.DistrictId  COUNT(agents.DistrictId)as FROM agents GROUP BY agents.DistrictId");


}





public function pay()
{

    $lie[] = DB::table('districts')->select('districtId','districtName')
                    ->where('AgentHead', '=', 0)
                    ->first();




$data = DB::select("SELECT   districts.districtId from members  join agents on members.agentId=agents.agentId join districts on agents.DistrictId = districts.DistrictId  group by members.agentId  having count(members.agentId) order by count(members.agentId) desc  limit 1 ");
 if (count($data)>=1 && $data!=$lie )

  {
 


foreach ($data[0] as $data1)
 {
   

    $b= $data1 ;
    return $b;


}

$data['data1'] =DB::table('agents')->get();
          foreach ($data['data1'] as $data1) {

 //  return ($data['data1']);

            
            
 }

        
 }


 else
 {


   echo "no data";
}

}
public function pay2()
{ 
    $lie[] = DB::table('districts')->select('districtId','districtName')
                    ->where('AgentHead', '=', 0)
                    ->first();

    $array= DB::select("SELECT SUM(amount)-2000000 as payable FROM donations");

    if (count( $array)>=1 &&  $array!=$lie ) {
         
     

foreach ($array[0] as $key) {
$payable=(int)$key;
DB::table('payments')->where('paymentId',1) ->update(['payable' => $payable]);
}

$np=DB::select("SELECT count(*) as together FROM agents");

foreach ($np[0] as $key) 
{
$allAgents= (int)$key;
}

$nph=DB::select("SELECT count(AgentHead) as together FROM districts");
foreach ($nph[0] as $key) 
{
$AgentHeads= (int)$key;
}

$plainAgents=$allAgents-$AgentHeads;
//return $plainAgents;
if ($plainAgents>=1) { 
    

//pay for plain agents
$payForPlain= $payable/$plainAgents;


DB::table('payments')->where('paymentId',1) ->update(['plainAgents' =>$payForPlain ]);
//pay for heads from plain
$payForHeadPlain=(7/4)*$payForPlain;

DB::table('payments')->where('paymentId',1) ->update(['AgentsHeadOfPlain' =>$payForHeadPlain ]);
//pay for high agents & heads
$payForHighHead=2*$payForHeadPlain;
DB::table('payments') ->where('paymentId',1)->update(['AgentsHeadOfHigh' =>$payForHighHead ]);
//pay for admin
$payForHighAdmin=(1/2)*$payForPlain;
DB::table('payments') ->where('paymentId',1)->update(['Admin' =>$payForHighAdmin ]);

$data['data']=DB::select("SELECT * FROM payments limit 1");




            return  view ('payment',$data);
}

else{echo "no agents found";}
        }

        else{

            return ('no funds');
        }


}


public function select(){

$data['data']=DB::select("SELECT firstName , LastName, districtName  from agents JOIN districts on agents.AgentID=districts.AgentHead");

return view('hierrachy',$data);


}





public function test(){

    $data = DB::select("SELECT   districts.districtId  from agents join districts on agents.DistrictId = districts.DistrictId  group by agents.districtId ,districts.districtName having count(agents.DistrictId) order by count(agents.DistrictId) asc limit 1 ");
     
  foreach ($data[0] as $data1) {
    $d=(int)$data1;
    return $d;
}
}





}
