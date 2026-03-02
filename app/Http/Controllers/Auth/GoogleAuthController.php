<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find or create user
            $user = User::where('provider', 'google')
                ->where('provider_id', $googleUser->getId())
                ->first();

            if (!$user) {
                // Check if email already exists
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // Link Google account to existing user
                    $existingUser->update([
                        'provider' => 'google',
                        'provider_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                    $user = $existingUser;
                } else {
                    // Create new user
                    $username = $this->generateUniqueUsername($googleUser->getName());

                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'username' => $username,
                        'email' => $googleUser->getEmail(),
                        'password' => Hash::make(Str::random(32)),
                        'avatar' => $googleUser->getAvatar(),
                        'provider' => 'google',
                        'provider_id' => $googleUser->getId(),
                        'email_verified_at' => now(),
                    ]);
                }
            } else {
                // Update avatar if changed
                if ($user->avatar !== $googleUser->getAvatar()) {
                    $user->update(['avatar' => $googleUser->getAvatar()]);
                }
            }

            // Login user
            Auth::login($user, true);

            return redirect()->intended(route('home'))
                ->with('success', 'Berhasil login dengan Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Generate unique username.
     */
    private function generateUniqueUsername($name)
    {
        $username = Str::slug($name, '');

        // Check if username exists
        $count = User::where('username', 'LIKE', $username . '%')->count();

        if ($count > 0) {
            $username = $username . ($count + 1);
        }

        return $username;
    }
}
