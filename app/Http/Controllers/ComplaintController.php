<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Complaint;
use App\Jobs\SendEmailJob;   
use Auth;
use Mail;
class ComplaintController extends Controller
{
    public function admincomplaintpanel()
    {
        $data = Complaint::orderBy('id','DESC')->paginate(5);
        return view('auth.Complaintbox',compact('data'));
    }

    public function usercomplaintpanel()
    {
        $data = Complaint::orderBy('id','DESC')->paginate(5);
        return view('User.Complaintbox',compact('data'));
    }

    public function useraddcomplaint(Request $req){
        
        $complaint=Complaint::create([
            "name"=> $req->name,
            "user_id" => $req->user_id,
            "mobile"=>$req->mobile,
            "type" => $req->type,
            "complaints" => $req->Complaint
        ]);
      
        if($complaint==true){
            return redirect('/home');
        }
    }

    public function updatestatus(Request $req){
        $data= $req->id;
        $update = Complaint::where('id','=',$req->id)
                            ->update([
                                'status'=> 'In Progress'
                            ]);
        if($update == true){
            return redirect('/adminComplaintbox');
        }
    }

    public function deletestatus(Request $req){
        $data= $req->id;
        $result= DB::table('complaints')->select('users.id','users.email','complaints.type','complaints.complaints')
                                        ->join('users','users.id','=','complaints.user_id')
                                        ->where('complaints.id','=',$data)
                                        ->get();
        $array = json_decode(json_encode($result), true);
        $mail = array("email" =>$array[0]["email"], "type"=> $array[0]["type"], "complaints" => $array[0]["complaints"]);
        $update = Complaint::where('id','=',$req->id)
                            ->update([
                                'status'=> 'Close'
                            ]);
        if($update == true){
            SendEmailJob::dispatch($mail);
            return redirect('/adminComplaintbox');
        }
    }

    public function totalcomplaint(){
        $data = Complaint::count("id");
        $new = Complaint::where('status','=','Submitted')->count();  
        $pending = Complaint::where('status','=','In Progress')->count(); 
        $close = Complaint::where('status','=','Close')->count(); 
        return view('auth.Complaintstatus',compact('data','new','pending','close'));
    }

    public function usercomplaint(){
        $data = Auth::user()->id;
        $value = Complaint::where('user_id','=',$data)->orderBy('id','DESC')->paginate(5);
       return view('User.UserComplaint',compact('value'));
    }
}
