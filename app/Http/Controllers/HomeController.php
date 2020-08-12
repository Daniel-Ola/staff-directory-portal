<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Gufy\PdfToHtml\Pdf;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.home');
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
}
