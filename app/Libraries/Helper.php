<?php

namespace App\Libraries;

use Auth;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class Helper
{
    public static function get_type_name_by_id($table, $type_id = '', $field = 'name')
    {
        $get = DB::table($table)->where('id', $type_id)->first();
        if (!empty($get)) {
            return $get->$field;
        }
        return '';
    }

    public static function set_alert($type, $message)
    {
        return Session::flash($type, $message);
    }

    public static function get_session_id()
    {
        return app("global_config")->session_id;
    }

    public static function getUploadedFileName($mainFile, $imgPath, $reqWidth = 0, $reqHeight = 0)
    {
        $fileExtention = $mainFile->extension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size = $mainFile->getSize();
        $validExtentions = array('jpeg', 'jpg', 'png');
        $currentTime = time();
        $fileName = $currentTime . '.' . $fileExtention;

        if ($file_size <= 1048576) {
            if (in_array($fileExtention, $validExtentions)) {
                $img = Image::make($mainFile->getRealPath());
                if (!file_exists(public_path($imgPath))) {
                    mkdir(public_path($imgPath), 777, true);
                }
                $img->save(public_path($imgPath) . '/' . $fileName);
                $output['status'] = 1;
                $output['file_name'] = $fileName;
            } else {
                $output['errors'] = $fileExtention . ' File is not support';
                $output['status'] = 0;
            }
        } else {
            $output['errors'] = $file_size . ' size is too large !!!';
            $output['status'] = 0;
        }
        return $output;
    }

    public static function setActive($path, $active = 'nav-active')
    {
        if (is_array($path)) {
            foreach ($path as $k => $v) {
                $path[$k] = $v;
            }
        } else {
            $path = $path;
        }

        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
    public static function liActive($path)
    {
        $segment_users = request()->segment(1); //returns 'users'
        if (in_array($segment_users, $path)) {
            return 'nav-active nav-expanded';
        } else {
            return '';
        }
    }


}
