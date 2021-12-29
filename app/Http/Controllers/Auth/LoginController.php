<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Carbon\Carbon;
use App\Login;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function index()
    {
        if($login = Session::get('auth')){
            return redirect($login->level);
        }else{
            Session::flush();
            return redirect('login');
        }
    }

     public function login(Request $req)
    {
        $login = User::where('username',$req->username)
            ->first();
        if($login && $login->status=='deactivate') {
            return Redirect::back()->withErrors(['msg' => 'Your account was deactivated by administrator.']);
        }
        else if($login)
        {
            if(Hash::check($req->password,$login->password))
            {
                Session::put('auth',$login);
                $last_login = date('Y-m-d H:i:s');
                User::where('id',$login->id)
                    ->update([
                        'last_login' => $last_login,
                        'login_status' => 'login'
                    ]);
                $checkLastLogin = self::checkLastLogin($login->id);

                $l = new Login();
                $l->user_id = $login->id;
                $l->login = $last_login;
                $l->status = 'login';
                $l->save();

                if($checkLastLogin > 0 ){
                    Login::where('id',$checkLastLogin)
                        ->update([
                            'logout' => $last_login
                        ]);
                }
                if($login->level=='admin')
                    return redirect('admin');
                if($login->level=='user' && $login->status=='active')
                    return redirect('user');
                else{
                    Session::forget('auth');
                    Session::put('username', $req->username);
                      return Redirect::back()->withErrors(['msg' => 'You don\'t have access in this system.']);
                }
            }
            else{
                Session::put('username', $req->username);
                return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
            }
        }
        else{
            Session::put('username', $req->username);
            return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
        }
    }

    function checkLastLogin($id)
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $login = Login::where('user_id',$id)
                    ->whereBetween('login',[$start,$end])
                    ->orderBy('id','desc')
                    ->first();
        if($login && (!$login->logout>=$start && $login->logout<=$end)){
            return true;
        }

        if(!$login){
            return false;
        }

        return $login->id;
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }
}
