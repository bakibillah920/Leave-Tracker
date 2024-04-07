<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use Hash;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle="User Management";
        if(Auth::user()->role==4){
        $users = User::select('users.id','users.name','users.email','users.status','roles.name as role_name')
                ->leftJoin('roles', 'roles.id', '=', 'users.role')
                ->where('users.id',Auth::user()->id)->get();
        }else{
              $users = User::select('users.id','users.name','users.email','users.status','roles.name as role_name')
                ->leftJoin('roles', 'roles.id', '=', 'users.role')->get();
        }
        if($request->layout){
            return view('Application.Users.index', compact('pageTitle','users'));
        }
        $viewpage = view('Application.Users.index',compact('pageTitle','users'));
        return view('fullpage', compact('viewpage'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','name','email','created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', 'Application.Users.action2')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userInfo(Request $request)
    {
      $id = $request->id;
      $type = $request->type;
      $userInfo = User::findOrFail($id);
      if($type==1){
        $html =  view('Application.Users.auth', compact('userInfo'))->render();
      } else {
          $html =  view('Application.Users.edit', compact('userInfo'))->render();
      }
      return response()->json($html);
    }
    public function active(Request $request)
    {
      $id = $request->id;
      $type = $request->type;
      $userInfo = User::findOrFail($id);
      if($type==1){
            $userInfo->status = 'N';
      }else{
           $userInfo->status = 'Y';
      }
    
      ;
      if($userInfo->save()){
          if($type==1){
                return response()->json([
                    'success'=>true,
                    'msg'=>'User InActive Successfully'
                ]);
          }else{
               return response()->json([
                    'success'=>true,
                    'msg'=>'User Active Successfully'
                ]);
          }
       
      }else{
        return response()->json([
            'success'=>true,
            'msg'=>'Updated failed'
        ]);
      }
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            
            if($request->Form_ ==1){
                $rules =[
                   'password' => 'required| min:8| max:30 |confirmed',
                    'password_confirmation' => 'required| min:8'
                ];
                $request->validate($rules);

                try{
                    $user = User::find($request->id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json([
                        'success'=>true,
                        'msg'=>'Data Updated successful'
                    ]);
                }catch(\Exception $e){
                    return response()->json([
                        'success' => false,
                        'msg' => $e->getMessage()
                    ]);
                }
            }else if($request->Form_ ==2){
                $rules =[
                   'name' => 'required',
                   'email' => 'required|email',
                ];
                $request->validate($rules);

                try{
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->save();
                    return response()->json([
                        'success'=>true,
                        'msg'=>'Data Updated successful'
                    ]);
                }catch(\Exception $e){
                    return response()->json([
                        'success' => false,
                        'msg' => $e->getMessage()
                    ]);
                }
            }
        }
    }
}
