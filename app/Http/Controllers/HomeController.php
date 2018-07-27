<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Url;

class HomeController extends Controller
{
    public function index1()
    {
//        $url = url::table('url')->get();

        $url = Url::all();

        $this->debug_to_console( $url );

        return view('home',['url' => 12314]);
    }
    public function getAllUrl()
    {
        $urls = Url::all();

        $this->debug_to_console( $urls );
    }
    public function index()
    {
        $url = 'https://github.com/cotdp/php-rc4/blob/master/rc4.php';
        $original_url = Url::where('url_original',$url)->get()->toJson();//or toArray or
        var_dump($original_url);
    }
    public function getURLShortener()
    {
        $url = 'https://github.com/cotdp/php-rc4/blob/master/rc4.php';
        $original_url = Url::where('url_shorten',$url)->get();
        var_dump($original_url);
    }
    public function addURLShortener(){

    }



    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);

        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
}
