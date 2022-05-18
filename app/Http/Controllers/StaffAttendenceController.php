<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Attendence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PDF;


class StaffAttendenceController extends Controller
{
    public function table(){
        $data = DB::table('staffs')->select('*')->get();
        
        return view('auth.staffattendence',compact('data'));
    }   
    
    public function present(Request $req){
       $req->validate([
           "date" => "required"
       ]);
        $array=(array_count_values($req->present));
        foreach($array as $key=>$value){
            if($array[$key]==2)
            {
                $status=Attendence::insert([
                    "staff_id"=> $key,
                    "date"=> $req->date,
                    "status"=> "present"
                ]); 
            }
            else{
                $status=Attendence::insert([
                    "staff_id"=> $key,
                    "date"=> $req->date,
                    "status"=> "absent"
                ]); 
            }
        }
        if($status){
            return redirect('/home')->with('alert','Attendece taken successfully');
        }
    }

    public function attendencelist(Request $req){
        if($req->has('pdf')){
            $date= $req->date;
            $value = DB::table('attendences')
                ->join('staffs','attendences.staff_id','=','staffs.id')
                ->select('staffs.name','staffs.id','attendences.date','attendences.status')
                ->where('attendences.date','=',$req->date)->get();
            //$data = (array) $value;
            $array=[
                'date' => $date,
                'value' => $value 
            ];
            //dd(($array['value'][0]));
                $pdf = PDF::loadView('auth.AttendelistPdf', $array);
                return $pdf->download('attendencelist.pdf');
        }
       
        $data = DB::table('attendences')
                ->join('staffs','attendences.staff_id','=','staffs.id')
                ->select('staffs.name','staffs.id','attendences.date','attendences.status')
                ->where('attendences.date','=',$req->date)->paginate(10);
       
        return view('auth.attendencelist',compact('data'));
    }
}
