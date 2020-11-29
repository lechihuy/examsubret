<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

use App\Models\Teacher;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin,teacher')
            ->only('login', 'showLoginForm', 'loginOauth2', 'callbackOauth2');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $crendentials = $request->only($this->username(), 'password');
        $guard = null;

        if (! auth('admin')->attempt($crendentials)) {
            if (! auth('teacher')->attempt($crendentials)) {
                return $this->respondFailedLogin();
            } else {
                $guard = 'teacher';
            }
        } else {
            $guard = 'admin';
        }

        return $this->respondSuccessLogin($guard);
    }

    public function loginOauth2()
    {
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OAUTH_APP_ID'),
            'clientSecret'            => env('OAUTH_APP_PASSWORD'),
            'redirectUri'             => env('OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_SCOPES'),
        ]);
        
        $authUrl = $oauthClient->getAuthorizationUrl();
    
        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState()]);

        // Redirect to AAD signin page
        return redirect()->away($authUrl);
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request)
    {
        if (is_auth()) {
            auth(current_guard())->user()->log('logout');
            auth()->logout();
            $request->session()->invalidate();
        }

        return redirect()->route('auth.login.form');
    }

    protected function respondFailedLogin()
    {
        return back()->withErrors([
            'username' => ['Tên đăng nhập hoặc mật khẩu không chính xác.']
        ], 'login')->withInput();
    }

    protected function respondSuccessLogin($guard)
    {
        auth($guard)->user()->updateLastLogin();

        return redirect('/');
    }

    protected function respondFailedLoginOauth2()
    {
        return redirect()->route('auth.login.form')
            ->withErrors([
                'username' => 'Đã có lỗi trong quá trình đăng nhập Office 365, hãy thử lại.'
            ], 'login');
    }

    public function callbackOauth2(Request $request)
    {
        // Validate state
        $expectedState = session('oauthState');
        $request->session()->forget('oauthState');
        $providedState = $request->query('state');

        if (!isset($expectedState)) {
            return $this->respondFailedLoginOauth2();
        }

        if (!isset($providedState) || $expectedState != $providedState) {
            return $this->respondFailedLoginOauth2();
        }

        // Authorization code should be in the "code" query param
        $authCode = $request->query('code');

        if (isset($authCode)) {
            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                'clientId'                => env('OAUTH_APP_ID'),
                'clientSecret'            => env('OAUTH_APP_PASSWORD'),
                'redirectUri'             => env('OAUTH_REDIRECT_URI'),
                'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
                'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
                'urlResourceOwnerDetails' => '',
                'scopes'                  => env('OAUTH_SCOPES')
            ]);

            try {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $authCode
                ]);

                $graph = new Graph();
                $graph->setAccessToken($accessToken->getToken());

                $user = $graph->createRequest('GET', '/me?$select=userPrincipalName')
                    ->setReturnType(Model\User::class)
                    ->execute();

                $email = $user->getUserPrincipalName();
                $username = explode('@', $email)[0];
                $password = bcrypt($username);

                if (Teacher::canCreate($email)) {
                    Teacher::create([
                        'email' =>  $email,
                        'fullname' => $user->getDisplayName(),
                        'username' => $username,
                        'password' => $password
                    ]);
                }

                $teacher = Teacher::firstWhere('email', $email);
                $teacher->updateLastLogin();

                $token = auth('teacher')->login($teacher);
                
                return redirect('/');
            } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                return $this->respondFailedLoginOauth2();
            }
        }

        return $this->respondFailedLoginOauth2();
    }
}
