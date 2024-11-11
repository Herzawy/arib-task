<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = $this->attemptLogin($request);

        if ($user) {
            Auth::login($user);

            return redirect()->intended($this->redirectTo);
        }

        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }

        return null;
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
