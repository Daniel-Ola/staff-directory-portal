<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConfigController as Conf;
use App\Software;
use App\UserSoftware;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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

    public function showPriviledges()
    {
        return view('pages.setpriviledges');
    }

    public function setPriviledges(Request $request)
    {
        try {
            $conn = $this->getDb($request->software);
            $conn->beginTransaction();
            $table = $conn->table('module_permissions');
            $table->insert([
                $request->except(['_token', 'software'])
            ]);
            $table->where('user_id', $request->user_id)->update([
                'user_type' => $request->user_type
            ]);
            $conn->commit();
            return back()->with('status', 'Task Completed');
        } catch (\Throwable $th) {
            $conn->rollBack();
            return back()->with('status', 'Could not complete task');
            // throw $th;
        }
        return $request;
    }

    public function getDb($software)
    {
        $soft = strtolower($software);
        $dbName = config('portals.'.$soft.'.database');
        Config::set('database.connections.tenant.database', $dbName);
        return DB::connection('tenant');
    }

    public function createGroup(Request $request)
    {
        DB::beginTransaction();
        $data = array_merge($request->only(['name', 'type']), ['created_by' => Auth::user()->id]);
        $createdGroup = \App\Group::create($data);
        try {
            $members = $request->user_id;
            foreach ($members as $i => $member) {
                $toSave = ['user_id' => $member, 'group_id' => $createdGroup->id];
                \App\GroupMember::create($toSave);
            }
            DB::commit();
            return back()->with([
                'status' => 'success',
                'message' => 'User group created successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return back()->with([
                'status' => 'warning',
                'message' => 'User group could not be created'
            ]);
        }
    }
}
