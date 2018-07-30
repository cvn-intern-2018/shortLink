<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Url;
use Illuminate\Support\Facades\View;

define('CHROME', 1);
define('FIREFOX', 2);
define('SAFARI', 3);
define('OPERA', 4);
define('EDGE', 5);
define('EXPLORER', 6);
define('OTHERS', 0);


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

    /**
     * Validate url
     * @param String $url
     * @return bool
     */
    public function validateLink($url)
    {
        $regular = '/^(http:\/\/|https:\/\/)?[\w]+(\.{1}[\w]+)+(\S*)$/';

        if (strlen($url) < 2048 && $check = preg_match($regular, $url)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Validate Customize input
     * @param $string
     * @return bool
     */
    public function validateCustomizeInput($string)
    {
        $regular = '/[a-zA-Z0-9]{1,20}/';
        if ($check = preg_match($regular, $string)) {
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

    /**
     * Short URL
     * @param $id
     * @return string
     */
    public function encode($id)
    {
        $alphabet = 'abcdefghilmnopqrstuvwxyzABCDEGHIJKLMNOPQRSTUVWXZ012345789-';
        $addition = 'kjY6F';
        $length = strlen($alphabet);
        $shortlink = '';

        while ($id > 0) {
            $shortlink = $shortlink . $alphabet[(int)($id % $length)];
            $id = (int)($id / $length);
        }
        while (strlen($shortlink) < 7) {
            $shortlink = $addition[rand(0, strlen($addition) - 1)] . $shortlink;
        }
        return $shortlink;

    }

    /**
     * Short URL
     * @param Request $req
     * @return view
     */
    public function shortURL(Request $req)
    {
        $old_id = DB::table('url')->max('id');
        // print_r($old_id);die;
        $short_url = HomeController::encode($old_id + 1);


        $url = new Url();

        if (!HomeController::validateLink($req->org_url)) {
            $invalid_url = "Invalid URL";
            return view('home', ['invalid_url' => $invalid_url]);
        }

        if (empty($req->custom_url)) {
            $row = Url::where('url_original', $req->org_url)->where('short_type', 0)->get();
            if (count($row) > 0) {
                 $row_data = Url::where('url_original', $req->org_url)->get();
                return view('home', ['data' => $row_data]);
            } else {
                $url->url_original = $req->org_url;
                $url->url_shorten = $short_url;
                $url->short_type = 0;
                $url->url_info = "";
            }
        } else {
            $row_custom = Url::where('url_shorten', $req->custom_url)->get();
            if (count($row_custom) > 0) {
                $notify_error = "This link already existed. Please choose another short link";
                return view('home', ['notify_error' => $notify_error]);
            } else {
                $url->url_original = $req->org_url;
                $url->url_shorten = $req->custom_url;
                $url->short_type = 1;
                $url->url_info = "";
            }
        }
        $url->save();
        $current_id = DB::table('url')->max('id');
        $data = Url::where('id', $current_id)->get();
        return view('home', ['data' => $data]);

    }


    /**
     * Get type of browser
     * @return integer of browser in define
     * */
    public function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'Chrome')) return CHROME;
        elseif (strpos($user_agent, 'Firefox')) return FIREFOX;
        elseif (strpos($user_agent, 'Safari')) return SAFARI;
        elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return OPERA;
        elseif (strpos($user_agent, 'Edge')) return EDGE;
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return EXPLORER;
        return OTHERS;
    }


    /**
     * Update Url_info when click shorten link
     */
    public function updateUrlInfo(){

        $url_shorten = $_POST['url_shorten'];
        $object = Url::where('url_shorten', $url_shorten)->first();
        $browser = $this->getBrowser();
        $time = date('Y-m-d H:i:s');
        $info = array(
            "browser" => $browser,
            "created_at" => $time
        );
        if ($object->url_info == null) {
            $object->url_info = json_encode($info);
        } else {
            $object->url_info = $object->url_info . ',' . json_encode($info);
        }
        $object->save();
    }

    public function test()
    {
        $url = Url::where('id', 1)->first();
        $info = json_decode('[' . $url->url_info . ']');
        var_dump($info);
    }
}
