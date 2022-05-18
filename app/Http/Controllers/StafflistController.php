<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
class StafflistController extends Controller
{
    public function stafflist(Request $request){
        $data = $request['stafflist'];
        $find = DB::table('staffs')->where('category','=',$data)->get();
        //dd($find);
        return view('auth.stafflist',compact('find'));
    }


    public function addstaff(Request $req){
        $req->validate([
            'name' => 'required',
            'mobile' => 'required',
            'category'=> 'required | in:security,gardner,maintenance'
        ]);
        $data = DB::table('staffs')->insert([
            'name'=> $req->name,
            'mobile' => $req->mobile,
            'category' => $req->category,
        ]);
        if($data){
            return redirect('/staff-list');
        }
    }

    public function deletestaff(Request $req){
        $data = $req->category;
        $result= Staff::where('category','=',$data)->get();
        return view('auth.deletestaff',compact('result'));
    }

    public function editstaff(Request $req){
        $data = $req->category;
        $result= Staff::where('category','=',$data)->get();
        return view('auth.editstaff',compact('result'));
    }

    public function deletemember(Request $req){
        $data = Staff::where('id','=',$req->id)->delete();
        if($data){
            return redirect('/staff-list');
        }
    }

    public function editmember(Request $req){
        $data = $req->id;
        $value= Staff::where('id','=',$data)->get();
        //dd($value);
        return view('auth.editstaff',compact('value'));
    } 
    
    public function editdetail(Request $req){
        // dd($req);
        $data = $req->id;
        
        $update=Staff::where('id','=',$data)->update(['name'=>$req['name'],'mobile'=>$req['mobile']]);
        return view('/home');
    }

    public function staffsearch(Request $req){
        $searchData = Staff::where('name','like','%'.$req->search.'%')->get();
        return view('auth.stafflist',compact('searchData'));
    }
}
