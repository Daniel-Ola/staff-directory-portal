<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FilemanagerController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $userFolder = 'filemanager/'.Auth::user()->email;
        if(!file_exists($userFolder)) {
            try {
                mkdir($userFolder);
            } catch (\Throwable $th) {
                throw $th;
                return;
            }
        }
        $folder = Folder::where([
            ['parent', 0],
            ['user_id', Auth::user()->id]
        ])->get();
        $files = File::where([
            ['folder_id', 0],
            ['user_id', Auth::user()->id]
        ])->get();
        $allfolders = Folder::where('user_id', Auth::user()->id)->get();
        return view('pages.filemanager')->with([
            'folders' => $folder,
            'files' => $files,
            'allfolders' => $allfolders,
        ]);
    }

    function createFolder(Request $request) {
        $userRootFolder = 'filemanager/'.Auth::user()->email;
        $data = $request->except('_token');
        $validate = Validator::make($data, [
            'name' => 'required|string|not_in:No Parent',
            'parent' => 'required|numeric',
        ]);
        if($validate->fails()) {
            return back()->with([
                'status' => 'warning',
                'message' => 'Invalid entry',
            ]);
        }
        try {
            // 
            if($request->parent == 0) {
                $createPath = $userRootFolder.'/'.$request->name;
                $path = Auth::user()->email.'/'.$request->name;
                if(file_exists($createPath)) {
                    return back()->with([
                        'status' => 'warning',
                        'message' => 'Folder already exist',
                    ]);
                }
                mkdir($createPath);
            } else {
                $parentPath = Folder::find($request->parent)->path;
                $path = $parentPath.'/'.$request->name;
                // return $parentPath;
                if(file_exists('filemanager/'.$parentPath)) {
                    if(file_exists('filemanager/'.$path)) {
                        return back()->with([
                            'status' => 'warning',
                            'message' => 'Folder already exist',
                        ]);
                    }
                    mkdir('filemanager/'.$path);
                } else {
                    return back()->with([
                        'status' => 'warning',
                        'message' => 'Parent folder cannot be found',
                    ]);
                }
            }
            // 
            Folder::create([
                'parent' => $request->parent,
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'slug' => rand(999, 9999).time().Auth::user()->id.'-'.Auth::user()->email,
                'path' => $path,
            ]);
            return back()->with([
                    'status' => 'success',
                    'message' => 'Folder created successfully',
                ]);
        } catch (Exception $e) {
            throw $e;
            return back()->with([
                'status' => 'warning',
                'message' => 'Folder not created successfully',
            ]);;
        }
        return $request;
    }

    function getFolder($slug) {
        try {

            $parent = Folder::where('slug', $slug)->select('id')->get();
            if(count($parent) == 0) { abort(404); }
            $pid = $parent[0]->id;
            $folder = Folder::where([
                ['parent', $pid],
                ['user_id', Auth::user()->id]
            ])->get();
            $files = File::where([
                ['folder_id', $pid],
                ['user_id', Auth::user()->id]
            ])->get();
            $allfolders = Folder::where('user_id', Auth::user()->id)->get();
            return view('pages.filemanager')->with([
                'folders' => $folder,
                'files' => $files,
                'allfolders' => $allfolders,
            ]);
            
        } catch (\Throwable $th) {
            throw $th;
            abort(404);
        }
    }

    function gobackfolder(Request $request) {
        $slug = $request->slug;
        $parent = Folder::where('slug', $slug)->get()[0]->parent;
        if($parent != 0) {
            $back = Folder::find($parent)->slug;
            // return $back;
            return redirect('myfolder/'.$back);
        } else {
            return redirect('filemanagement');
        }
    }

    function createFile(Request $request) {
        $pid = $request->parent;
        $root = 'filemanager/'.Auth::user()->email;
        $saveTo = $root.'/';
        if($pid != 0) {
            try {
                $folder = Folder::find($pid)->path;
                $saveTo = 'filemanager/'.$folder.'/';
            } catch (\Throwable $th) {
                throw $th;
                return back()->with([
                    'status' => 'warning',
                    'message' => 'Could not initialize file into folder',
                ]);
            }
        }

        $files = $request->file('file');
        try {
            foreach ($files as $file) {
                $fileDet = $file->getClientOriginalName();
                $fileName = pathinfo($fileDet,PATHINFO_FILENAME);
                $fileExt = pathinfo($fileDet,PATHINFO_EXTENSION );
                $fileDet = $fileName.'-'.time().Auth::user()->id.rand(999,9999).'.'.$fileExt;
                $file->move($saveTo, $fileDet);
                $data = [
                    'name' => $fileName,
                    'folder_id' => $pid,
                    'user_id' => Auth::user()->id,
                    'path' => $saveTo.$fileDet,
                ];
                File::create($data);
            }
            return back()->with([
                'status' => 'success',
                'message' => 'File upload was successful'
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return back()->with([
                'status' => 'success',
                'message' => 'File upload was not successful'
            ]);
        }
    }   

    function download(Request $request) {
        // add bulk download later
        if($request->owner == Auth::user()->id) {
            try {
                $fileloc = public_path().'/'.$request->file;
                return response()->download($fileloc);
            } catch (\Throwable $th) {
                return $th;
                return back()->with([
                    'status' => 'warning',
                    'message' => 'File download not successful'
                ]);
            }
        }

        return back()->with([
            'status' => 'warning',
            'message' => 'You dont have access to this file'
        ]);
    
    }

    function delete(Request $request) {
        // add bulk download later
        if($request->owner == Auth::user()->id) {
            try {
                File::find($request->file_id)->delete();
                return back()->with([
                    'status' => 'success',
                    'message' => 'File deleted successfully'
                ]);
            } catch (\Throwable $th) {
                return $th;
                return back()->with([
                    'status' => 'warning',
                    'message' => 'File could not be deleted'
                ]);
            }
        }

        return back()->with([
            'status' => 'warning',
            'message' => 'You dont have access to this file'
        ]);
    }

    function folderDelete(Request $request) {
        // add bulk download later
        if($request->owner == Auth::user()->id) {
            try {
                Folder::destroy($request->folder_id);
                return back()->with([
                    'status' => 'success',
                    'message' => 'File deleted successfully'
                ]);
            } catch (\Throwable $th) {
                return $th;
                return back()->with([
                    'status' => 'warning',
                    'message' => 'File could not be deleted'
                ]);
            }
        }

        return back()->with([
            'status' => 'warning',
            'message' => 'You dont have access to this file'
        ]);
    }

}
