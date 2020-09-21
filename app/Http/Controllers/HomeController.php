<?php

namespace App\Http\Controllers;

use App\Announcement;
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
            // ['id', '<>', Auth::user()->id],
        ])->get();
        // if($birthdays->count() != 0) {
        //     $wishes = some random selection;
        // }
        $announcements = Announcement::join('users as u', 'u.id', 'announcements.user_id')
                            ->whereBetween('announcements.created_at', [$week, $now])
                            ->select('firstname', 'lastname', 'announcements.created_at as created_at', 'details', 'subject', 'email', 'announcements.id as id')
                            ->orderBy('created_at', 'DESC')->get();
        return view('pages.home')->with([
            'anns' => $announcements,
            'pols' => $policies,
            'bdays' => $birthdays,
        ]);
    }

    public function profileView() {
        $sub = Auth::user()->designation;

        $colleagues = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.subsidiary', $sub],
                            ['users.subsidiary', '<>', 0],
                            ['users.id', '<>', Auth::user()->id]
                        ])
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ;
        $profile = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.id', Auth::user()->id]
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
        $desigs = Designation::all();
        $profile = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where([
                            ['users.id', Auth::user()->id]
                        ])
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->first() ;
        $auth = Auth::user();
        $errmsg = '';
        if($auth->profile == 0) {
            $errmsg = 'Please update your profile';
        } else if($auth->dp == 'assets/media/avatars/avatar15.jpg') {
            $errmsg = 'Please update your profile picture';
        }
        Session::flash('profileErr', $errmsg);
        return view('pages.profileedit')->with([
            'subs' => $subs,
            'desigs' => $desigs,
            'profile' => $profile,
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
            $fileName = $request->firstname.'_'.$request->lastname.'_'.time().'.'.$mime;
            $file->move($path, $fileName);
            $dp = $path.$fileName;
        } else {
            $dp = Auth::user()->dp;
        }
        $data = array_merge($data, ['dp' => $dp]);
        $updateDetails = User::where('id', Auth::user()->id)->update($data);
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
        // return $request;
        $id = $request->id;
        $data = $request->except(['id', '_token', 'name']);
        $data = array_merge($data, ['updated_by' => Auth::user()->id]);
        User::find($id)->update($data);
        return User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                        ->leftjoin('designations as des', 'designation', 'des.id')
                        ->where('users.id', $id)
                        ->select('users.*', 'sub.name as subname', 'des.name as desname')->get() ; //User::all();
        // return User::find($id);
    }

    public function deleteProfile(Request $request) {
        $id = $request->id;
        User::find($id)->delete();
        return true;
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
                    'updated_by' => Auth::user()->id,
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
                'updated_by' => Auth::user()->id
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
                'updated_by' => Auth::user()->id
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
            unlink($path);
            $delete = $pol->delete();
            return back()->with('status', 'Policy has been deleted successfully');
        } catch (Exception $e) {
            return back()->with('status', 'Policy could not be deleted');
        }
    }

    public function subDesig() {
        $subs = Subsidiary::all();
        $desigs = Designation::all();
        return view('pages.subdeg')->with([
            'subs' => $subs,
            'desigs' => $desigs
        ]);
    }

    public function saveSubDesig(Request $request) {
        // return $request;
        $type = $request->type;
        $name = $request->only('name');
        if($type == 1) {
            Designation::create($name);
        } else if($type == 0) {
            Subsidiary::create($name);
        }
        return back()->with('status', 'Item Added Successfully');
    }

    public function editSubDesig(Request $request) {
        $type = $request->type;
        $name = $request->only('name');
        $id = $request->id;
        if($type == 1) {
            Designation::find($id)->update($name);
        } else if($type == 0) {
            Subsidiary::find($id)->update($name);
        }
        return back()->with('status', 'Item Updated Successfully');
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
