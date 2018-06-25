<?php

namespace App\Http\Controllers;

//load required library by use
use App\User;
use Auth;
//load authorization library
use Hash;
//load session & other useful library
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
//define model
use View;
class LoginController extends Controller
{
    public function __construct()
    {
        //Artisan::call('cache:clear');
    }

    ## To check if logged in then redirect to dashboard.
    public function index()
    {

        //if yes then redirec to dashboard
        if (Auth::check()) {
            return redirect('manage/dashboard/');
        } else {
           return View::make("manage.loginform");
        }
    }

    public function Dologin(Request $request)
    {

        //global initialise of varaiable
        $returnData = array();
        $isLoggedIn = 0;

        //get all post data for login
        $postData = $request->all();

        //proceed for login
        if (isset($postData) && !empty($postData)) {

            //define validator
            $loginValidator = Validator::make(array(
                'password' => Input::get('password'),
                'email'    => Input::get('email'),
            ), array(
                'password' => 'required',
                'email'    => 'required|email',
            ));
            //check if user already logged in
            if (Auth::check()) {
                $isLoggedIn = 1;
            }
            //validate the parameters

            if ($loginValidator->fails()) {

                $returnData['status']  = '0';
                $returnData['message'] = Config('constant.admin_messages.INVALID_PARAMS');
            } else if ($isLoggedIn == '1') {
                //user already logged in then retrun success
                $returnData['status']  = '1';
                $returnData['message'] = Config('constant.admin_messages.LOGIN_SUCCESS');
            } else {
                //check user's credentials

                $credentials = [
                    "email" => Input::get("email"),
                    "password"      => Input::get("password"),
                ];
                //check for remember checkbox is checked or not
                $remember = (Input::has('remember')) ? true : false;
                //attempt for authentication with remember me
                if (Auth::guard('admin')->attempt($credentials, $remember)) {

                    $returnData['status']  = '1';
                    $returnData['message'] = Config('constant.admin_messages.LOGIN_SUCCESS');
                } else {
                    $returnData['status']  = '0';
                    $returnData['message'] = Config('constant.admin_messages.LOGIN_ERROR');
                }
            }
        } else {
            $returnData['status']  = '0';
            $returnData['message'] = Config('constant.admin_messages.INVALID_PARAMS');

        }
        //return response
        return $returnData;
    }

    public function Forgotpassword()
    {

        //initilise data
        $returnData = array();
        $postData   = Input::all();

        if (isset($postData) && !empty($postData)) {
            //define validator
            $passwordValidator = Validator::make(array(
                'email' => Input::get('email_fp'),
            ), array(
                'email' => 'required|exists:users,email_address',
            ));
            //check for validator
            if ($passwordValidator->fails()) {

                $returnData['status']  = '0';
                $returnData['message'] = $passwordValidator->messages()->first();
            } else {
                //update password token and send email for forgot password
                //get email address
                $userEmail = Input::get('email_fp');

                /* Generate random string with 25 charater. */
                $forgetToken = str_random(25);

                /* Generate the link with parameter. */
                $emailParams = array('forgot_token' => $forgetToken, 'email' => base64_encode($userEmail));

                $resetURL = action('LoginController@Resetpassword', $emailParams);


                /* Update the user with forgot token. */
                //get user object for admin user
                $userObject = User::find(1);
                //update forgot token
                $userObject->forgot_token = $forgetToken;

                //if token is saved then send email
                if ($userObject->save()) {

                    //prepare parameter to send in email
                    $data['username'] = $userObject->name;

                    $data['link']     = $resetURL;
                    $data['email']    = Input::get('email_fp');

                    Mail::send('emails.forgotpassword', $data, function ($message) use ($data) {
                        $message->from('noreply@homex.com', 'Homex');

                    });

                    $returnData['status']  = '1';
                    $returnData['message'] = Config('constants.admin_messages.FORGOT_PASSWORD_SUCCESS');
                } else {
                    $returnData['status']  = '0';
                    $returnData['message'] = Config('constants.admin_messages.GENERAL_ERROR');
                }
            }
        } else {
            $returnData['status']  = '0';
            $returnData['message'] = Config('constants.admin_messages.INVALID_PARAMS');
        }

        //return data
        return $returnData;
    }

    public function Resetpassword(Request $Request)
    {

        //get token and email from url
        $forgotToken = $Request->get('forgot_token');
        $email       = base64_decode($Request->get('email'));

        //check if the link is expired or not
        $userObject = User::where('email_address', $email)->where('forgot_token', $forgotToken)->exists();

        if ($userObject) {
            //user data is found, proceed for reset password
            return view::make("adminsetnewpassword")->with('email', $email);
        } else {
            //load view for url expired
            return view::make("adminurlexpired");
        }
    }

    public function Doresetpassword()
    {

        //get all post data for login
        $postData = Input::all();

        //proceed for login
        if (isset($postData) && !empty($postData)) {
            //define validator
            $resetPassword = Validator::make(array(
                'password'              => Input::get('password'),
                'password_confirmation' => Input::get('password_confirmation'),
            ), array(
                'password'              => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ));
            //validate the parameters
            if ($resetPassword->fails()) {
                //check for validator
                $returnData['status']  = '0';
                $returnData['message'] = $resetPassword->messages()->first();
            } else {
                //proceed for reset password
                //make password
                $newPassword = Hash::make(Input::get('password'));
                //update new password for user
                //get user object for admin user
                $userObject = User::find(1);
                //update forgot token
                $userObject->password     = $newPassword;
                $userObject->forgot_token = '';

                //if token is saved then send email
                if ($userObject->save()) {
                    $returnData['status']  = '1';
                    $returnData['message'] = Config('constants.admin_messages.SUCCESS_PASSWORD_CHANGE');
                } else {
                    $returnData['status']  = '0';
                    $returnData['message'] = Config('constants.admin_messages.GENERAL_ERROR');
                }
            }
        } else {
            $returnData['status']  = '0';
            $returnData['message'] = Config('constants.admin_messages.INVALID_PARAMS');
        }
        //return response
        return $returnData;
    }

    public function Logout()
    {
        //logout user
        Auth::logout();
        //redirect user to login screen
        return redirect('manage/login');
    }
}
