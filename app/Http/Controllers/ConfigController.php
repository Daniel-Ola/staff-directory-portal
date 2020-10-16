<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
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
}
