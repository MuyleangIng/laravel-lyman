<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $existingUser = User::where('email', $user->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name'             => $user->getName(),
                    'email'            => $user->getEmail(),
                    'password'         => Hash::make(Str::random(8)),
                    'provider_name'    => $provider,
                    'provider_id'      => $user->getId(),
                    'provider_token'   => $user->token,
                    'photo'            => $user->getAvatar(),
                    'email_verified_at' => now(),
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Unable to login. Please try again.']);
        }
    }
    
}
