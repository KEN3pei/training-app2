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
        // $x = "redirect";
        // dd($x);
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
        //validationをかけている
        if($gUser->name == null){
            return "googleアカウントにUsernameが設定されていません";
        }
        if($gUser->email == null){
            return "googleアカウントにemailが設定されていません";
        }
        //テーブルから一致するものを探す
        $user = User::where('email', $gUser->email)->first();
        // dd($user);
        if($user == null){
            //$userがなかった時の処理
            $user = $this->createUserBySNS($gUser);
            dd($user);
        }
        \Auth::login($user, true);
        return redirect('/home');
    }
    //----------------------------------------------------
    // Twitterのログイン画面へリダイレクト
    //---------------------------------------------------
    public function redirectToTwitter()
    {
        // $x = "redirect";
        // dd($x);
        return Socialite::driver('twitter')->redirect();
    }
    
    //-------------------------------------------------
    // Googleログイン判定
    //-------------------------------------------------
    public function handleTwitterCallback(){
        // $x = "redirect";
        // dd($x);
        $gUser = Socialite::driver('twitter')->user();
        //validationをかけている
        if($gUser->name == null){
            return "twitterにUsernameが設定されていません";
        }
        if($gUser->email == null){
            return "twitterにemailが設定されていません";
        }
        
        $user = User::where('email', $gUser->email)->first();
        // dd($user);
        //$userがなかったら$gUserをもとに新しく作る
        if($user == null){
            $user = $this->createUserBySNS($gUser);
            // dd($user);
        }
        \Auth::login($user, true);
        return redirect('/home');
    }
    
    public function createUserBySNS($gUser)
    {
        
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}
