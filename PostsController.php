<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\districts;
use App\agents;
use App\donations;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agent()
    {
        return view ('registerAgent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        $post =new districts;
         $post->DistrictName =request( 'DName');
         $post->DistrictInitial =request( 'DInitial');
         $post->AgentHead   =request( 'agenthead');
         $post -> save();
         return redirect ( '/registerDistrict');


    }



  public function store2()
    {
        
        $post =new agents;
         $post->firstName =request( 'fname');
         $post->lastName =request( 'lname');
         $post->email  =request( 'email');
         $post->agentSignature =request( 'signature');
         $post->gender  =request( 'gender');
         $post -> save();
         return redirect ( '/registerAgent');


    }



public function store3()
    {
        
        $post =new donations;
         $post->amount =request( 'amount');
         $post->DonorName =request( 'dname');
         $post -> save();
         return redirect ( '/donation');


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
