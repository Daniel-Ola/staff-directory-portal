<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Department;
use App\Designation;
use App\Policy;
use App\Subsidiary;
use App\User;
use App\Wish;
use Illuminate\Http\Request;
use Gufy\PdfToHtml\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now();
        $week = $now->copy()->subDays(7);
        $policies = Policy::all();
        $day = $now->day;
        $month = $now->month;
        $birthdays = User::where([
            ['day', $day],
            ['month', $month],
            // ['id', '<>', Auth::id()],
        ])->get();
        $userSub = Auth::user()->subsidiary;
        $userDept = Auth::user()->department;
        $announcements = Announcement::join('users as u', 'u.id', 'announcements.user_id')
                            ->whereBetween('announcements.created_at', [$week, $now])
                            ->orWhere(function($subAnn) use($userSub) {
                                $subAnn->where('sub', $userSub)->orWhere('all_of_us', 1);
                            })
                            ->orWhere(function($subDeptAnn) use($userSub, $userDept) {
                                $subDeptAnn->where([
                                        ['sub', $userSub],
                                        ['dept', $userDept]
                                    ])->orWhere('all_of_us', 1);
                            })
                            ->select('firstname', 'lastname', 'announcements.*')
                            ->orderBy('created_at', 'DESC')->get();
        return view('pages.home')->with([
            'anns' => $announcements,
            'pols' => $policies,
            'bdays' => $birthdays,
        ]);
    }

    public function profileView() {
        $dept = Auth::user()->department;

        $colleagues = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.department', $dept],
                            ['users.department', '<>', 0],
                            ['users.id', '<>', Auth::id()]
                        ])
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ;
        $profile = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.id', Auth::id()]
                        ])
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->first() ;
        return view('pages.profileview')
                ->with([
                    'colleagues' => $colleagues,
                    'profile' => $profile,
                ]);
    }

    public function profileEdit() {
        $subs = Subsidiary::all();
        $des = Designation::join('departments as dept', 'dept.id', 'dept_id')->select('designations.*', 'dept.name as deptname')->orderBy('deptname')->get();
        $desigs = [];
        foreach ($des as $de) {
            $deptname = $de->deptname;
            $newItem = ['name' => $de->name, 'id'=> $de->id];
            if(!array_key_exists($deptname, $desigs)) {
                $desigs[$deptname] = [];// $newItem;
            }
            array_push($desigs[$deptname], $newItem);
        }
        
        $depts = Department::all();        
        $profile = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.id', Auth::id()]
                        ])
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->first() ;
        $auth = Auth::user();
        $errmsg = '';
        if($auth->profile == 0) {
            $errmsg = 'Update your profile to complete registration. <br>Please note that some details can only be edited once';
        } else if($auth->dp == 'assets/media/avatars/avatar15.jpg') {
            $errmsg = 'Please update your profile picture';
        }
        Session::flash('profileErr', $errmsg);
        return view('pages.profileedit')->with([
            'subs' => $subs,
            'desigs' => $desigs,
            'profile' => $profile,
            'depts' => $depts
        ]);
    }

    public function staffView() {
        $allStaff = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ; //User::all();
        $subs = Subsidiary::all();
        $desigs = Designation::all();
        return view('pages.staffdirectory')
                ->with([
                    'staffs' => $allStaff,
                    'subs' => $subs,
                    'desigs' => $desigs,
                ]);
    }

    public function profileDoEdit(Request $request) {
        // return $_FILES;
        $file = $request->file('dp');
        $data = $request->except(['dp', '_token']);
        if($file) {
            $validate = $request->validate([
                'dp' => 'file|max:2000'
            ], [
                'dp.uploaded' => 'Maximum file size for DP is 2mb',
                'dp.max' => 'Maximum file size for DP is 2mb'
            ]);
            // return $validate->errors();
            $mime = explode('/', $file->getClientMimeType())[1];
            if($mime == 'jpeg' || $mime == 'octet-stream') $mime = 'jpg';
            $path = 'assets/media/users/';
            $fileName = $request->firstname.''.$request->lastname.''.time().'.'.$mime;
            $file->move($path, $fileName);
            $dp = $path.$fileName;
        } else {
            $dp = Auth::user()->dp;
        }
        $data = array_merge($data, ['dp' => $dp]);
        $updateDetails = User::where('id', Auth::id())->update($data);
        return back();
    }

    public function getProfile(Request $request) {
        // return $request;
        $profile = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where('users.id', $request->id)
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ; //User::all();
        return $profile;
    }

    public function updateProfile(Request $request) {
        $id = $request->id;
        $data = $request->except(['id', '_token', 'name', 'action']);
        $data = array_merge($data, ['updated_by' => Auth::id()]);
        User::find($id)->update($data);
        return back()->with('status', [
            'type' => 'info', 
            'message' => 'User profile updated successfully'
        ]);
        // return User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
        //                 ->leftjoin('designations as des', 'designation', 'des.id')
        //                 ->where('users.id', $id)
        //                 ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ; //User::all();
        // return User::find($id);
    }

    public function deleteProfile(Request $request) {
        $id = $request->id;
        User::find($id)->delete();
        return back()->with('status', [
            'type' => 'info', 
            'message' => 'User profile deleted successfully'
        ]);
    }

    public function pdfhtml() {
        // return view('pages.pdf');
        $file = 'http://localhost:8000/assets/book/User_Download_21072020_222331.pdf';
        $pdf = new Pdf($file);
        return $pdf->html();
    }

    public function staffAdd() {
        return view('pages.createuser');
    }

    public function staffCreate(Request $request) {
        $data = $request->emails;
        DB::beginTransaction();
        try {
            $emails = explode(',', $data);
            foreach ($emails as $email) {
                User::create([
                    'email' => trim($email),
                    'updated_by' => Auth::id(),
                    ]);
            }
            DB::commit();
            return back()->with('status', count($emails).' emails added to users');
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            return back()->with('status', 'New users could not be created');
        }
    }

    public function adminAdd() {
        $emails = User::select('email')->get();
        return view('pages.addadmin')->with('emails', $emails);
    }

    public function adminCreate(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'access' => 'required|numeric'
        ]);
        try {
            User::where('email', $request->email)->update([
                'access' => $request->access,
                'updated_by' => Auth::id()
            ]);
            return back()->with('status', 'Role assigned successfully');
        } catch (Exception $e) {
            return $e;
            return back()->with('status', 'Role could not be assigned');
        }
    }

    public function adminManage() {
        $supers = User::where('access', '1')->get();
        $admins = User::where('access', '2')->get();
        return view('pages.adminmanage')->with([
            'admins' => $admins,
            'supers' => $supers,
        ]);
    }

    public function adminRemove(Request $request)
    {
        $user = $request->id;
        try {
            $data = [
                'access' => '0',
                'updated_by' => Auth::id()
            ];
            User::find($user)->update($data);
            return back()->with('status', 'Admin has been removed successfully');
        } catch (Exception $e) {
            return back()->with('status', 'Announcement could not be removed');
        }
    }

    public function policy() {
        $pols = Policy::all();
        return view('pages.policy')->with('pols', $pols);
    }

    public function policyAdd(Request $request) {
        $data = $request->except('_token');
        $request->validate([
            'title' => 'required|string',
            'file' => 'required|mimes:pdf'
        ]);

        $file = $request->file('file');
        try {
            $filename = $file->getClientOriginalName();
            $saveTo = 'assets/media/citi_assets/policies/';
            $path = $saveTo.$filename;
            if(file_exists($path)){ 
                unlink($path);
            }
            $file->move($saveTo, $filename);
            Policy::create([
                'title' => $request->title,
                'path' => $path
            ]);
            return back()->with('status', 'Policy uploaded successfully');
        } catch (Exception $e) {
            return $e;
            return back()->with('status', 'Policy not uploaded successfully');
        }
    }

    public function policyDel(Request $request) {
        try {
            $pol = Policy::find($request->id);
            $path = $pol->path;
            File::delete($path);
            // unlink($path);
            $delete = $pol->delete();
            return back()->with('status', 'Policy has been deleted successfully');
        } catch (Exception $e) {
            return back()->with('status', 'Policy could not be deleted');
        }
    }

    public function subDesig() {
        $subs = Subsidiary::orderBy('name')->get();
        $desigs = Designation::orderBy('dept_id')->get();
        $depts = Department::orderBy('name')->get();
        $grouped = \App\SubsidiaryGroupMember::pluck('sub_id');
        $free = Subsidiary::whereNotIn('id', $grouped)->get(['id', 'name']);
        $groups = \App\SubsidiaryGroup::orderBy('name')->get();
        return view('pages.subdeg')->with([
            'subs' => $subs,
            'desigs' => $desigs,
            'depts' => $depts,
            'free' => $free,
            'groups' => $groups,
            'roles' => \App\GroupHeadRole::all()
        ]);
    }

    public function saveSubDesig(Request $request) {
        // return $request;
        // creates a folder for the file system while creating this
        $type = $request->type;
        $name = $request->only('name');
        if($type == 1) {
            $save = $request->except(['_token', 'type']);
            Designation::create($save);
        } else if($type == 0) {
            $names = explode(',', $request->name);
            foreach($names as $name) {
                Subsidiary::create(['name' => trim($name)]);
            }
        } else if($type == 2) {
            $names = explode(',', $request->name);
            foreach($names as $name) {
                Department::create(['name' => trim($name)]);
            }
        }
        return back()->with('status', 'Item(s) Added Successfully');
    }

    public function editSubDesig(Request $request) {
        // return $request;
        $type = $request->type;
        $name = $request->only('name');
        $id = $request->id;
        $action = $request->action;
        if($type == 1) {
            $save = $request->except(['_token', 'type']);
            if($action == 'delete') {
                Designation::find($id)->delete();
            } else {
                Designation::find($id)->update($save);
            }
        } else if($type == 0) {
            if($action == 'delete') {
                Subsidiary::find($id)->delete();
            } else {
                Subsidiary::find($id)->update($name);
            }
        } else if($type == 2) {
            if($action == 'delete') {
                Department::find($id)->delete();
            } else {
                Department::find($id)->update($name);
            }
        }
        return back()->with('status', 'Item Updated Successfully');
    }

    public function createSubsidiaryubGroup(Request $request)
    {
        DB::beginTransaction();
        try {
            $group = \App\SubsidiaryGroup::create($request->only('name'));
            foreach ($request->sub_id as $sub_id) {
                \App\SubsidiaryGroupMember::create([
                    'sub_id' => $sub_id,
                    'group_id' => $group->id
                ]);
            }
            DB::commit();
            return back()->with('status', 'Group created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return back()->with('status', 'Group could not be created');
        }
        return $request;
    }

    public function assignGroupRole(Request $request)
    {
        $check = \App\GroupHead::where([
            ['user_id', $request->user_id],
            ['group_id', $request->group_id],
            ['role_id', $request->role_id]
        ])->exists();
        if( ! $check)
        {
            \App\GroupHead::create($request->except('_token'));
        }
        return back()->with('status', 'Role assigned successfully');
    }

    public function showWishes() {
        $wishes = Wish::orderBy('created_at', 'DESC')->get();
        return view('pages.wishes')->with([
            'wishes' => $wishes,
        ]);
    }

    public function makeWish(Request $request) {
        $data = $request->except('_token');
        try {
            Wish::create($data);
            return back()->with('status', 'Wish saved successfully');
        } catch (\Throwable $th) {
            return back()->with('status', 'Your wish could not be saved');
            throw $th;
        }
    }

    public function removeWish(Request $request) {
        try {
            Wish::find($request->id)->delete();
            return back()->with('status', 'Wish was deleted successfully');
        } catch (\Throwable $th) {
            throw $th;
            return back()->with('status', 'Wish could not be deleted');
        }
    }
}
