<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Policy;
use App\User;
use Illuminate\Http\Request;
use Gufy\PdfToHtml\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $announcements = Announcement::join('users as u', 'u.id', 'announcements.user_id')
                            ->whereBetween('announcements.created_at', [$week, $now])
                            ->select('firstname', 'lastname', 'announcements.created_at as created_at', 'details', 'subject', 'email', 'announcements.id as id')
                            ->orderBy('created_at', 'DESC')->get();
        return view('pages.home')->with([
            'anns' => $announcements,
            'pols' => $policies,
        ]);
    }

    public function profileView() {
        $sub = Auth::user()->subsidiary;
        $colleagues = User::where('subsidiary', 'LIKE', '%'.$sub.'%')->get();
        return view('pages.profileview')
                ->with('colleagues', $colleagues);
    }

    public function profileEdit() {
        return view('pages.profileedit');
    }

    public function staffView() {
        $allStaff = User::all();
        return view('pages.staffdirectory')
                ->with('staffs', $allStaff);
    }

    public function profileDoEdit(Request $request) {
        $file = $request->file('dp');
        $data = $request->except(['dp', '_token']);
        if($file) {
            $mime = explode('/', $file->getClientMimeType())[1];
            if($mime == 'jpeg') $mime = 'jpg';
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
        $profile = User::find($request->id);
        return $profile;
    }

    public function updateProfile(Request $request) {
        // return $request;
        $id = $request->id;
        $data = $request->except(['id', '_token', 'name']);
        $data = array_merge($data, ['updated_by' => Auth::user()->id]);
        User::find($id)->update($data);
        return User::find($id);
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
        return view('pages.addadmin');
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
}
