<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\districts;
use App\agents;
use App\donations;
use App\members;
use DB;
use Charts;
use File;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agent(){


$lie[] = DB::table('districts')->select('districtId','districtName')
                    ->where('AgentHead', '=', 0)
                    ->first();




$dat['agent']=DB::table('districts')->select('districtName')
                    ->where('AgentHead', '=',null)
                   ->first();
if (count($dat)>=1&& $dat!=$lie ) {

return view('registerAgents', $dat);


    }

else{


   $data['agent']= DB::select("SELECT   districts.districtName  from agents join districts on agents.DistrictId = districts.DistrictId  group by agents.districtId ,districts.districtName having count(agents.DistrictId) order by count(agents.DistrictId) asc limit 1");


    //$data['agent']=DB::table('agents')->select('districtName')->join('districts','agents.districtId','=','districts.DistrictId')->groupBy('agents.districtId','districts.districtId')->having(count('agents.districtId'))->orderby(count('agents.districtId'))->asc()->first();
 foreach ($data as $key) {
    

    return view ('registerAgents',$key);
 }
     
          
}





    }





   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response


*/

      public function chart2()
    {
        return view("chart2");
    }

     
  public function table()
    {
        return view ("tables");
    }



    public function create()
    {
        return view ("registerDistrict");
    }

 public function donate()
    {
        return view ("donation");
    }

 public function login()
    {
        return redirect ("login");
    }

 public function register()
    {
        return redirect ("register");
    }

public function donate2()
    {
        return redirect ("dontable");
    }


public function agents()
    {
        return redirect ("agents");
    }

public function members()
    {

/*
         $file=File::get(storage_path('members/member.txt')); //just want to read file
        //want to put my files in array
      foreach (explode("\n",$file) as $key=>$line){
        
            $array[$key]=(explode(" ",$line));

        list($fName,$lName,$date,$gender,$recommenderfname,$recommenderlname,$agentSignature)=$array[$key];

DB::insert("insert into members(fName,lName,date,gender,recommenderfname,recommenderlname,agentSignature)  values('$fName','$lName','$date','$gender','$recommenderfname','$recommenderlname','$agentSignature')");
     

        }

        return ('successf');

        */
$n='agents';
$b='email';




$users['data'] = DB::table('agents')
            ->join('districts', 'agents.DistrictId', '=', 'districts.DistrictId')
            ->select('agents.agentSignature','agents.gender','agents.email', 'agents.lastName', 'agents.firstName','districts.DistrictName')
            ->get();

return($users);


        
 }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
          if (request( 'DName')=="" || request( 'DInitial')=="") {
            return redirect('registerDistrict')->with('error', 'please all fields are requred');

              
          }

          else{

        $post =new districts;
         $post->DistrictName =request( 'DName');
         $post->DistrictInitial =request( 'DInitial');
         $post->AgentHead   =request( 'agenthead');
         $post -> save();
return redirect('registerDistrict')->with('success', 'District is  registered successfully');
 }

    }



  public function store2( Request $request)
    { 
//\App\agents::agent($validatedData);
// return response()->json('nice');


        if (request( 'fname')=="" || request( 'lname')=="" ||request( 'email')=="" || request( 'signature')=="" ||request( 'gender')=="" ) {

            return redirect('/registerAgent')->with('error', 'please fill in all fields as required ,this form is not submited !');
            
        }



$lie['data'] = DB::table('districts')->select('districtId','districtName')
                    ->where('AgentHead', '=', 0)
                    ->first();
$dis=$dist=DB::table('districts')->select('select ifnull(*,0) from districts where districtId=0');


$dist=DB::table('districts')->select('select ifnull(*,0) from districts');
                 
                    if ($dist==$dis) {
                       
                        return redirect(  'registerDistrict')->with('error',' please have at least one district registered');
                    }



               else {

$data['data'] = DB::table('districts')->select('districtId')
                    ->where('AgentHead', '=', null)
                    ->first();
if (count($data)>=1&& $data!=$lie ) {
foreach ($data['data'] as $districtId) {
    $d=$districtId;
}

}

else{


    $data = DB::select("SELECT   districts.districtId  from agents join districts on agents.DistrictId = districts.DistrictId  group by agents.districtId ,districts.districtName having count(agents.DistrictId) order by count(agents.DistrictId) asc limit 1 ");
     
  foreach ($data[0] as $data1) {
    $d=(int)$data1;
    
}



}



        
        $post =new agents;
         $post->firstName =request( 'fname');
         $post->lastName =request( 'lname');
         $post->email  =request( 'email');
         $post->agentSignature =request( 'signature');
         $post->DistrictId =$d;
         $post->gender  =request( 'gender');
         $post -> save();


         //echo   '<script type="text/javascript"><p>hello</p></script>'  ;
        

         $i=$d;

        $data=collect(\DB::select("SELECT AgentID from agents WHERE DistrictId=$i"))->first();

         
        //return $data;
        foreach ($data  as $value) {
            $g=$value;
            

        }
         $y=(int)$g;
        DB::table('districts')
            ->where('DistrictId', $i)
            ->update(['AgentHead' => $y]);


 $array=collect(\DB::select("SELECT DistrictName from districts WHERE DistrictId=$i"))->first();

 foreach ($array  as $value) {
            $s=$value;}
            


             return redirect('/registerAgent')->with('info', 'Agent registered successfully , please note that this agents has been assigned to district : ' .$s );
       }

    }



public function store3()
    {   if (request( 'amount')=="" || request( 'dname')=="" ) {
       
            return redirect('/donation')->with('error', 'Donation or fund  is NOT registered because ONE OR MORE FIELDS are missing ! please fill in the fields correctly!');


    }
        
        $post =new donations;
         $post->amount =request( 'amount');
         $post->DonorName =request( 'dname');
         $post -> save();
         return redirect('/donation')->with('success', 'Donation or fund  is  registered successfully');



    }
public function charts()
    {
        return view('charts');
        

    }


    public function new()
    {
        return view('new');
        

    }




//function i want to draw piechart
public function seecharts()
    {
       //$monthcreated_at->format('d');
     $file=File::get(storage_path('members/member.txt')); //just want to read file
                   //want to put my files in array
                     foreach (explode("\n",$file) as $key=>$line){
        
                     $array[$key]=(explode(",",$line));
                     //this code below changes my associative array above into my data reuirements
                     //so i use the function list() to do that

                     list($memberName,$date,$gender,$recommendername,$agentSignature,$agentID)=$array[$key];
                     // i like using raw queries bcoz they are understandable
                    DB::insert("insert into members(memberName,date,gender,recommendername,agentSignature,agentID)  values('$memberName','$date','$gender','$recommendername','$agentSignature', $agentID)");
             }

                    return $array;


}


//method for making charts

    public function makeChart(){

   //$monthcreated_at->format('d');
     $data=   \DB::table("donations")

    ->select(DB::raw("HOUR(created_at) as months"),DB::raw("(SUM(amount)) as total"))

      ->groupBy(DB::raw("HOUR(created_at)"))

        ->get();


return ($data); 
    
    }




    public function makeChart2(){

   //$monthcreated_at->format('d');
     $data=   \DB::table("members")

    ->select('date',DB::raw("(count(*)) as total"))

      ->groupBy(DB::raw("date"))

        ->get();


return ($data); 

    
    }






    public function upgrade(){
 $data['data'] = DB::select("SELECT   agents.districtId ,members.recommendername  from members join agents on agents.AgentID = members.AgentID  group by members.recommendername ,agents.districtId  having count(members.recommendername)>10 ");



return view('upgrade', $data)->with('success', 'this member or members should be upgraded ');



    
    }




































    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
