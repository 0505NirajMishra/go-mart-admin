<?php

namespace App\Services;

use App\Models\User;
use App\Models\Rating;
use App\Models\SetAvailability;
use App\Mail\SendEmail;
use App\Models\Advisorie;
use App\Models\MasterOtp;
use App\Models\BookAnAppointment;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    /**
     * Create the specified resource.
     *
     * @param Request $request
     * @return User
     */
    public static function create(array $data)
    {
        $data = User::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public static function updateById(array $data, $user_id)
    {
        $data = User::where('id', $user_id)->update($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Array $data
     * @param  App\Models\User  $user
     * @return bool
     */
    public static function update(array $data, User $user)
    {
        $data = $user->update($data);
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\User  $user
     */
    public static function getById($id)
    {
        $data = User::with('roles')->find($id);
        return $data;
    }
    public static function getNameById($id)
    {
        $data = User::where('id',$id)->first(['name']);

        return $data->name;

    }



    /**
     * Get the specified resource in storage.
     *
     * @return  App\Models\User  $data
     */
    public static function getAdminUser()
    {

        $data = User::find(1);
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByParameters($parameters)
    {
        $data = User::query();
        foreach ($parameters as $parameter) {
            $data = $data->where($parameter['column_name'], $parameter['value']);
        }
        return $data;
    }

    /**
     * Delete data by user.
     *
     * @param User $user
     * @return bool
     */
    public static function delete(User $user)
    {
        $data = $user->delete();
        return $data;
    }


    public static function datatable()
    {
        $data = DB::table('users')->orderBy('created_at', 'desc')->whereNotIn("name", ['Admin'])->paginate(10);
        return $data;
    }


    public static function checklikestatus($item_id,$userid)
    {
        $data = DB::table('favorites')->select('like_status')->where('item_id',$item_id)->where('user_id',$userid)->first();
        return $data;
    }


    /**
     * update status.
     *
     * @param Array $data
     * @param int $id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = User::where('id', $id)->update($data);
        return $data;
    }

    /**
     * update Last Login details.
     *
     * @param int $id
     * @param Request $request = null
     * @return bool
     */
    public static function updateLastLogin($id, $request = null)
    {
        $input = [
            'last_login' => Carbon::now()
        ];

        if ($request) {
            $input = [
                'device_id' => $request->get('device_id'),
                'device_type' => $request->get('device_type'),
                'is_online' => 1
            ];
        }
        $data = User::where('id', $id)->update($input);
        return $data;
    }

    /**
     * Get user with relations
     *
     * @param Int $id
     * @param Array $relations
     * @return \App\Models\User
     */
    public static function getByIdWithRelations($id, $relations = [])
    {
        $data = User::where('id', $id);
        foreach ($relations as $relation) {
            $data = $data->with($relation);
        }
        $data = $data->first();
        return $data;
    }


    public static function user_search(Request $request)
    {


        $data = User::
        where('name', 'like', "%{$request->search}%")
        ->orwhere('email', 'like', "%{$request->search}%")
        ->orwhere('phone', 'like', "%{$request->search}%")
        ->orderBy('created_at', 'desc')->whereNotIn("name", ['Admin'])->paginate(10);
        return $data;

    }

    public static function update_password(User $user, String $password,)
    {

        $data = $user->update([
            'password' => Hash::make($password)

        ]);
        return $data;
    }

    public static function getPushNotify($user_id)
    {
        $data = User::where('id', $user_id)
            ->select('push_notify')
            ->first();
        return $data;
    }

    /**
     * Send Mail On Registration
     *
     * @param Int $id
     * @param Array $relations

     */
    public static function register_mail(array $detail, $request)
    {

       try{

        $details = [
            'title' => $detail['title'],
            'otp'=>$detail['otp'],

        ];


        $data=Mail::to($request)->send(new \App\Mail\Register($details));

        return $data;
    }
    catch(Exception $e){
        dd("Error: ". $e->getMessage());
    }
    }


 /**
     * Send Mail
     *
     * @param Int $id
     * @param Array $relations

     */
    // public static function send_forgetmail(array $detail, $request)
    // {
    //     try{
    //     $details = [
    //         'title' => $detail['title'],
    //         'body' => $detail['body'],
    //         'url'=>$detail['url'],
    //     ];

    //     $data=Mail::to($request)->send(new \App\Mail\ForgetEmail($details));
    //     return $data;
    // }
    // catch(\Exception $e){
    //         return;
    //     }

    // }



    public static function sendmail(Request $request){

        $otp = HelperService::createOtp();
        $input = [
        'phone' => $request->email,
        'otp' => $otp,
        'role' => 2,
            ];
            $user=User::where('email',$request->email)->first();
              if(!empty($user)){
                    MasterOtp::create($input);
                    $detail=array();
                    $detail['title']='Otp Verification';
                    $detail['otp']=$otp;
                     UserService::register_mail($detail,$request->email);

            return response()->json(
            [
                'status' => true,
                'message' => 'Otp Sent Successfully',

            ],
            200
            );
              }else{
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'User not Registerd with us',
                    ],
                    200
                    );
              }


    }



    public static function sendsms(Request $request){
        $otp = HelperService::createOtp();
                     $input = [
                     'phone' => $request->phone,
                     'otp' => $otp,
                     'role' => 2,
                         ];
                         $user=User::where('phone',$request->phone)->first();
                             if(!empty($user)){
                                 if(env('PRODUCTION', true)){
                                     HelperService::sendMessageTwilio($request->country_code,$request->phone,'Your Verification OTP Is',$otp);
                                     } else{
                             MasterOtp::create($input);
                                     }
                                 return response()->json(
                                 [
                                     'status' => true,
                                     'message' => 'Otp Sent Successfully',
                                     'data'=>$user
                                 ],
                                 200
                                 );
                             }else{
                                 return response()->json(
                                     [
                                         'status' => false,
                                         'message' => 'User not Registerd with us',

                                     ],
                                     200
                                     );
                             }
    }



    public static function send_forgetmail(array $detail, $request)
    {

        $sendemail =$request;
        $url = $detail['url'];
        $subject="Forget Password";
        $html_content="<html lang=en><head><title>Adventure</title></head><body><p>Please click on below link to reset your password</p><a href=$url>Click here to reset password</a><p>Thank You</p></body></html>";

        $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"sender\":{  \n      \"name\":\"Adventures\",\n      \"email\":\"noreply@email.qlowq.com\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"$sendemail\",\n         \"name\":\"Forget Password\"\n      }\n   ],\n   \"subject\":\"$subject\",\n   \"htmlContent\":\"$html_content\"\n}");

$headers = array();
$headers[] = 'Api-Key: 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';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

    }





    public static function delete_user($id){
        $result=DB::table('users')->where('id',$id)->delete();
        $result1=DB::table('travel')->where('user_id',$id)->delete();
        $result2=DB::table('ratings')->where('user_id',$id)->delete();
        return $result.$result1.$result2;
    }


    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByRoleId($role_id)
    {
        $data = Role::where('id', $role_id)->first()->users()->get();
        return $data;
    }

    /**
     * Get data for download Report from storage.
     *
     * @return User with all its Client data
     */
    public static function downloaduserReport()
    {
        $data = User::whereHas("roles", function ($q) {
            $q->whereNotIn("name", ['Admin']);
        })->select(
            'id',
            'name',
            'email',
            'mobile_no',
            DB::raw("(CASE WHEN (is_active = 1) THEN 'Active' ELSE 'Inactive' END) as status"),
            DB::raw("(DATE_FORMAT(created_at,'%d-%M-%Y')) as created_date"),
            DB::raw("(DATE_FORMAT(updated_at,'%d-%M-%Y')) as updated_date"),
        )->orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Delete the old user image
     */
    public static function deleteOldImage(User $user)
    {
        FileService::removeImage($user, 'image', 'files/users');
        $result = $user->delete();
        return $result;
    }
}
