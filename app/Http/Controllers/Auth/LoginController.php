<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;
use Socialite;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
    // ------------------------------------------------
    // Googleのログイン画面へリダイレクト
    //-------------------------------------------------
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //-------------------------------------------------
    // Googleログイン判定
    //-------------------------------------------------
    public function handleGoogleCallback()
    {
        //ユーザー情報を取得
        $gUser = Socialite::driver('google')->stateless()->user();
        // dd($gUser);
        $gUser->name ?? "googleアカウントにUsernameが設定されていません";
        $gUser->email ?? "googleアカウントにemailが設定されていません";
        
        $user = $this->checkDeleteFrag($gUser);
        
        \Auth::login($user, true);
        return redirect('/home');
    }
    //----------------------------------------------------
    // Twitterのログイン画面へリダイレクト
    //---------------------------------------------------
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
    
    //-------------------------------------------------
    // Twitterログイン判定
    //-------------------------------------------------
    public function handleTwitterCallback(){
        
        $gUser = Socialite::driver('twitter')->user();
        // dd($gUser);
        $gUser->name ?? "twitterにUsernameが設定されていません";
        $gUser->email ?? "twitterにUsernameが設定されていません";
        
        $user = $this->checkDeleteFrag($gUser);
        
        \Auth::login($user, true);
        return redirect('/home');
    }
    
    //------------------------------------------------
    // ユーザーの作成
    //------------------------------------------------
    public function createUserBySNS($gUser)
    {
        
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
    
    //------------------------------------------------
    // deleteフラグのチェック
    //------------------------------------------------
    public function checkDeleteFrag($gUser) {
        
        $check_user = User::where('email', $gUser->email)->where('deletefrag', "true")->first();
        if(!$check_user == null){
            // dd($check_user);
            $user = User::find($check_user->id);
            $user->deletefrag = "false";
            $user->save();
        }else{
            $user = User::where('email', $gUser->email)->where('deletefrag', "false")->first();
            // dd($user);
            if($user == null){
            $user = $this->createUserBySNS($gUser);
            // dd($user);
            }
        }
        return $user;
    }
}
