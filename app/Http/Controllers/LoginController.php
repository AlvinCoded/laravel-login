<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    protected function guard()
    {
        return Auth::guard();
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo);
    }

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('/login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->isDefaultCredentials($request)) {
            return $this->sendFailedLoginResponse($request, 'Please enter your own credentials.');
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
{
    return redirect()->back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
}

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function isDefaultCredentials(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return $credentials['email'] === 'default@example.com' && $credentials['password'] === 'password';
    }

    // Redirect the user to the social media login page
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Obtain the user information from the social media provider
    public function handleProviderCallback($provider)
{
    $socialUser = Socialite::driver($provider)->user();
    $user = User::where('email', $socialUser->getEmail())->first();

    if (!$user) {
        // User not found in the database, create a new one
        $user = User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            // Set a random password for the user since they won't use it for logging in
            'password' => Hash::make(Str::random(16)),
            'provider' => $provider // Save the provider name to the user's record
        ]);
    } else {
        // User found in the database, update their details
        $user->name = $socialUser->getName();
        $user->provider = $provider; // Update the provider name in the user's record
        $user->save();
    }

    // Authenticate the user and redirect to the dashboard
    Auth::login($user);
    return redirect()->route('dashboard');
}


    // Find or create a user based on the social media provider information
    public function findOrCreateUser($user, $provider)
    {
        // Check if the user already exists
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        // Create a new user if the user doesn't exist
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }

    // Redirect the user to the Google authentication page
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the Google authentication callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->loginOrCreateAccount($user, 'google');

        return redirect()->route('dashboard');
    }

    // Redirect the user to the Facebook authentication page
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle the Facebook authentication callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->loginOrCreateAccount($user, 'facebook');

        return redirect()->route('dashboard');
    }

    // Redirect the user to the Twitter authentication page
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // Handle the Twitter authentication callback
    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $this->loginOrCreateAccount($user, 'twitter');

        return redirect()->route('dashboard');
    }

    // Helper method to log in the user or create a new account
    private function loginOrCreateAccount($socialiteUser, $provider)
    {
        // Check if the user already has an account
        $user = User::where('email', $socialiteUser->email)->first();

        if (!$user) {
            // Create a new user account
            $user = User::create([
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'password' => Hash::make(Str::random(16)),
            ]);
        }

        // Associate the social media account with the user
        $user->socialAccounts()->updateOrCreate([
            'provider_name' => $provider,
            'provider_id' => $socialiteUser->id,
        ]);

        // Log in the user
        Auth::login($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
