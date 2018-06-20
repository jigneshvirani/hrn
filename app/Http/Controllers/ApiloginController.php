<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
//load authorization library
use Hash;
//load session & other useful library
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//define model
use View;
use Response;
use stdClass;
use App\Apiuser;
use App;
use Session;
use DateTime;
use Carbon\Carbon;

class ApiloginController extends Controller
{
    //
    public function Dologin(Request $request){

    	//global declaration
		$ResponseData['success'] =  false;
		$ResponseData = array();
		
		//get data from request and process
		$PostData = Input::all();

		if (isset($PostData) && !empty($PostData)) {

            //make validator for facebook
			$ValidateFacebook = Validator::make(array(
				'email' => Input::get('email'),
				'lang' => Input::get('lang'),
				'password' => Input::get('password')
			), array(
				'email' => 'required',
				'lang' => 'required',
				'password' => 'required'
			));
			
			if ($ValidateFacebook->fails()) {
				$ResponseData['message'] = $ValidateFacebook->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			}else {
				App::setLocale($request->get('lang'));

				$credentials = [
                    "email" => Input::get("email"),
                    "password" => Input::get("password"),
                    'status'=> 1
                ];
                
                if(Auth::guard('web')->attempt(['email' => Input::get("email"), 'password' => Input::get("password")])) {
					$getUserData = Apiuser::where('email', $request->get('email'))->first()->toArray();
                	unset($getUserData['password']);
                	// Get user info.
                	//print_r($getUserData['id']);die;
					$getuserinfo = Apiuser::GetProfile($getUserData['id']);
                	$ResponseData['data'] = $getuserinfo;
                    $ResponseData['success'] = true;
                    $ResponseData['message'] = trans('message.message.LOGIN_SUCCESS');
                } else {
                    $ResponseData['success'] = false;
                    $ResponseData['data'] = array();
                    $ResponseData['message'] = trans('message.message.LOGIN_ERROR');
                }
			}
		} else {
            //print error response
			$ResponseData['success'] =  false;
			$ResponseData['message'] = trans('message.message.INVALID_PARAMS');
			$ResponseData['data'] = new stdClass();
		}
		
		//print response.
		return Response::json($ResponseData, 200, [], JSON_NUMERIC_CHECK);
    }

    // To signup the user
	public function Dosignup(Request $request){

		//global declaration
		$ResponseData['success'] =  false;
		//$ResponseData['message'] = Config('message.message.GENERAL_ERROR');
		$ResponseData = array();
		
		//get data from request and process
		$PostData = Input::all();

		if (isset($PostData) && !empty($PostData)) {

            //make validator for facebook
			$ValidateFacebook = Validator::make(array(
				'password' => Input::get('password'),
				'email' => Input::get('email'),
				'lang' => Input::get('lang'),
				'name' => Input::get('name')
			), array(
				'password' => 'required',
				'name' => 'required',
				'lang' => 'required',
				'email' => 'required'
			));
			
			if ($ValidateFacebook->fails()) {
				$ResponseData['message'] = $ValidateFacebook->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			}else {
				
				App::setLocale($request->get('lang'));
				$checkUserExist = Apiuser::where('email', $request->get('email'))->get()->toArray();
				
				if(!$checkUserExist){
					
					// Not available
					$addUser = new Apiuser();
					$addUser->name = $request->get('name');
					$addUser->email = Input::get('email');
					$addUser->phone_number = Input::get('mobile');
					$addUser->facebook_id = '';
					$addUser->google_id = '';
					$addUser->password = Hash::make(Input::get('password'));
					$addUser->login_type = 1;
					$addUser->status = 1; // pending OTP verification;
					$addUser->created_at = date('Y-m-d H:i:s');
					$addUser->save();
					
					// To add user.
					if($addUser){
						## SEND AN EMAIL HERE.
						$ResponseData['success'] = true;
						$ResponseData['data'] = Apiuser::find($addUser->id)->toArray();
						$ResponseData['message'] = trans('message.message.USER_SIGNIP');
					}
				}else{
					$ResponseData['success'] = false;
					$ResponseData['message'] = trans('message.message.USER_ALREADY_SIGNUP'); 
				}
			}
		} else {
			//print error response
			$ResponseData['success'] =  false;
			$ResponseData['message'] = trans('message.message.GENERAL_ERROR');
			$ResponseData['data'] = new stdClass();
		}
		
		//print response.
		return Response::json($ResponseData, 200, [], JSON_NUMERIC_CHECK);
	}

	// To login with Facebook
	public function DoLoginfacebook(Request $request){

		//global declaration
		$ResponseData['success'] =  false;
		$ResponseData = array();

        //get data from request and process
		$PostData = Input::all();
		App::setLocale($request->get('lang'));
		if (isset($PostData) && !empty($PostData)) {

            //make validator for facebook
			$ValidateFacebook = Validator::make(array(
				'facebook_id' => Input::get('facebook_id'),
				'lang' => Input::get('lang')
			), array(
				'facebook_id' => 'required',
				'lang' => 'required'
			));
			if ($ValidateFacebook->fails()) {
				$ResponseData['message'] = $ValidateFacebook->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			} else {

				$CheckFBLogin = Apiuser::CheckFbUserExist($PostData);
				if ($CheckFBLogin['status'] == 1) {
					$ResponseData['success']  = true;
					$ResponseData['message'] = $CheckFBLogin['message'];
					$ResponseData['data'] = $CheckFBLogin['user_data'];
				} else {
					$ResponseData['success'] =  false;
					$ResponseData['message'] = $CheckFBLogin['message'];
					$ResponseData['data'] = new stdClass();
				}
			}
		} else {
            //print error response
			$ResponseData['success'] =  false;
			$ResponseData['message'] = trans('message.message.INVALID_PARAMS');
			$ResponseData['data'] = new stdClass();
		}
		//print response.
		return Response::json($ResponseData, 200, [], JSON_NUMERIC_CHECK);
	}

	//To login with  Google
	public function Dologingoogle(Request $request){

		//global declaration
		$ResponseData['success'] =  false;
		$ResponseData = array();

        //get data from request and process
		$PostData = Input::all();
		 App::setLocale($request->get('lang'));
		if (isset($PostData) && !empty($PostData)) {

            //make validator for facebook
			$ValidateGoogle = Validator::make(array(
				'google_id' => Input::get('google_id'),
				'lang' => Input::get('lang')
			), array(
				'google_id' => 'required',
				'lang' => 'required'
			));
			if ($ValidateGoogle->fails()) {
				$ResponseData['message'] = $ValidateGoogle->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			} else {
				$CheckGoogleLogin = Apiuser::CheckGooleUserExist($PostData);
				if ($CheckGoogleLogin['status'] == 1) {
					$ResponseData['success']  = true;
					$ResponseData['message'] = $CheckGoogleLogin['message'];
					$ResponseData['data'] = $CheckGoogleLogin['user_data'];
				} else {
					$ResponseData['success'] =  false;
					$ResponseData['message'] = $CheckGoogleLogin['message'];
					$ResponseData['data'] = new stdClass();
				}
			}
		} else {
            //print error response
			$ResponseData['success'] =  false;
			$ResponseData['message'] = Config('message.message.INVALID_PARAMS');
			$ResponseData['data'] = new stdClass();
		}
		//print response.
		return Response::json($ResponseData, 200, [], JSON_NUMERIC_CHECK);
	}

}
