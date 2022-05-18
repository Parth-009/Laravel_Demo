<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitor;
use Illuminate\Support\Facades\DB;

class AddvisitorController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required | string',
            'mobile' => 'required | string | max:10',
            'flat' => 'required | string ',
            'purpose' => 'required | string'
        ]);

        $data=visitor::create([
            'name'=> $request->name,
            'mobile' => $request->mobile,
            'flat_no' => $request->flat,
            'purpose'=> $request->purpose
        ]);

        if($data==true){
            return view('/home');
        }
        else{
            return "Visitor not add successfully";
        }
    }

    public function show(){
        $data = DB::table('visitors')->select('*')->paginate(5);
       return view('auth.visitorlist', ['data'=>$data]);
    }
}
