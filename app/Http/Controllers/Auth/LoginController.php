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
        $this->middleware('guest')->except('logout');
    }
    
    
    public function redirectToGoogle()
    {
        // Googleのログイン画面へリダイレクト
        // $x = "redirect";
        // dd($x);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google 認証後の処理
        //ユーザー情報を取得
        $gUser = Socialite::driver('google')->stateless()->user();
        // dd($gUser);
        //テーブルから一致するものを探す
        $user = User::where('email', $gUser->email)->first();
        // dd($user);
        if($user == null){
            //$userがなかった時の処理
            $user = $this->createUserByGoogle($gUser);
        }
        Auth::login($user, true);
        
        
        
        return redirect('/home');
    }
    
    public function createUserByGoogle($gUser)
    {
        
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}
