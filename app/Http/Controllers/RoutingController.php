<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class RoutingController extends Controller
{

    public function panelRequestHandler(Request $r, $segment1='', $segment2='', $param1='', $param2=''){
        /*
        $segment1 = "controller";
        $segment2 = "method";
        $param1 = "param";
        $param2 = "param";
        */

        $controllername = "App\Http\Controllers\Application\\".ucfirst($segment1)."Controller";
        $controller = new $controllername;
        $method = self::makeMedthod($segment2);
        $viewpage = call_user_func_array([$controller, $method], [$r, $param1, $param2]);
        if($r->layout){
            return $viewpage;
        }else{
            return view('fullpage', compact('viewpage'));
        }
    }


    // public function panelRequestHandler(Request $r, $panel='', $param1='', $param2='', $param3='', $param4=''){
    //     $panel = ucfirst($panel);

    //     $controllername = "App\Http\Controllers\\".ucfirst($param1)."Controller";
    //     $controller = new $controllername;
    //     $method = self::makeMedthod($param2);

    //     $viewpage = call_user_func_array([$controller, $method], [$r, $param3, $param4]);

    //     if($r->layout){
    //         return $viewpage;
    //     }else{
    //         return view('fullpage', compact('viewpage'));
    //     }
        

    // }


    public static function makeMedthod($param2){
        $method = ($param2 ? Str::camel($param2): 'index');
        switch($method) {
            case('delete'):
                $method = 'destroy';
                break;
            default:
                
        }
        return $method;
    }




}
