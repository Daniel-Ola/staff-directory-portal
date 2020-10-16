<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConfigController as Config;
use App\Software;
use App\UserSoftware;

class UserController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function assignSoftwares() 
    {
        return view('pages.usersoftwares');
    }

    public function doAssignSoftwares(Request $request)
    {
        UserSoftware::where('user_id', $request->user_id)->delete();
        if($softs = $request->software_id)
        {
            foreach ($softs as $i => $soft)
            {
                UserSoftware::create([
                    'user_id' => $request->user_id,
                    'software_id' => $softs[$i],
                    'attribute' => 'can',
                    'set_by' => Auth::user()->id
                ]);
            }
        }
        
        return back();
    }
}
