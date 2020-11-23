<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

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
        auth()->logout();

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

    public function callback(Request $request)
    {
        // Validate state
    $expectedState = session('oauthState');
    $request->session()->forget('oauthState');
    $providedState = $request->query('state');

    if (!isset($expectedState)) {
      // If there is no expected state in the session,
      // do nothing and redirect to the home page.
    //   return redirect('/');
        dd('1');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
    //   return redirect('/')
    //     ->with('error', 'Invalid auth state')
    //     ->with('errorDetail', 'The provided auth state did not match the expected value');
    dd('2');

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

        // TEMPORARY FOR TESTING!
        // return redirect('/')
        //   ->with('error', 'Access token received')
        //   ->with('errorDetail', $accessToken->getToken());
        dd("Email của bạn là {$user->getUserPrincipalName()}");

      }
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // return redirect('/')
        //   ->with('error', 'Error requesting access token')
        //   ->with('errorDetail', $e->getMessage());
        dd('4');
      }
    }

    // return redirect('/')
    //   ->with('error', $request->query('error'))
    //   ->with('errorDetail', $request->query('error_description'));
    dd('5');
    }
}
