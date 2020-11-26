<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

use App\Models\Teacher;

trait Authenticates
{
    public function login(Request $request) 
    {
        $crendentials = $request->only($this->username(), 'password');

        if (! $token = auth()->attempt($crendentials)) {
            return $this->respondFailedLogin();
        }

        return $this->respondSuccessLogin($token);
    }

    public function loginOutlook()
    {
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OAUTH_APP_ID'),
            'clientSecret'            => env('OAUTH_APP_PASSWORD'),
            'redirectUri'             => env('OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_SCOPES')
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

    public function guard()
    {
        return $this->guard ?? null;
    }

    public function logout()
    {
        auth()->user()->logout();

        return response()->json([
            'message' => 'Logout successfuly.',
            'code' => 200,
        ]);
    }

    public function refresh()
    {
        auth()->refresh();
    }

    public function me(Request $request)
    {
        $fields = $request->query('fields') ?? '*';
        $fields = explode(',', $fields);

        $me = auth()->user()->select($fields)->get();

        return response()->json([
            'message' => 'Get user data successfuly.',
            'code' => 200,
            'data' => $me
        ]);
    }

    protected function respondFailedLogin()
    {
        return response()->json([
            'error' => [
                'message' => 'Username or passsword is incorrect.',
                'code' => 401,
            ]
        ], 401);
    }

    protected function respondSuccessLogin($token)
    {
        return response()->json([
            'message' => 'Login successfuly.',
            'code' => 200,
            'access_token' => $token,
            'data' => auth()->user()->get()
        ]);
    }

    protected function respondFailedLoginOutlook()
    {
        return response()->json([
            'error' => [
                'message' => 'An error occured when you try tp login in with Outlook.',
                'code' => 401,
            ]
        ], 401);
    }

    public function callbackOutlook(Request $request)
    {
        // Validate state
        $expectedState = session('oauthState');
        $request->session()->forget('oauthState');
        $providedState = $request->query('state');

        if (!isset($expectedState)) {
            return $this->respondFailedLoginOutlook();
        }

        if (!isset($providedState) || $expectedState != $providedState) {
            return $this->respondFailedLoginOutlook();
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

                if (Teacher::canCreate($user->getUserPrincipalName())) {
                    Teacher::create([
                        'email' =>  $user->getUserPrincipalName(),
                        'fullname' => $user->getDisplayName(),
                    ]);
                }

                $teacher = Teacher::firstWhere('email', $user->getUserPrincipalName());
                $teacher->updateLastLogin();

                $token = auth()->login($teacher);
                
                return $this->respondSuccessLogin($token);

                // redirect to the url of frontend with a query is access token
                // return redirect($url."?access_token={$token->access_token}") 
            } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                return $this->respondFailedLoginOutlook();
            }
        }

        return $this->respondFailedLoginOutlook();
    }

    public function isAuthenticated()
    {
        return response()->json([
            'code' => 200,
            'message' => 'Authenticated.',
        ]);
    }
}
