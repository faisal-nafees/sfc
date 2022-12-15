<?php

namespace App\Classes;

use Image;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class Helper
{
    public static function is_base64_encoded($str)
    {

        $decoded_str = base64_decode($str);
        $Str1 = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $decoded_str);
        if ($Str1 != $decoded_str || $Str1 == '') {
            return "false";
        }
        return "true";
    }

    public static function is_valid_url($str)
    {
        $regex = "((https?|ftp)\:\/\/)?";
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
        $regex .= "(\:[0-9]{2,5})?";
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";


        if (filter_var($str, FILTER_VALIDATE_URL) && preg_match("/^$regex$/i", $str) && Http::get($str)->successful()) {
            return true;
        }
        return false;
    }

    public static function byteToMB($size, $precision = 2)
    {
        $base = log($size, 1024);
        return round(pow(1024, $base - floor($base)), $precision);
    }

    public static function optimizeImageToURL(String $file)
    {
        try {
            // if Production env
            $tempPath            = public_path() . '/storage/temp/faces';
            // path does not exist
            if (!file_exists($tempPath)) {
                File::makeDirectory($tempPath);
            }
            $fileName = Str::orderedUuid() . rand(4, 10) . '.jpg';
            $tempImagePath = $tempPath . '/' . $fileName;
            $stream = Image::make($file)->save($tempImagePath, 100, 'jpg');

            $compressionLvl = 90;
            while (Image::make($tempImagePath)->exif()['FileSize'] > 6000000) {
                if ($compressionLvl >= 10) {
                    Image::make($stream)->encode('jpg', $compressionLvl)->save($tempImagePath, $compressionLvl, 'jpg');
                    return false;
                    $compressionLvl -= 10;
                } else {
                    return false;
                }
            }
            return  [
                'success' => true,
                'url' => request()->getSchemeAndHttpHost() . '/storage/temp/faces/' . $fileName,
                'tempPath' => 'storage/temp/faces/' . $fileName
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => 'Operation Unsuccessful'];
        }
    }

    public static function imgToURL(String $file)
    {
        $tempImagePath = 'storage/face_temp' . Str::orderedUuid() . rand() . '.jpg';
        $stream = Image::make($file)->save(public_path($tempImagePath), 100, 'jpg');
        $compressionLvl = 90;
        while (Image::make($tempImagePath)->exif()['FileSize'] > 6000000) {
            if ($compressionLvl >= 10) {
                Image::make($stream)->encode('jpg', $compressionLvl)->save($tempImagePath, $compressionLvl, 'jpg');
                return false;
                $compressionLvl -= 10;
            } else {
                return false;
            }
        }
        return request()->getSchemeAndHttpHost() . '/' .  $tempImagePath;
    }

    public static function handleErrors(bool $ajax, array $errorsArray)
    {
        if ($ajax) {
            return response()->json($errorsArray);
        } else {
            return back()->withErrors($errorsArray);
        }
    }

    public static function dateDifference($date_1, $date_2)
    {
        $differenceFormat = '{"years":%y, "months":%m, "days":%d, "hours":%h, "minutes":%i, "seconds":%s}';
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        $diffArray = $interval->format($differenceFormat);
        return json_decode($diffArray);
    }
}
