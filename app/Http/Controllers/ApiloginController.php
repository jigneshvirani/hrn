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

    // Do 
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
                
                if(Auth::guard('web')->attempt(['email' => Input::get("email"), 'password' => Input::get("password"), 'status' => 1])) {
					$getUserData = Apiuser::where('email', $request->get('email'))->first()->toArray();
                	unset($getUserData['password']);
                	// Get user info.
                	
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
			$ResponseData['success'] =  ResponseDatafalse;
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
				'dob' => Input::get('dob'),
				'name' => Input::get('name')
			), array(
				'password' => 'required',
				'name' => 'required',
				'lang' => 'required',
				'dob' => 'required',
				'email' => 'required'
			));
			
			if ($ValidateFacebook->fails()) {
				$ResponseData['message'] = $ValidateFacebook->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			}else {
				
				App::setLocale($request->get('lang'));
				$checkUserExist = Apiuser::where('email', $request->get('email'))->get()->toArray();

				// Not available
				if(!$checkUserExist){
					
					$emailToken = str_random(10);
					
					$addUser = new Apiuser();
					$addUser->name = $request->get('name');
					$addUser->email = Input::get('email');
					$addUser->facebook_id = '';
					$addUser->dob = Input::get('dob');
					$addUser->password = Hash::make(Input::get('password'));
					$addUser->verification_token = $emailToken;
					$addUser->login_type = 1;
					$addUser->status = 0; // pending OTP verification;
					$addUser->created_at = date('Y-m-d H:i:s');
					$addUser->save();
					
					// To add user.
					if($addUser){

						$dataArray = array();
				        $dataArray['name'] = $request->get('name');
				        $dataArray['code'] =  $emailToken;
				        $dataArray['email'] =  Input::get('email');

				        $recepients = Input::get('email');
				        $fromEmail = 'noreplay@hrn.com';
				        $fromEmailName = "LONDON HOT RIGHT NOW!";
				        $mailSubject = 'London HRN: Email verification';

				        ## SEND AN EMAIL HERE.
						Mail::send('email.account_verification', $dataArray, function ($message) use ($dataArray, $fromEmail, $fromEmailName, $recepients, $mailSubject) {
				            $message->from($fromEmail, $fromEmailName);
				            $message->to($recepients);
				            $message->subject($mailSubject);
				        });
						
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

				// Check FB login
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


	// Verify the email
	public function Verifyemail(Request $request, $token, $email){
		
		if(isset($email) && isset($token)){

			$getUser = Apiuser::where('email', $email)->get()->toArray();
			
			if(isset($getUser[0]['verification_token']) && $getUser[0]['verification_token'] == $token){

				$updateStatus = Apiuser::find($getUser[0]['id']);
				$updateStatus->status = 1;
				$updateStatus->save();

				$request->session()->flash('successMessage', 'Congratulations! Your account has been verified. Welcome to LONDON Hot Right Now!');
				return redirect('/');
			}else{
				$request->session()->flash('errorMessage', 'Oops! something went wrong.');
				return redirect('/');
			}
		}else{
			//$request->session()->flash('errorMessage', 'Oops! something went wrong.');
			return redirect('/');
		}
	}

	// Forgott password.
	public function Forgotpassword(Request $request){

		//global declaration
		$ResponseData['success'] =  false;
		$ResponseData = array();

        //get data from request and process
		$PostData = Input::all();
		App::setLocale($request->get('lang'));

		if (isset($PostData) && !empty($PostData)) {

            //make validator for facebook
			$ValidateFacebook = Validator::make(array(
				'email' => Input::get('email'),
				'lang' => Input::get('lang')
			), array(
				'email' => 'required',
				'lang' => 'required'
			));
			if ($ValidateFacebook->fails()) {
				$ResponseData['message'] = $ValidateFacebook->messages()->first();
				$ResponseData['success'] =  false;
				$ResponseData['data'] = new stdClass();
			} else {

				$getUser = Apiuser::where('email', Input::get('email'))->get()->toArray();
				$input['email'] = Input::get('email');

				$rule = array('email' => 'unique:users,email');
				$validator = Validator::make($input, $rule);
				
				// To make sure that's it.
				if ($validator->fails()) {

					$emailToken = str_random(5);

					$updateStatus = Apiuser::find($getUser[0]['id']);
					$updateStatus->password = Hash::make($emailToken);
					$updateStatus->save();

						$dataArray = array();
				        $dataArray['name'] = $getUser[0]['name'];
				        $dataArray['code'] =  $emailToken;
				        $dataArray['email'] =  Input::get('email');

				        $recepients = Input::get('email');
				        $fromEmail = 'noreplay@hrn.com';
				        $fromEmailName = "LONDON HOT RIGHT NOW!";
				        $mailSubject = 'London HRN: Forgot password';

				        ## SEND AN EMAIL HERE.
						Mail::send('email.forgotpassword', $dataArray, function ($message) use ($dataArray, $fromEmail, $fromEmailName, $recepients, $mailSubject) {
				            $message->from($fromEmail, $fromEmailName);
				            $message->to($recepients);
				            $message->subject($mailSubject);
				        });

						$ResponseData['success'] = true;
						$ResponseData['message'] = trans('message.message.PASSWORD_RESET_SUCCESS');
						$ResponseData['data'] = new stdClass();

				}else{
					$ResponseData['success'] = false;
					$ResponseData['message'] = trans('message.message.NO_EMAIL_FOUND');
					$ResponseData['data'] = new stdClass();
				}

				//if(isset($getUser[0][]'email')){}
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

}
