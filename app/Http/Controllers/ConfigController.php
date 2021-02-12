<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function readCsvFile($file, $rows) {
        $return = array();
        $handle = fopen($file, 'r');
        $init = false;
        $keys = $rows;
        array_pop($keys);
        if ($handle !== FALSE) {
            while(($data = fgetcsv($handle, 10000000, ',')) !== FALSE) {
                $total = count($data);
                if (count($rows) == $total) {
                    if ($init == true) {
                        if (Str::contains($data[$total-1], ['Active', 'active'])) {
                            array_pop($data);
                            $result = array_combine($keys, $data);
                            $return[] = $result;
                        }
                    }
                }
                $init = true;
            }
            fclose($handle);
        }
        return $return;
    }

}
