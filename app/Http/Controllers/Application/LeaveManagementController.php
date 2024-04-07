<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LeaveCategory;
use App\Models\LeaveApplication;
use App\Models\Role;
use App\Models\User;
use App\Models\GlobalSetting;
use Auth;
use File;
use DateTime;
use DB;
use Helper;
use Mail;
class LeaveManagementController extends Controller
{
    public function leaveCategory(Request $request)
    {
        $pageTitle="Leave Category";
        $all_roll= [''=>'Select']+Role::orderBy('id','asc')->pluck('name','id')->toArray();
        $leave_category = LeaveCategory::with(['role'])->get();
//        echo '<pre>';
//        print_r($leave_category);exit;
        
        if($request->layout){
            return view('Application.Leave.Category.index')->with(['pageTitle'=>$pageTitle,'all_roll'=>$all_roll,'leave_category'=>$leave_category]);
        }
        $viewpage = view('Application.Leave.Category.index')->with(['pageTitle'=>$pageTitle,'all_roll'=>$all_roll,'leave_category'=>$leave_category]);
        return view('fullpage', compact('viewpage'));
    }

    public function storeleaveCategory(Request $request){
        $request->validate([
            'leave_category'=>'required',
            'leave_days'=>'required'
        ],[
            'role_id.required'=> 'The Role name field is required'
        ]);

        try{
            if($request->id){
                $class_data= LeaveCategory::find($request->id);
            }else{
                $class_data = new LeaveCategory();
            }
            $class_data->name = $request->leave_category;
            $class_data->days = $request->leave_days;
            $class_data->save();
            return response()->json([
                'success'=>true,
                'msg'=>'Data save successful'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    public function deleteleaveCategory($id){
        try{
          $cat= LeaveCategory::where('id',$id)->first();
          $leaverequest = LeaveApplication::where('category_id',$cat->id)->get();
          foreach($leaverequest as $leave){
            $leave= LeaveApplication::where('id',$leave->id)->delete();
          }
          $cat->delete();

            return response()->json([
                'success'=>true,
                'msg'=>'Leave Category delete successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function leaverequest(Request $request) {
        $pageTitle="Leave Request";
        $all_leave = [''=>'Select']+LeaveCategory::orderBy('id','asc')
                    ->select('id', DB::raw('CONCAT(name, " (", days,")") as fullname'))
                    ->pluck('fullname','id')->toArray();   
       
        if(Auth::user()->role==3){
            $alluser = [''=>'Select']+User::where('id',Auth::user()->id)->orderBy('id','asc')->pluck('name','id')->toArray();
            $leave_request = DB::table('leave_application as la')
                    ->select('la.*', 'c.name as category_name', 'r.name as role','u.name as UserName')
                    ->leftJoin('leave_category as c', 'c.id', '=', 'la.category_id')
                    ->leftJoin('users as u', 'u.id', '=', 'la.user_id')
                    ->leftJoin('roles as r', 'r.id', '=', 'u.role')
                    ->where('la.user_id',Auth::user()->id)
                    ->orderBy('la.id', 'DESC')->get();
        }else{
            $alluser = [''=>'Select']+User::whereNotIn('role',[1])->orderBy('id','asc')->pluck('name','id')->toArray();
            $leave_request = DB::table('leave_application as la')
                    ->select('la.*', 'c.name as category_name', 'r.name as role','u.name as UserName')
                    ->leftJoin('leave_category as c', 'c.id', '=', 'la.category_id')
                    ->leftJoin('users as u', 'u.id', '=', 'la.user_id')
                    ->leftJoin('roles as r', 'r.id', '=', 'u.role')
                    ->orderBy('la.id', 'DESC')->get();
        }
        if($request->layout){
            return view('Application.Leave.request')->with(['pageTitle'=>$pageTitle,'all_leave'=>$all_leave,'leave_request'=>$leave_request,'alluser'=>$alluser]);
        }
        $viewpage = view('Application.Leave.request')->with(['pageTitle'=>$pageTitle,'all_leave'=>$all_leave,'leave_request'=>$leave_request,'alluser'=>$alluser]);
        return view('fullpage', compact('viewpage'));
        
    }

    public function storeleaveRequest(Request $request){
        $roles=[
            'start_date'=>'required',
            'leave_cat_id'=>'required',
            'end_date'=>'required'
        ];
        $msg =[
            'start_date.required'=> 'The Start Date field is required',
            'end_date.required'=> 'The End Date field is required',
            'leave_cat_id.required'=> 'The Leave Category field is required.'
        ];
        $request->validate($roles,$msg);
        $end_date = $request->end_date;
        $start_date = $request->start_date;
        if($start_date > $end_date){
              return response()->json([
                'success' => false,
                'msg' => 'Start Date cannot be greater than End date!!'
            ]);
        }
        
        if($this->leave_check($request->start_date,$request->end_date,$request->user_id, $request->leave_cat_id)){
              return response()->json([
                'success' => false,
                'msg' => $this->leave_check($request->start_date,$request->end_date,$request->user_id, $request->leave_cat_id)
            ]);
        }
        if($this->date_check($request->start_date,$request->end_date,$request->user_id)){
              return response()->json([
                'success' => false,
                'msg' => $this->date_check($request->start_date,$request->end_date,$request->user_id)
            ]);
        }
      
        try{
                $datetime1      = new DateTime($request->start_date);
                $datetime2      = new DateTime($request->end_date);
                $leave_days     = $datetime2->diff($datetime1)->format("%a") + 1;
                
                $leave_request = new LeaveApplication();
                $leave_request->user_id = $request->user_id;
                $leave_request->leave_days = $leave_days;
                $leave_request->reason = $request->reason??'';
                $leave_request->category_id = $request->leave_cat_id;
                $leave_request->start_date = $request->start_date;
                $leave_request->end_date = $request->end_date;
                $leave_request->approved_by = 0;
                $leave_request->apply_date = date('Y-m-d');
                $name ='';
                if($request->hasFile('attachment_file')) {
                    $file = $request->file('attachment_file');
                    $name =  time().$file->getClientOriginalName();
                    $destinationPath = 'uploads/attachments/leave/';
                    $upload_success = $file->move($destinationPath, $name);
                }
                if($name){
                    $leave_request->orig_file_name = $file->getClientOriginalName();
                    $leave_request->enc_file_name = $name;
                }
                $leave_request->save();
                    $userInfo = User::find($request->user_id);
                    $tomail = [$userInfo->email];
                    $globalConfig = GlobalSetting::find(1);

                    // send mail
//                        Mail::send('auth.app', ['leavedata' =>$leave_request,'userInfo'=>$userInfo], function ($m) use ($tomail,$globalConfig) {
//                            $m->from($globalConfig->institute_email);
//                            $m->to($tomail)->subject('Notification For Leave Approved');
//                        });
                    //   
                
            return response()->json([
                'success'=>true,
                'msg'=>'Data save successful'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }

    }

    public function storeleaveRequestUpdate(Request $request){
        $roles = [
            'start_date'=>'required',
            'leave_cat_id'=>'required',
            'end_date'=>'required'
        ];
        $request->validate($roles,[
            'start_date.required'=> 'The Start Date field is required',
            'end_date.required'=> 'The End Date field is required',
            'leave_cat_id.required'=> 'The Leave Category field is required.'
        ]);
        $end_date = $request->end_date;
        $start_date = $request->start_date;
        if($start_date > $end_date){
            return response()->json([
                'success' => false,
                'msg' => 'Start Date cannot be greater than End date!!'
            ]);
        }
        
        
        if($this->leave_check($request->start_date,$request->end_date,$request->user_id , $request->leave_cat_id,$request->id)){
              return response()->json([
                'success' => false,
                'msg' => $this->leave_check($request->start_date,$request->end_date,$request->user_id , $request->leave_cat_id,$request->id)
            ]);
        }
        if($this->date_check($request->start_date,$request->end_date,$request->user_id,$request->id)){
              return response()->json([
                'success' => false,
                'msg' => $this->date_check($request->start_date,$request->end_date,$request->user_id,$request->id)
            ]);
        }
        try{
            
            $leave_request= LeaveApplication::find($request->id);

            $datetime1      = new DateTime($request->start_date);
            $datetime2      = new DateTime($request->end_date);
            $leave_days     = $datetime2->diff($datetime1)->format("%a") + 1;

            $leave_request->user_id = $request->user_id;
            $leave_request->leave_days = $leave_days;
            $leave_request->reason = $request->reason??'';
            $leave_request->category_id = $request->leave_cat_id;
            $leave_request->start_date = $request->start_date;
            $leave_request->end_date = $request->end_date;
            $leave_request->approved_by = 0;
            $leave_request->apply_date = date('Y-m-d');
            $name ='';
            if ($request->hasFile('attachment_file')) {
                $file = $request->file('attachment_file');
                $name =  time().$file->getClientOriginalName();
                $destinationPath = 'uploads/attachments/leave/';
                $upload_success = $file->move($destinationPath, $name);
                if ($leave_request->enc_file_name) {
                    if (File::exists(public_path("uploads/attachments/leave/" . $leave_request->enc_file_name))) {
                        File::delete(public_path("uploads/attachments/leave/" . $leave_request->enc_file_name));
                    }
                }
            }
            if($name){
                $leave_request->orig_file_name = $file->getClientOriginalName();
                $leave_request->enc_file_name = $name;
            }
            $leave_request->save();
                
            return response()->json([
                'success'=>true,
                'msg'=>'Leave Request Updated Successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }

    }

    public function deleteleaveRequest($id){

        $leave = LeaveApplication::find($id);
        if ($leave) {
            if ($leave->enc_file_name) {
                if (File::exists(public_path("uploads/attachments/leave/" . $leave->enc_file_name))) {
                    File::delete(public_path("uploads/attachments/leave/" . $leave->enc_file_name));
                }
            }

            $leave->delete();
            return response()->json([
                'success' => true,
                'message' => "Leave Request has been deleted successfully.",
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Something went wrong.",
            ]);
        }
    }


    public function storeleaveManage(Request $request){

        try{
            $leave_request = LeaveApplication::find($request->id);
            $leave_request->comments = $request->comments??'';
            $leave_request->status = $request->status;
            
            $userInfo = User::find($leave_request->user_id);
            $tomail = [$userInfo->email];
            $globalConfig = GlobalSetting::find(1);
                $msg = 'Pending';
                if($request->status==2){
                    $leave_request->approved_by = Auth::user()->id;
                    $msg = 'Approved';
                    // send mail
//                        Mail::send('auth.app', ['leavedata' =>$leave_request,'userInfo'=>$userInfo], function ($m) use ($tomail,$globalConfig) {
//                            $m->from($globalConfig->institute_email);
//                            $m->to($tomail)->subject('Notification For Leave Approved');
//                        });
                    //
                }else if($request->status==3){
                    $leave_request->rejected_by = Auth::user()->id;
                    $msg = 'Rejected';
                     // send mail
//                        Mail::send('auth.app', ['leavedata' =>$leave_request,'userInfo'=>$userInfo], function ($m) use ($tomail,$globalConfig) {
//                            $m->from($globalConfig->institute_email);
//                            $m->to($tomail)->subject('Notification For Leave Rejected');
//                        });
                    //
                }
            $leave_request->save();
            return response()->json([
                'success'=>true,
                'msg'=>'Data successfully '.$msg
            ]);
         }catch(\Exception $e){
             return response()->json([
                 'success' => false,
                 'msg' => $e->getMessage()
             ]);
         }
    }

    public function getRequestDetails(Request $request)
    {
        $row = LeaveApplication::find($request->id);
        $all_leave = [''=>'Select']+LeaveCategory::orderBy('id','asc')
                    ->select('id', DB::raw('CONCAT(name, " (", days,")") as fullname'))
                    ->pluck('fullname','id')->toArray();
        $alluser = [''=>'Select']+User::whereNotIn('role',[1])->orderBy('id','asc')->pluck('name','id')->toArray();
        $html =  view('Application.Leave.modal.request', compact('row','all_leave','alluser'))->render();
        return response()->json($html);
    }

 
    public function index(Request $request)
    {   
        $pageTitle= "Leave";
        $all_leave = [''=>'Select'];
        $user = [''=>'Select'];
       $roles =[];
        if($request->layout){
            return view('Application.Leave.index')->with(['pageTitle'=>$pageTitle,'all_leave'=>$all_leave,'user'=>$user,'roles'=>$roles]);
        }
        $viewpage = view('Application.Leave.index')->with(['pageTitle'=>$pageTitle,'all_leave'=>$all_leave,'user'=>$user,'roles'=>$roles]);
        return view('fullpage', compact('viewpage'));

    }
    public function getData(Request $request)
    {
        if($request->ajax()) {
            $query = LeaveApplication::with('user', 'leave');
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'Application.Users.action')
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->toDateString();
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getDataWithFilters(Request $request){
        if($request->ajax()){
            $query = LeaveApplication::with('user', 'leave');
            $data = $query->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'Application.Users.action')
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->toDateString();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
   
    public function getEdit(Request $request){
       $leaveapp = LeaveApplication::with('user', 'leave')->find($request->id); 
       $html =  view('Application.Leave.modal.edit', compact('leaveapp'))->render();
        return response()->json($html);
    }
    
    private function leave_check($start_date,$end_date,$applicant_id ,$type_id,$id=0){
        $leave_total = Helper::get_type_name_by_id('leave_category', $type_id, 'days');
        $total_spent = DB::table('leave_application')
                    ->select(DB::raw('IFNULL(SUM(leave_days), 0) as total_days'))
                    ->where([
                        'user_id' => $applicant_id,
                        'category_id' => $type_id,
                        'status' => '2',
                    ])
                    ->where('id','!=',$id)
                    ->first()->total_days;
            
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $leave_days = $datetime2->diff($datetime1)->format("%a") + 1;
        $left_leave = ($leave_total - $total_spent);
        if((int)$left_leave < (int)$leave_days) {
            return "Applyed for $leave_days days, get maximum $left_leave Days days.";
        }else{
            return  false;
        }
    }
    private function date_check($start_date,$end_date,$applicant_id,$id=0){
        
        $today = date('Y-m-d');
        if ($today == $start_date) {
            return "You can not leave the current day.";
        }
        $getUserLeaves = DB::table('leave_application')->where([
            'user_id' => $applicant_id,
        ])->where('id','!=',$id)->get();
        if (!empty($getUserLeaves)) {
            foreach ($getUserLeaves as $user_leave) {
                $get_dates = $this->user_leave_days($user_leave->start_date, $user_leave->end_date);
                $result_start = in_array($start_date, $get_dates);
                $result_end = in_array($end_date, $get_dates);
                if (!empty($result_start) || !empty($result_end)) {
                  return 'Already have leave in the selected time.';
                }
            }
        }
        return false;
    }
    private function user_leave_days($start_date, $end_date){
        $dates      = array();
        $current    = strtotime($start_date);
        $end_date   = strtotime($end_date);
        while ($current <= $end_date) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 day', $current);
        }
        return $dates;
    }
    
}