<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle="Dashboard";
        
        $leavedata = DB::table('leave_application');
        if(Auth::user()->role ==3){
            $leavedata= $leavedata->where('user_id',Auth::user()->id);
        }
        $leavedata= $leavedata->get();
        
        if($request->layout){
            return view('Application.dashboard')->with(['pageTitle'=>$pageTitle,'leavedata'=>$leavedata]);;
        }

        $viewpage = view('Application.dashboard')->with(['pageTitle'=>$pageTitle,'leavedata'=>$leavedata]);
        return view('fullpage', compact('viewpage'));
    }
}
