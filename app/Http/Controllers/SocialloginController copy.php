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
   
       

            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
                echo 111;
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                echo 2222;
                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'facebook_id'=>$user->id,
                //     'password' => 222222
                // ]);

                // $User = new User();
                // $User->name = $user->name;
                // $User->email = $user->email;
                // $User->facebook_id = $user->id;
                // $User->password = 11111;
                // $User->save();

                $form_data = array(
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=>$user->id,
                    'password' => 222222,
				);
                print_r($form_data);

                // Auth::login($newUser);
                exit;
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            echo 112322;
            dd($e->getMessage());
        }
    }
}
