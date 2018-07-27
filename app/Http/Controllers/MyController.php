<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Url;

class MyController extends Controller
{
    public function function1(){
        $url = new Url();
        $url->url_original = 'aaa';
        $url->url_shorten = 'bbb';
        $url->url_info = 'ccc';
        $url->save();
    }
}