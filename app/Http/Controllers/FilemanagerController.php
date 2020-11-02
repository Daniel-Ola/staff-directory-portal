<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as Filemanager;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
                return back();
                throw $th;
                return;
            }
        }
        $folder = Folder::where([
            ['parent', 0],
            ['scope', 'private'],
            ['user_id', Auth::user()->id]
        ])->get();
        $files = File::where([
            ['folder_id', 0],
            ['user_id', Auth::user()->id]
        ])->get();
        $createdGroups = \App\Group::where('created_by', Auth::user()->id)->get();
        $allfolders = Folder::where('user_id', Auth::user()->id)->get();
        return view('pages.filemanager')->with([
            'folders' => $folder,
            'files' => $files,
            'allfolders' => $allfolders,
            'createdGroups' => $createdGroups
        ]);
    }

    function createFolder(Request $request) {
        // return $request;
        $prev = \URL::previous();
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
                // return 'root';
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
                // return 'notroot';
                $parent = Folder::find($request->parent);
                $path = $parent->path.'/'.$request->name;
                // return $parent->path;
                // create folder in directory
                if(file_exists('filemanager/'.$parent->path)) {
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

                // moved here
                
            }
            // was here
                if(strpos($prev, 'filemanagement')) { $scope = 'private'; }
                else { $scope = 'dept'; }//'$parent->scope';
            // create folder in db
            // return $scope;
            if($scope != 'private')
            {
                Folder::create([
                    'parent' => $request->parent,
                    'name' => $request->name,
                    'user_id' => Auth::user()->id,
                    'slug' => Str::uuid().'-'.time().'-'.Str::slug($request->name),
                    'path' => $path,
                    'scope' => $parent->scope,
                    'dept' => $parent->dept,
                    'sub' => $parent->sub
                ]);
            } else {
                Folder::create([
                    'parent' => $request->parent,
                    'name' => $request->name,
                    'user_id' => Auth::user()->id,
                    'slug' => Str::uuid().'-'.time().'-'.Auth::user()->email,
                    'path' => $path,
                    'scope' => $scope
                ]);
            }
            
            return back()->with([
                    'status' => 'success',
                    'message' => 'Folder created successfully',
                ]);
        } catch (Exception $e) {
            throw $e->getMessage();
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
            $createdGroups = \App\Group::where('created_by', Auth::user()->id)->get();
            $allfolders = Folder::where('user_id', Auth::user()->id)->get();
            return view('pages.filemanager')->with([
                'folders' => $folder,
                'files' => $files,
                'allfolders' => $allfolders,
                'createdGroups' => $createdGroups
            ]);
            
        } catch (\Throwable $th) {
            throw $th;
            abort(404);
        }
    }

    function gobackfolder(Request $request) {
        // return $request;
        $slug = $request->slug;
        $parent = Folder::where('slug', $slug)->get()[0]->parent;
        if($parent != 0) {
            $back = Folder::find($parent)->slug;
            return redirect('myfolder/'.$back);
        } else {
            return redirect('filemanagement');
        }
    }

    function createFile(Request $request) {
        // return $request;
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
                $fileDet = $fileName.'-'.Str::uuid().Auth::user()->id.rand(999,9999).'.'.$fileExt;
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

    public function publicFolders($slug = null)
    {
        $headings = \App\GroupHead::where('user_id', Auth::user()->id)->pluck('group_id')->toArray();
        $subs = [intval(Auth::user()->subsidiary), 2];
        $Subsidiaryfolders = []; //initializes and changes is isAnyGroupHead 
        $subs = array_merge($subs, $headings);
        $subs = array_unique($subs, SORT_NUMERIC);
        $isAnyGroupHead = Gate::allows('grouphead');
        $createdGroups = \App\Group::where('created_by', Auth::user()->id)->get();
        if($slug)
        {
            $data = $this->subPublicFolder($slug, $isAnyGroupHead, $headings, $subs);
        } else {
            $data = $this->rootPublicFolder($isAnyGroupHead, $headings, $subs);
        }
        $data = array_merge($data, ['createdGroups' => $createdGroups]);
        return view('pages.publicfilemanager')->with($data);
    }

    public function rootPublicFolder($isAnyGroupHead, $headings, $subs)
    {
        $this->createPublicFolders();
        $folders = Folder::where([
            ['parent', 0],
            ['sub', Auth::user()->subsidiary],
            ['dept', Auth::user()->department],
        ])
        ->where(function($query) {
            $query->where('scope', 'dept');
        })->get();

        if($isAnyGroupHead) {
            // join('subsidiaries as s', 's.id', 'folders.sub')->
            $Subsidiaryfolders = Folder::where('parent', 0)->whereIn('sub', $subs)
            ->where(function($SubFoldquery) {
                $SubFoldquery->where('scope', 'sub');
            })->get();
            // ['folders.*', 's.name']
        } else {
            $Subsidiaryfolders = [];
        }

        $allfolders = Folder::where('user_id', Auth::user()->id)->get();
        return [
            'folders' => $folders,
            'files' => [],
            'allfolders' => $folders,
            'Subsidiaryfolders' => $Subsidiaryfolders,
            'parentSub' => Auth::user()->subsidiary
        ];
    }

    public function subPublicFolder($slug, $isAnyGroupHead, $headings, $subs)
    {
        $userSub = Auth::user()->subsidiary;
        $userDept = Auth::user()->department;
        try {
            $parent = Folder::where('slug', $slug);//->first();//->select('id')->get();
            if(!$parent->exists()) abort(404, '404');
            $parent = $parent->first();
            $scope = $parent->scope; // defines the scope of the selected folder, whether departmental of subsidiary based
            if($scope == 'sub')
            {
                if( ! in_array($parent->sub, $subs)) abort(403, '403');
            } elseif ($scope = 'dept') {
                if($isAnyGroupHead) {
                    if(! in_array($parent->sub, $subs)) abort(403, '403');
                } else {
                    if($parent->sub != $userSub &&
                        $parent->dept != $userDept) abort(403, '403');
                }
            }
            $pid = $parent->id;
            $folders = Folder::where([
                ['parent', $pid]
            ])->get();
            $files = File::where([
                ['folder_id', $pid],
            ])->get();
            $allfolders = Folder::where('scope', $scope)->get();
            return [
                'folders' => $folders,
                'files' => $files,
                'allfolders' => $allfolders,
                'Subsidiaryfolders' => [],
                'parentSub' => $parent->sub
            ];
            
        } catch (\Throwable $th) {
            if(is_numeric($th->getMessage()))
            {
                $code = $th->getMessage();
                abort($code);
            } else {
                abort(500);
            }
        }
    }


    function createPublicFolders()
    {
        DB::beginTransaction();
        try {
            $dept = \App\Department::find(Auth::user()->department);
            $sub = \App\Subsidiary::find(Auth::user()->subsidiary);
            $subName = $sub->name;
            $deptName = $dept->name;

            $subFolder = "_Public/{$sub->name}";
            $deptFolder = $subFolder."/{$deptName}";
            $path = 'filemanager/'.$deptFolder;

            if(file_exists($path)) return;

            $subsidiary = Folder::create([
                'name' => $subName,
                'user_id' => Auth::user()->id,
                'slug' => Str::uuid().'-'.time().'-'.Str::slug($subName),
                'path' => $subFolder,
                'scope' => 'sub',
                'dept' => $dept->id,
                'sub' => $sub->id
            ]);
            

            $subsidiary = Folder::create([
                'name' => $deptName,
                'user_id' => Auth::user()->id,
                'slug' => Str::uuid().'-'.time().'-'.Str::slug($deptName),
                'path' => $deptFolder,
                'scope' => 'dept',
                'dept' => $dept->id,
                'sub' => $sub->id
            ]);
            Filemanager::makeDirectory($path, 0755, true, false);
            DB::commit();
            return;
        } catch (\Throwable $th) {
            DB::rollBack();
            Filemanager::deleteDirectory($path);
            return back()->with([
                'status' => 'warning',
                'message' => 'Public Folder could not be created'
            ]);
            throw $th;
        }
    }

    public function sharedFolders($slug = null)
    {
        if($slug)
        {
            $data = $this->subSharedDocs($slug);
        } else {
            $data = $this->rootSharedDocs();
        }
        return view('pages.sharedfilemanager')->with($data);

        
    }

    public function subSharedDocs($slug)
    {
        try {
            $folder = Folder::where('slug', $slug);
            if(!$folder->exists()) abort(404);
            $folder = $folder->first();
            $folderId = $folder->id;
            $userid = Auth::user()->id;
            $myGroups = \App\GroupMember::join('groups as g', 'g.id', 'group_members.group_id')->where('user_id', $userid)->select('g.*');
            $groupIds = $myGroups->pluck('id');
            $shared = \App\FileShare::join('folders as fold', 'fold.id', 'file_shares.item_id')->where([
                ['shared_with', $userid],
                ['shared_type', 'single'],
                ['type', 'folders'],
                ['item_id', $folderId]
            ])->orWhere(function($query) use($groupIds, $folderId) {
                $query->where('shared_type', 'group')->where('type', 'folders')->where('item_id', $folderId)->whereIn('shared_with', $groupIds);
            });

            if(!$shared->exists()) abort(403);

            $folder = Folder::where([
                ['parent', $folderId]
            ])->get();
            $files = File::where([
                ['folder_id', $folderId],
            ])->get();
            $allfolders = $folder;
            return [
                'folders' => $folder,
                'files' => $files,
                'allfolders' => $allfolders,
                'sharedDocs' => []
            ];
            
        } catch (\Throwable $th) {
            abort(404);
            throw $th;
        }
    }

    public function rootSharedDocs()
    {
        $userid = Auth::user()->id;
        $myGroups = \App\GroupMember::join('groups as g', 'g.id', 'group_members.group_id')->where('user_id', $userid)->select('g.*');
        $groupIds = $myGroups->pluck('id');
        $sharedDocs = \App\FileShare::join('folders as fold', 'fold.id', 'file_shares.item_id')->where([
                        ['shared_with', $userid],
                        ['shared_type', 'single'],
                        ['type', 'folders']
                    ])->orWhere(function($query) use($groupIds) {
                        $query->where('shared_type', 'group')->where('type', 'folders')->whereIn('shared_with', $groupIds);
                    })->get();
        return [
            'folders' => [],
            'files' => [],
            'allfolders' => [],
            'groups' => $myGroups,
            'sharedDocs' => $sharedDocs
        ];
    }

    public function shareFolder(Request $request)
    {
        if($request->shared_type == 'single')
        {
            if($user = \App\User::where('email', $request->shared_with)->first())
            {
                $data = $request->except(['_token']);
                $data['shared_with'] = $user->id;
                $saved = \App\FileShare::create($data);
            } else {
                return back()->with([
                    'status' => 'warning',
                    'message' => 'Folder shared successfully',
                    'notify' => true
                ]);
            }
        } else {
            $saved = \App\FileShare::create($request->except('_token'));
        }
        return back()->with([
                'status' => 'info',
                'message' => 'Folder shared successfully',
                'notify' => true
            ]);
    }

}
