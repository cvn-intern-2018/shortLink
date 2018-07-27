<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function ValidLink($url) {

        $regular = '/^(http:\/\/|https:\/\/)?[\w]+(\.{1}[\w]+)+(\S*)$/';

        if (strlen($url) < 2048 && $check = preg_match($regular, $url)){
            return true;
        } else {
            return false;
        }
    }

}
