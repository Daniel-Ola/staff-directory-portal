<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getFileExtension($filename, $filepath) {
        $delimiter = $filename.'.';
        $extension = explode($delimiter, $filepath)[0];
        return $extension;
    }
}
