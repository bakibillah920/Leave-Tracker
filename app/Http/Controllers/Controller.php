<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function backWithError($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }

    public function backWithSuccess($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }

    public function backWithWarning($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'warning'
        ];
        return back()->with($notification);
    }

    public function redirectBackWithWarning($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'warning'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function redirectBackWithError($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'error'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function redirectBackWithSuccess($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'success'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function urlRedirectBack($message, $url, $alertType)
    {
        $notification = [
            'message' => $message,
            'alert-type' => $alertType
        ];
        return redirect($url)->with($notification);
    }

    public function fileInfo($file)
    {
        if (isset($file)) {
            return $image = array(
                'name' => $file->getClientOriginalName(),
                'type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'width' => isset(getimagesize($file)[0]) ? getimagesize($file)[0] : '',
                'height' => isset(getimagesize($file)[1]) ? getimagesize($file)[1] : '',
                'extension' => $file->getClientOriginalExtension(),
            );
        } else {
            return $image = array(
                'name' => '0',
                'type' => '0',
                'size' => '0',
                'width' => '0',
                'height' => '0',
                'extension' => '0',
            );
        }

    }

    public function fileUpload($file, $destination, $name)
    {
        $upload = $file->move(public_path('/' . $destination), $name);
        return $upload;
    }

    public function fileMove($oldPath, $newPath)
    {
        $move = \File::move($oldPath, $newPath);
        return $move;
    }

    public function fileCopy($oldPath, $newPath)
    {
        $move = \File::copy($oldPath, $newPath);
        return $move;
    }

    public function fileDelete($path)
    {
        if (!empty($path) && file_exists(public_path('/' . $path))) {
            $delete = unlink(public_path('/' . $path));
            return $delete;
        }
        return false;
    }

    public function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }


}
