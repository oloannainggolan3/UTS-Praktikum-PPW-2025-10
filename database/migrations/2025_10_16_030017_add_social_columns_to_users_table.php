<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // cari user berdasarkan provider_id atau email
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (! $user) {
            // jika ada user dengan email sama, hubungkan
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (! $user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail() ?? Str::lower($socialUser->getId().'@'.$provider.'.local'),
                'email_verified_at' => now(), // social login dianggap verified
                'password' => bcrypt(Str::random(24)),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        } else {
            // update provider info jika perlu
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
