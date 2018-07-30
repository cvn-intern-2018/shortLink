<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Url;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
   
    public function index()
    {
        return view('home');
    }

    public function getURLShortener()
    {
        $url = 'https://github.com/cotdp/php-rc4/blob/master/rc4.php';
        $original_url = Url::where('url_shorten', $url)->get();
        var_dump($original_url);
    }


    public function validateLink($url)
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
        $alphabet = 'abcdefghilmnopqrstuvwxyzABCDEGHIJKLMNOPQRSTUVWXZ012345789-';
        $addition = 'kjY6F';
        $length = strlen($alphabet);
        $shortlink = '';

        while($id > 0) {
            $shortlink = $shortlink . $alphabet[(int)($id % $length)]  ;
            $id = (int)($id / $length);
        }
        while(strlen($shortlink) < 6) {
            $shortlink = $addition[rand(0, strlen($addition) - 1)] . $shortlink;
        }
        $shortlink = $alphabet[rand(0, strlen($alphabet) - 1)] . $shortlink;
        return  $shortlink;

    }

    public function short(Request $req)
    {
        $old_id = DB::table('url')->max('id');
        // print_r($old_id);die;
        $short_url = HomeController::encode($old_id + 1);
       
        $url = new Url();

        if(!HomeController::validateLink($req->org_url)) {
            $invalid_url = "Invalid URL";
            return view('home', ['invalid_url' => $invalid_url]);
        }

        if(empty($req->custom_url)) {
            $row = Url::where('url_original',$req->org_url)->get();
            if(count($row) > 0) {
                return view('home', ['data' => $row]);
            }
            else {
                $url->url_original = $req->org_url;
                $url->url_shorten =  $short_url;
                $url->short_type = 0;
                $url->url_info = "";
            }
        }
        else {
            $row_custom = Url::where('url_shorten', $req->custom_url)->get();
            if(count($row_custom) > 0) {
                $notify_error = "This link already existed. Please choose another short link";
                return view('home', ['notify_error' => $notify_error]);
            }
            else {
                $url->url_original = $req->org_url;
                $url->url_shorten =  $req->custom_url;
                $url->short_type = 1;
                $url->url_info = ""; 
            }
        }
        $url->save();
        $current_id = DB::table('url')->max('id');
        $data = Url::where('id',$current_id)->get();
        return view('home', ['data' => $data]);
        // return redirect('data');

    }

    public function returnData()
    {
        $current_id = DB::table('url')->max('id');
        $data = Url::where('id',$current_id)->get();
        return view('home', ['data' => $data]);
    }
    
    
}
