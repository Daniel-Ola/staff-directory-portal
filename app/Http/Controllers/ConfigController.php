<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Livewire\WithPagination;


class ConfigController extends Controller
{
    use WithPagination;

    public function getFileExtension($filename, $filepath) {
        $delimiter = $filename.'.';
        $extension = explode($delimiter, $filepath)[0];
        return $extension;
    }

    public function searchUser($query)
    {
        return $posts = User::whereRaw(
                "MATCH(firstname, lastname, email) AGAINST(?)", 
                array($query)
        )->get();
                // "MATCH(firstname, lastname, email) AGAINST(? WITH QUERY EXPANSION)", 
    }

    public function searchUserPagination($query, $limit)
    {
        return $posts = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                                ->leftjoin('designations as des', 'designation', 'des.id')
                                ->select('users.*', 'sub.name as subname', 'des.name as desname')
                                ->whereRaw("MATCH(firstname, lastname, email) AGAINST(?)", array($query))
                                ->paginate($limit);
                // "MATCH(firstname, lastname, email) AGAINST(? WITH QUERY EXPANSION)", 
    }

    public function searchUserNoFullTextWithPagination($query, $limit)
    {
        return $users = User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
                                ->leftjoin('designations as des', 'designation', 'des.id')
                                ->select('users.*', 'sub.name as subname', 'des.name as desname')
                                ->where(function($q) use ($query) {
                                    $q->where('firstname', 'LIKE', '%'. $query . '%')
                                        ->orWhere('lastname', 'LIKE', '%'. $query .'%')
                                        ->orWhere('email', 'LIKE', '%'. $query .'%')
                                        ->orWhereRaw("MATCH(firstname, lastname, email) AGAINST(?)", array($query));
                                })->paginate($limit);
    }


}
