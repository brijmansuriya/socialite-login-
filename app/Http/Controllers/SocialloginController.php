<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
    
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class socialloginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            
            $finduser = User::where('fb_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/');
            }else{
                
                $form_data = array(
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id'=>$user->id,
                    'password' => encrypt('fb@123'),
				);

                $newUser = User::create($form_data);

                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
