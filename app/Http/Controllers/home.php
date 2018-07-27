<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class home extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function encode($id) {
        $alphabet='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-.';
        $length = strlen($alphabet);
        $shortlink = '';

        while($id > 0) {
            $shortlink = $shortlink .$alphabet[(int)($id % $length)]  ;
            $id = (int)($id / $length);
        }
        while(strlen($shortlink) < 6) {
            $shortlink = '0' .$shortlink;
        }
        $shortlink = $alphabet[rand(0,63)] . $shortlink;
        echo $shortlink. "<br>";

    }
      
}
