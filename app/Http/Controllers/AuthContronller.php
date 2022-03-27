<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthContronller extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:api', ['except' => ['login']]);
  }

  public function register(Request $request)
 {
      $this->validate($request, [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
      ]);
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
      ]);
      $token = $user->createToken('AdvanceWeb')->accessToken;
      return response()->json(['token' => $token], 200);
 }


  /**
   * Get a JWT via given credentials.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  /*public function login()
  {
      $credentials = request(['email', 'password']);

      if (!$token = auth()->attempt($credentials)) {
          return response()->json(['error' => 'Unauthorized'], 401);
      }
      return $this->respondWithToken($token);
  }*/

    public function doLogin()
    {
// validate the info, create rules for the inputs
        $rules = array(
          'email'    => 'required|email', // make sure the email is an actual email
          'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

// run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

// if the validator fails, redirect back to the form
        if ($validator->fails()) {
          return Redirect::to('login')
          ->withErrors($validator) // send back all errors to the login form
          ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {

    // create our user data for the authentication
      $userdata = array(
          'email'     => Input::get('email'),
          'password'  => Input::get('password')
        );

    // attempt to do the login
      if (Auth::attempt($userdata)) {

        // validation successful!
        // redirect them to the secure section or whatever
        // return Redirect::to('secure');
        // for now we'll just echo success (even though echoing in a controller is bad)
          echo 'SUCCESS!';

        } else {

        // validation not successful, send back to form
          return Redirect::to('login');

        }

      }
    }

  public function showLogin()
  {
      // show the form
      return View::make('login');
  }

  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function me()
  {
      return response()->json(auth()->user());
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
      auth()->logout();

      return response()->json(['message' => 'Successfully logged out']);
  }

  /**
   * Refresh a token.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function refresh()
  {
      return $this->respondWithToken(auth()->refresh());
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
      return response()->json([
          'access_token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth()->factory()->getTTL() * 60
      ]);
  }
}
