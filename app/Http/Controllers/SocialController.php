<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialController extends Controller
{
    // Redirige a Google o LinkedIn
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Callback de Google o LinkedIn
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        // Busca usuario por email
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Crea usuario nuevo
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(str()->random(16)), // password random
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
