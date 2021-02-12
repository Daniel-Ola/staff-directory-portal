<?php


if(! function_exists('make_case_insensitive_array')) {
    function make_case_insensitive_array($array) {
        $array = array_map('trim', $array);
        $array = array_unique($array, SORT_REGULAR);
        return array_map('strtolower', $array);
    }
}



