<?php

namespace App\Services;

use App\Services\Config;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function getFileUrl($file_url, $file_name = null, $type = null)
    {
        // dd($file_url, $file_name, $type);
        if ($file_name == null) {
            if ($type == 'user') {
                $url = self::return_user_default_image();
            } else {
                $url = url('/') . '/image-not-found.png';
            }
        } else {
            $url = self::file_exists_storage_path($file_url . $file_name, $type);
            // if (config()->get('services.s3.image_url')) {
            //     $url = self::file_exists_storage_path($file_url . $file_name);
            // } else {
            //     if ($type == 'user') {
            //         $url = self::return_user_default_image();
            //     } else {
            //         $url = url('/') . '/image-not-found.png';
            //     }
            // }
        }
        return $url;
    }

    /**
     * check the file in storage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_storage_path($url, $type = null)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        if ($filesystem_disk == 's3') {
            if (url_exists(config()->get('services.s3.image_url') . $url)) {
                $path = config()->get('services.s3.image_url') . $url;
            } else {
                if ($type == 'user') {
                    $path = self::return_user_default_image();
                } else {
                    $path = url('/') . '/image-not-found.png';
                }
            }
        } else {
            // dd(Storage::disk('public')->exists($url), Storage::disk('local')->url($url));
            if (Storage::disk('public')->exists($url)) {
                // $path = Storage::disk('local')->url($url);
                $path = config()->get('services.img.local_img_url') . $url;
            } else {
                if ($type == 'user') {
                    $path = self::return_user_default_image();
                } else {
                    $path = url('/') . '/image-not-found.png';
                }
            }
        }
        // dd($path);
        return $path;
    }

    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function return_user_default_image()
    {
        if (request()->is('*api/*')) {
            $url = url('/') . '/default_user-api.png';
        } else {
            $url = url('/') . '/blank_user.png';
        }
        return $url;
    }

    /**
     * check the file in public Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            return url('/') . $url;
        } else {
            return url('/') . '/image-not-found.png';
        }
    }

    /**
     * Remove the file from public Path.
     *
     * @param  string  $url
     * @return string
     */
    public static function remove_file_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            unlink(public_path($url));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Upload file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return bool
     */
    public static function imageUploader(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = env('FILESYSTEM_DISK');
        $image_name = "";
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();
            if ($name) {
                $image_name = $name;
            } else {
                $image_name = time() . '_' . uniqid() . '.' . $ext;
            }
            if (request()->is('*api/*')) {
                try {
                    if ($filesystem_disk != 's3') {
                        $image->storeAs($url, $image_name, 'public');
                    } else {
                        // dd($url.$image_name);
                        Storage::disk($filesystem_disk)->put($url . $image_name, file_get_contents($image));
                        // dd(getS3Image($url,$image_name));
                        // Storage::temporaryUrl($url.$image_name,now()->addMinutes(5));

                    }
                    return $url . $image_name;
                } catch (Exception $e) {
                    Log::error('Image not uploaded. Request is Error: - ' . $e);
                    return null;
                }
            } else {
                try {
                    if ($filesystem_disk != 's3') {
                        $image->storeAs($url, $image_name, 'public');
                    } else {
                        // dd(Storage::disk($filesystem_disk)->put($url.$image_name, $image));
                        Storage::disk($filesystem_disk)->put($url . $image_name, file_get_contents($image));
                    }

                    return $url . $image_name;
                } catch (Exception $e) {

                    // Log::error('Image not uploaded. Request is' . $request->all(), 'Error: - ' . $e);
                    return null;
                }
            }
        } else {
            return null;
        }
    }

    public static function image_path($url)
    {
        $filesystem_disk = env('FILESYSTEM_DISK');
        if ($filesystem_disk != 's3') {
            return $url;
        }
        return Storage::temporaryUrl($url, now()->addMinutes(5));
    }

    public static function multi_image_path(array $url)
    {
        $filesystem_disk = env('FILESYSTEM_DISK');

        if ($filesystem_disk != 's3') {
            return $url;
        }
        foreach ($url as $ur) {
            return Storage::temporaryUrl($url, now()->addMinutes(5));
        }
    }

    /**
     * Upload Multiple file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return array
     */
    // public static function Uploader(Request $request, $key, $url, $name = '')
    // {
    //      $filesystem_disk = env('FILESYSTEM_DISK');
    //     $image_name = "";
    //     if ($request->hasFile($key)) {
    //         $image = $request->file($key);
    //         $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();
    //         if ($name) {
    //             $image_name = $name;
    //         } else {
    //             $image_name = time() . '_' . uniqid() . '.' . $ext;
    //         }
    //         if (request()->is('*api/*')) {
    //         try {
    //             if($filesystem_disk!='s3'){
    //                 $image->storeAs($url, $image_name, 'public');
    //             }else{
    //                 Storage::disk($filesystem_disk)->put($url.$image_name, file_get_contents($image));
    //             }
    //                 return $url.$image_name;
    //             } catch (Exception $e) {
    //                 Log::error('Image not uploaded. Request is Error: - '. $e);
    //                 return null;
    //             }
    //         } else {
    //             try {
    //                 if($filesystem_disk!='s3'){
    //                     $image->storeAs($url, $image_name, 'public');
    //                 }else{
    //                     Storage::disk($filesystem_disk)->put($url.$image_name, $image);
    //             }
    //                 return $url.$image_name;
    //             } catch (Exception $e) {
    //                 // Log::error('Image not uploaded. Request is' . $request->all(), 'Error: - ' . $e);
    //                 return null;
    //             }
    //         }
    //     } else {
    //         return null;
    //     }
    // }

    public static function multipleImageUploader(Request $request, $key, $url, $name = '')
    {

        $filesystem_disk = env('FILESYSTEM_DISK');
        $image_name = [];
        if ($request->hasFile($key)) {
            foreach ($request->file($key) as $image) {
                // $image = $request->file($key);
                $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();
                if ($name) {
                    $image_name_str = $name;
                } else {
                    $image_name_str = time() . '_' . uniqid() . '.' . $ext;
                }
                // echo $image_name_str;
                if ($filesystem_disk != 's3') {
                    $image->storeAs($url, $image_name_str, 'public');
                } else {
                    // Storage::disk($filesystem_disk)->put($url.$image_name, $image,'public');
                    Storage::disk($filesystem_disk)->put($url . $image_name_str, file_get_contents($image));
                }
                array_push($image_name, $url . $image_name_str);

            }

            // return $url.$image_name;
            return $image_name;
        } else {
            return [];
        }
    }

    public static function removeImage(Model $model, String $column_name, $url)
    {
        $filesystem_disk = env('FILESYSTEM_DISK');
        if ($model->getOriginal($column_name) != "" && $model->getOriginal($column_name) != null) {
            if (Storage::disk($filesystem_disk)->exists('public/' . $url . '/' . $model->getRawOriginal($column_name))) {

                $file = 'public/' . $url . '/' . $model->getRawOriginal($column_name);
                $result = Storage::disk($filesystem_disk)->delete($file);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function fileUploaderWithoutRequest(UploadedFile $image, $url, $name = '')
    {
        $filesystem_disk = env('FILESYSTEM_DISK');

        $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

        if ($name) {
            $image_name = $name;

        } else {
            $image_name = time() . '_' . uniqid() . '.' . $ext;
        }

        try {
            if ($filesystem_disk != 's3') {

                $image->storeAs($url, $image_name, 'public');
            } else {
                Storage::disk($filesystem_disk)->put($url . $image_name, file_get_contents($image));

            }

            return $url . $image_name;
        } catch (Exception $e) {
            Log::error('Image not uploaded. Request is' . request()->all(), 'Error: - ' . $e);
            return null;
        }
    }

}

/**
 * This Function used for get S3 image
 */
// public static function getS3Image($image_name = null, $dir = null, $type = "private") {
//     $image = "";
//     if (!empty($image_name)) {
//         $s3 = Storage::disk('s3');
//         $client = $s3->Files();
//         $bucket = Config::get('filesystems.disks.s3.bucket');
//         $img = $dir . '/' . $image_name;
//         $ifExist = $client->doesObjectExist($bucket, $img);
//         if (!empty($ifExist)) {
//             if ($type == "private") {
//                 $command = $client->getCommand('GetObject', [
//                     'Bucket' => $bucket,
//                     'Key' => $img
//                 ]);
//                 $awsRequest = $client->createPresignedRequest($command, '+500 minutes');
//                 $image = (string) $awsRequest->getUri();
//             } else {
//                 $image = (string) $s3->url($img);
//             }
//         }
//     }
//     return $image;
// }
