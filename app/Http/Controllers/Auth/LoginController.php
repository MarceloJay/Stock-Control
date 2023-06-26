<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout']]);
    }


    public function welcome_first() {
        return view('welcome');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        /*
         * Remove the socialite session variable if exists
         */

        \Session::forget(config('access.socialite_session_name'));

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => __('auth.failed')];

        $ip = \Request::ip();
        DB::statement("INSERT INTO login_history (email, login_time, ip, success)
                        VALUES (?, UNIX_TIMESTAMP(), '$ip', 0)", [$request->email]);

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $errors = [];

        // Check if reseller is authorized
        if ($this->isResellerAuthorized($user) == false) {
            $errors = [$this->username() => "I'm sorry but your user is not yet authorized to log in."];
        }
        
        if (config('auth.users.confirm_email') && !$user->confirmed) {
            $errors = [$this->username() => __('auth.notconfirmed', ['url' => route('confirm.send', [$user->email])])];
        }

        if (!$user->active) {
            $errors = [$this->username() => __('auth.active')];
        }

        // Store login history
        $hasErrors = $errors ? 0 : 1;
        $ip = \Request::ip();
        DB::statement("INSERT INTO login_history (email, login_time, ip, success)
                        VALUES (?, UNIX_TIMESTAMP(), '$ip', $hasErrors)", [$request->email]);

        if ($errors) {
            auth()->logout();  //logout

            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
        }

        return redirect()->intended($this->redirectPath());
    }

    public function isResellerAuthorized($user) {
        // Not a reseller
        if ($user->roles[0]->weight !== 800) {
            return true;
        }

        // Check whether the reseller has his card authorized by Customer Support
        $authorized = DB::select("SELECT COUNT(1) AS total
                                    FROM users u
                                    -- INNER JOIN agreement_acceptance aa
                                    -- ON u.email = aa.email
                                    INNER JOIN payment_info pi 
                                    ON pi.user_id = u.id
                                    WHERE u.id = ?
                                    AND pi.authorized_at > 0", [$user->id]);

        // Invalid result
        if ($authorized === false) {
            return false;
        }

        // Not authorized
        if ($authorized[0]->total <= 0) {
            return false;
        }

        return true;
    }
    

    public function isDistributorAuthorized($user) {
        // Not a distributor
        if ($user->roles[0]->weight !== 900) {
            return true;
        }

        // Check whether the reseller has his card authorized by Customer Support
        $authorized = DB::select("SELECT COUNT(1) AS total
                                    FROM users u
                                    -- INNER JOIN agreement_acceptance aa
                                    -- ON u.email = aa.email
                                    INNER JOIN payment_info pi 
                                    ON pi.user_id = u.id
                                    WHERE u.id = ?
                                    AND pi.authorized_at > 0", [$user->id]);

        // Invalid result
        if ($authorized === false) {
            return false;
        }

        // Not authorized
        if ($authorized[0]->total <= 0) {
            return false;
        }

        return true;
    }
}