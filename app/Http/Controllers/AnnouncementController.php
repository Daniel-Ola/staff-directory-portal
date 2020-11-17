<?php

namespace App\Http\Controllers;

use App\Announcement;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->access == '1') {
            $announcements = Announcement::join('users as u', 'u.id', 'announcements.user_id')
                            ->select('firstname', 'lastname', 'announcements.created_at as created_at', 'details', 'subject', 'email', 'announcements.id as id')
                            ->orderBy('created_at', 'DESC')->get();
        } else {
            $announcements = Announcement::join('users as u', 'u.id', 'announcements.user_id')
                                ->where('u.id', Auth::user()->id)
                                ->select('firstname', 'lastname', 'announcements.created_at as created_at', 'details', 'subject', 'email', 'announcements.id as id')
                                ->orderBy('created_at', 'DESC')->get();
        }
        return view('pages.manageann')->with([
            'anns' => $announcements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createann', [
            'subs' => \App\Subsidiary::all(),
            'depts' => \App\Department::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = array_merge($request->except('_token'), ['user_id' => Auth::id()]);
            Announcement::create($data);
            return back()->with('status', 'Announcement has been sent');
        } catch (Exception $e) {
            // return $e->getMessage();
            return back()->with('status', 'Announcement could not be created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Announcement::find($request->id)->delete();
            return back()->with('status', 'Announcement has been deleted successfully');
        } catch (Exception $e) {
            return back()->with('status', 'Announcement could not be deleted');
        }
    }
}
