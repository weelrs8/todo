<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            Log::error('Google authentication failed', [
                'message' => $e->getMessage(),
                'exception' => $e,
            ]);

            return to_route('home')->with('error', 'Google authentication failed');
        }

        $user = $this->getUser($googleUser->getId());

        $user->google_id    = $googleUser->getId();
        $user->name         = $googleUser->getName() ?: $googleUser->getNickname();
        $user->username     = $googleUser->getNickname();
        $user->email        = $googleUser->getEmail();
        $user->avatar       = $googleUser->getAvatar();
        $user->save();

        Auth::login($user);

        return to_route('dashboard');
    }

    public function getUser(mixed $id): User
    {
        return User::where('google_id', '=', $id)->firstOrNew();
    }
}
