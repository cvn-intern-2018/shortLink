<?php

namespace App\Http\Controllers;

use App\Access;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Url;
use Illuminate\Support\Facades\View;
use function MongoDB\BSON\toJSON;

define('CHROME', 1);
define('FIREFOX', 2);
define('SAFARI', 3);
define('OPERA', 4);
define('EDGE', 5);
define('EXPLORER', 6);
define('OTHERS', 0);
define('BROWSER','browser');
define('CREATED_AT','created_at');


class HomeController extends Controller
{

    public function index()
    {
        $domain = $_SERVER['SERVER_NAME'] .':' .$_SERVER['SERVER_PORT'] ;
        return view('home' ,['domain'=> $domain]);
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
        $regular = '/^(https?:\/\/)?([\da-zA-Z\.-]+)\.([a-zA-Z\.]{2,6})(\S)*$/';

        return (strlen($url) < 2048 && $check = preg_match($regular, $url)) ;
    }


    /**
     * Validate Customize input
     * @param $string
     * @return bool
     */
    public function validateCustomizeInput($string)
    {
        $regular = '/[a-zA-Z0-9]{1,20}/';
        return ($check = preg_match($regular, $string));
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
        while (strlen($shortlink) < 6) {
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
        $isError = true;

        $old_id = DB::table('url')->max('id');
        $short_url = HomeController::encode($old_id + 1);

        $domain = $_SERVER['SERVER_NAME'] .':' .$_SERVER['SERVER_PORT'] ;
       
        $url = new Url();

        if (!HomeController::validateLink($req->org_url)) {
            $notify_error = "Invalid URL";
            return response()->json(['data' =>  $notify_error ,'isError' =>  $isError]);
        }

        if (strlen($req->custom_url) == 0) {
            $row = Url::where('url_original', $req->org_url)->where('short_type', 0)->get();
            if (count($row) > 0) {
                 $row_data = Url::where('url_original', $req->org_url)->get();
                $isError = false;
                return response()->json(['data' =>  $row_data ,'isError' =>  $isError, 'domain'=> $domain]);
            } else {
                $url->url_original = $req->org_url;
                $url->url_shorten = $short_url;
                $url->short_type = 0;
            }
        } else {
            $row_custom = Url::where('url_shorten', $req->custom_url)->get();
            if (count($row_custom) > 0) {
                $notify_error = "This link already existed. Please choose another short link";

                $isError = true;
                return response()->json(['data' =>  $notify_error ,'isError' =>  $isError]);
            } else {
                $url->url_original = $req->org_url;
                $url->url_shorten = $req->custom_url;
                $url->short_type = 1;
            }
        }
        $url->save();
        $current_id = DB::table('url')->max('id');
        $data = Url::where('id', $current_id)->get();
        $isError = false;
        return response()->json(['data' =>  $data ,'isError' =>  $isError, 'domain'=> $domain]);
    }


    /**
     * Get type of browser
     * @return integer of browser in define
     * */
    public function getBrowser()
    {
       /* $browser = get_browser()->browser;
        switch ($browser) {
            case 'Chrome':
                return CHROME;
            case 'Firefox':
                return FIREFOX;
            case 'Safari':
                return SAFARI;
            case 'Opera':
                return OPERA;
            case 'Edge':
                return EDGE;
            case 'IE':
                return EXPLORER;
            default:
                return OTHERS;
        }*/

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return OPERA;
        elseif (strpos($user_agent, 'Edge')) return EDGE;
        elseif (strpos($user_agent, 'Chrome')) return CHROME;
        elseif (strpos($user_agent, 'Safari')) return  SAFARI;
        elseif (strpos($user_agent, 'Firefox')) return FIREFOX;
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return EXPLORER;
        return OTHERS;
    }


    /**
     * Update Url_info when click shorten link
     * * @param Request $request
     */

    public function updateUrlInfo(Request $request){

        $id = $request->id;
        $browser = $this->getBrowser();
        $access = Access::where('id',$id)
            ->where('browser', $browser)
            ->first();
        $time = date('YmdHis');
        if (is_null($access)) {
            $access = new Access();
            $access->id = $id;
            $access->browser = $browser;
            $access->clicked_time = $time;
            $access->save();
        } else {
            $access->clicked_time =  $access->clicked_time.' '.$time;
            $access->save();
        };
        //return response()->json(['data' =>  $access]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pageNotFound(){
        return  view('error.404');
    }

    /**
     * @param $url
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectUrl($url)
    {
        if (substr("$url", -1) === '+')
        {
            $url = rtrim($url,"+");
            //Redirect Statistics
            return redirect('/chart');
        }
        $url_original = Url::where('url_shorten', $url)->value('url_original');

        return count($url_original) > 0 ? redirect($url_original) : redirect('/pagenotfound');
    }
    public function test()
    {
        $url = Url::where('id', 1)->first();
        $info = json_decode('[' . $url->url_info . ']');
        var_dump($info);

    }

}
