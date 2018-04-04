<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserHasRegistered;
use App\Events\UserRequestedVerificationEmail;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['verify', 'resend']);
        $this->middleware('auth')->only(['verify']);
        $this->middleware('verified.email')->only(['resend']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function registrationValidation(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
        ]);

        VerificationToken::create([
                'user_id'    => $user->id,
                'token'      => bin2hex(random_bytes(16)),
                'created_at' => now(),
        ]);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->registrationValidation($request);

        event(new UserHasRegistered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }

    /**
     * Registration validation rules.
     *
     * @return array
     */
    private function rules()
    {
        return [
                'username' => 'required|string|max:255|unique:users',
                'email'    => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Login validation messages associated with rules.
     *
     * @return array
     */
    private function messages()
    {

        return [
                'username.required' => 'Please enter a valid :attribute',
                'username.string'   => 'Please enter a valid :attribute',
                'username.max'      => 'Please enter a valid :attribute',
                'username.unique'   => 'This :attribute is already taken',

                'email.required' => 'Please enter a valid :attribute',
                'email.string'   => 'Please enter a valid :attribute',
                'email.max'      => 'Please enter a valid :attribute',
                'email.unique'   => 'This :attribute is already taken',

                'password.required' => 'Please enter a valid :attribute',
                'password.string'   => 'Please enter a valid :attribute',
                'password.min'      => 'Please enter a valid :attribute',
        ];
    }

    public function verify(VerificationToken $token)
    {

        $code = $token->token;

        if (null !== auth()->user() && auth()->user()->verified_email == 1) {
            Session::flush();
            Session::flash('success', 'Your email address has already been verified');

            return view('home');
        }

        $valid = VerificationToken::where('token', '=', $code)
                                       ->where('user_id', '=', auth()->user()->id)
                                       ->get();

        if ($valid->isEmpty()) {
            Session::flush();
            return redirect('/')->with('warning', 'Token doesn\'t exist!');
        }

        $token->user()->update(['verified_email' => 1]);

        try {
            $token->delete();
        } catch(Exception $e) {
            throw new HttpResponseException(404);
        }

        Auth::login($token->user);

        return redirect('/')->with('success','Email verification successful.');
    }


    /**
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resend(User $user)
    {

        if(false === $user->hasVerifiedEmail()) {

            event(new UserRequestedVerificationEmail($user));
            Session::flash('verify', 'Verification email resent. Please check your inbox');

            return view('home');
        }

        Session::flush();

        return redirect('/')->with('success', 'You have already verified your email address with us.');
    }
}
