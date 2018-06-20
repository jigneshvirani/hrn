<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

// To check Api user is exist or not.
class Apiuser extends Model
{
    protected $fillable = [
        'name','phone_number','email', 'password', 'facebook_id', 'google_id', 'login_type','created_at'
    ];
    
    //Define the table name
    protected $table = 'users';

    // To check the Facebook exist.
    public static function CheckFbUserExist($Params) {

        //global declaration
        $ReturnData = array();
        $CreatedOn = date('Y-m-d H:i:s');
        
        //extract params.
        extract($Params);
      
        $QueryUser = DB::table('users')
                        ->select(DB::Raw('id as user_id'),  'name','profile_pic', 'facebook_id', 'status', 'login_type', 'phone_number')
                        ->where('facebook_id', $facebook_id)
                        ->take(1)
                        ->first();

        $ResultUser = json_decode(json_encode($QueryUser), true);

        if ($ResultUser) {
                $ReturnData['status'] = true;
                $ReturnData['message'] = trans('message.message.LOGIN_SUCCESS');
                $ReturnData['user_data'] = $ResultUser;
        } else { //USER DOESTNT EXISTS

            // create the user now
            //generate new referral code for profile
            $InsertArray = array(
                'name' => isset($name) ? $name : '',
                'facebook_id' => $facebook_id,
                'login_type' => 2,
                'profile_pic' => isset($profile_pic) && $profile_pic != '' ? $profile_pic : '',
                'status' => 1,
                'created_at' => $CreatedOn,
            );

            $RegisterUser = DB::table('users')->insertGetId($InsertArray);
            if (isset($RegisterUser) && $RegisterUser > 0) {
                    //get user details
                    $GetUserProfile = self::GetProfile($RegisterUser);
                    $ReturnData['status'] = true;
                    $ReturnData['message'] = trans('message.message.LOGIN_SUCCESS');
                    $ReturnData['user_data'] = $GetUserProfile['user_data'];
            } else {
                    $ReturnData['status'] = false;
                    $ReturnData['message'] = trans('message.message.GENERAL_ERROR');
            }
        }
        return $ReturnData;
    }

    // To check google user is exist or not.
    public static function CheckGooleUserExist($Params){
    
        //global declaration
        $ReturnData = array();
        $CreatedOn = date('Y-m-d H:i:s');
        //extract params.
        extract($Params);
        
        $QueryUser = DB::table('users')
                          ->select(DB::Raw('id as user_id'),  'name','profile_pic', 'google_id', 'status', 'login_type', 'phone_number')
                        ->where('google_id', $google_id)
                        ->take(1)
                        ->first();

        $ResultUser = json_decode(json_encode($QueryUser), true);

        if ($ResultUser) {
                $ReturnData['status'] = true;
                $ReturnData['message'] = trans('message.message.LOGIN_SUCCESS');
                $ReturnData['user_data'] = $ResultUser;
        } else { //USER DOESTNT EXISTS
           
            //generate new referral code for profile
            $InsertArray = array(
                'name' => isset($name) ? $name : '',
                'google_id' => $google_id,
                'login_type' => 3,
                'profile_pic' => isset($profile_pic) && $profile_pic != '' ? $profile_pic : '',
                'status' => 1,
                'created_at' => $CreatedOn,
            );

            $RegisterUser = DB::table('users')->insertGetId($InsertArray);
            if (isset($RegisterUser) && $RegisterUser > 0) {
                //get user details
                $GetUserProfile = self::GetProfile($RegisterUser);
                $ReturnData['status'] = true;
                $ReturnData['message'] = trans('message.message.LOGIN_SUCCESS');
                $ReturnData['user_data'] = $GetUserProfile['user_data'];
            }else{
                $ReturnData['status'] = false;
                $ReturnData['message'] = trans('message.message.GENERAL_ERROR');
            }
        }

        return $ReturnData;        
    }

    // To profile of users
    public static function GetProfile($UserId) {

        //global declaraton.
        $ReturnData = array();

        $queryUser = DB::table('users')
                    ->select(DB::Raw('id as user_id'), 'name',
                                'login_type',
                                'facebook_id',
                                'email',
                                'google_id',
                                'phone_number',
                                'profile_pic')
                    ->where('id', $UserId)
                    ->first();

        $userData = json_decode(json_encode($queryUser), true);
        
        // To user data
        if ($userData) {
            // Profile picture.
            if($userData['profile_pic'] !=''){
               $userData['profile_pic'] = self::Getuserphoto(array('user_id' => $userData['user_id'])); 
            }else{
               $userData['profile_pic'] =  url('resources/uploads/profilepic/').'/'.'default.png';
           }

            $ReturnData['status'] = true;
            $ReturnData['user_data'] = $userData;
        } else {
            $ReturnData['status'] = false;
        }
        
        return $ReturnData;
    }

    // To get the user profile picture.
    public static function Getuserphoto($params){

        $getUser = Apiuser::select('*')->where('id', $params['user_id'])->first()->toArray();

        if($getUser['login_type'] == 1){

            $fileUrl = resource_path('uploads/profilepic/').$getUser['profile_pic'];
            if(file_exists($fileUrl)){
                $profileUrl = url('resources/uploads/profilepic/').'/'.$getUser['profile_pic'];
            }else{
                $profileUrl = url('resources/uploads/profilepic/').'/'.'default.png';
            }
        }else{
            $profileUrl = $getUser['profile_pic'];
        }

        return $profileUrl;
    }

}