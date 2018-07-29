<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Url;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function getAllUrl()
    {
        $urls = Url::all();

        $this->debug_to_console($urls);
    }


    public function getURLShortener()
    {
        $url = 'https://github.com/cotdp/php-rc4/blob/master/rc4.php';
        $original_url = Url::where('url_shorten', $url)->get();
        var_dump($original_url);
    }


    public function ValidLink($url)
    {

        $regular = '/^(http:\/\/|https:\/\/)?[\w]+(\.{1}[\w]+)+(\S*)$/';

        if (strlen($url) < 2048 && $check = preg_match($regular, $url)) {
            return true;
        } else {
            return false;
        }
    }

    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

    public function encode($id) {
        $alphabet='abcdefghijlmnopqrstuvwxyzABCDEGHIJKLMNOPQRSTUVWXZ012345789-';
        $addition = 'kY6F';
        $length = strlen($alphabet);
        $shortlink = '';

        while($id > 0) {
            $shortlink = $shortlink .$alphabet[(int)($id % $length)]  ;
            $id = (int)($id / $length);
        }
        while(strlen($shortlink) < 6) {
            $shortlink = $addition[rand(0,strlen($addition)-1)] .$shortlink;
        }
        $shortlink = $alphabet[rand(0,strlen($alphabet)-1)] . $shortlink;
        return  $shortlink;

    }

    public function short(Request $req)
    {
        $old_id = DB::table('url')->max('id');
        $short_url = HomeController::encode($old_id + 1);
       

        $url = new Url();

        $row = Url::where('url_original',$req->org_url)->get();
         

        if(count($row) > 0) {
            return view('home',['data'=>$row]);
        }
        else {
            if(empty($req->custom_url)) {
                $url->url_original = $req->org_url;
                $url->url_shorten =  $short_url;
                $url->url_info = "OK";
            }
            else {
                $url->url_original = $req->org_url;
                $url->url_shorten =  $req->custom_url;
                $url->url_info = "OK";
            }
            $url->save();
            return redirect('data');
        }

    }

    public function returnData()
    {
        $current_id = DB::table('url')->max('id');
        $data = Url::find($current_id);
        return view('home',['data'=>$data]);
    }

    
}
