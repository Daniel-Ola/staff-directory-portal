<?php

namespace App\Http\Controllers\Magiclogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __constructor() {
        $this->middleware('auth');
    }
    
    public function documentation() {        
        try {
            $userEmail = Auth::user()->email;
            $pass = Str::random(15).time();
            $token = hash('sha256', Hash::make($pass));
            $conn = $this->setDB('cititrust_documentation');
            $conn->table('user_tokens')->insert([
                'email' => $userEmail,
                'token' => $token,
                'portal' => 'documentation'
            ]);
            $signedUrl = URL::temporarySignedRoute(
                'docuwand',
                now()->addMinutes(60), ['harry' => $userEmail, 'potter' => 'documentation', 'wizard' => $token]
            );
            $formedFromSigned = explode('...', $signedUrl);
            if(is_array($formedFromSigned) && count($formedFromSigned) == 2) {
                $redirectTo = $formedFromSigned[1];
                return redirect($redirectTo);
            }
            abort(403);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
    
    public function approval() {        
        try {
            $userEmail = Auth::user()->email;
            $pass = Str::random(15).time();
            $token = hash('sha256', Hash::make($pass));
            $conn = $this->setDB('cititrust_approval');
            $conn->table('user_tokens')->insert([
                'email' => $userEmail,
                'token' => $token,
                'portal' => 'approval'
            ]);
            $signedUrl = URL::temporarySignedRoute(
                'approval.wand', now()->addMinutes(60), ['harry' => $userEmail, 'potter' => 'approval', 'wizard' => $token]
            );
            $formedFromSigned = explode('...', $signedUrl);
            if(is_array($formedFromSigned) && count($formedFromSigned) == 2) {
                $redirectTo = $formedFromSigned[1];
                return redirect($redirectTo);
            }
            abort(403);
        } catch (\Throwable $th) {
            // abort(503);
            throw $th;
        }
        
    }

    public function docuWand(Request $request) {
        return $request;
    }

    // public function Wand(Request $request) {
    //     return $request;
    // }
    
    public function setDB($dbName) {
        Config::set('database.connections.tenant.database', $dbName);
        return DB::connection('tenant');
    }
    
}
