<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Url;
use DB;

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
        return  $shortlink;

    }
    
    public function short(Request $req)
    {
        $old_id = DB::table('url')->max('id');

        $domain = "http://cus.dev.cybozu.xyz/";
        $short = home::encode($old_id + 1);
        $short_url = $domain . $short;

        $url = new Url();

        $url->url_original = $req->org_url;
        $url->url_shorten =  $short_url;
        $url->url_info = "OK";
        $url->save();

        return redirect('home');
    }
}
