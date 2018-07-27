<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class MyController extends Controller
{
    public function function1(Request $request){
        $ip_address = $request->ip();
        echo '<br>Địa chỉ IP người dùng: ' . $ip_address;
    }
}