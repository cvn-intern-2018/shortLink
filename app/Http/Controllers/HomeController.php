<?php

namespace App\Http\Controllers;

use App\Access;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Url;
use Illuminate\Support\Facades\View;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;


define('BROWSER','browser');
define('CREATED_AT','created_at');

define('GENERATE', 0);
define('CUSTOMIZE', 1);

define('ERROR_EXIST',"This link already existed. Please choose another short link");
define('INVALID_URL',"Invalid original URL");
define('ERROR_CUSTOM', "Invalid custom url");


class HomeController extends Controller
{

    /**
     * @return string domain
     */
    public function getDomain() {
        if(strlen($_SERVER['SERVER_PORT']) > 0)
            return config('constants.domain') ;
        return $_SERVER['SERVER_NAME'];
    }


    public function index()
    {
        return view('home' ,['domain'=> $this->getDomain()]);
    }


    /**
     * Validate url
     * @param String $url
     * @return bool
     */
    public function validateLink($url)
    {
        $right_url = '/^(https?:\/\/)?([\da-zA-Z\.-]+)\.([a-zA-Z\.]{2,6})(\S)*$/';
        return (strlen($url) < 2048 && preg_match($right_url, $url));
    }


    /**
     * @param $string
     * @return boolean
     */
    public function validateCustomizeInput($string)
    {
        $right_input = '/^[^\-][a-zA-Z0-9\-\_]{7,20}$/';
        return (preg_match($right_input, $string));
    }


    /**
     * encode
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
        $url = new Url();
        $old_id = $url->getMaxId();

        if (!$this->validateLink($req->org_url))
            return response()->json(['data' => INVALID_URL ,'isError' =>  $isError]);

        if (strlen($req->custom_url) == 0) {
            if($url->isExistInDatabase('url_original', $req->org_url, 'short_type', GENERATE))
            {
                $row_data = $url->getDataRows('url_original', $req->org_url);
                $isError = false;
                return response()->json(['data' =>  $row_data ,'isError' =>  $isError, 'domain'=> $this->getDomain()]);
            }
            else {
                $url->saveData($req->org_url, Uuid::generate()->string, GENERATE);//save temporary
                $short_url = $this->encode($url->id);
                $url->url_shorten =  $short_url ;
                $url->save();
            }

        } else {
            if (!$this->validateCustomizeInput($req->custom_url)) {
                return response()->json(['data' => ERROR_CUSTOM, 'isError' => $isError]);
            }
            if($url->isExistInDatabase('url_shorten', $req->custom_url))
                return response()->json(['data' => ERROR_EXIST ,'isError' =>  $isError]);
            else
                $url->saveData($req->org_url, $req->custom_url, CUSTOMIZE);
        }
        $current_id =  $url->getMaxId();
        $data = $url->getDataRows('id', $current_id);
        $isError = false;
        return response()->json(['data' =>  $data ,'isError' =>  $isError, 'domain'=> $this->getDomain()]);
    }


    /**
     * Get type of browser
     * @return integer of browser in define
     * */
    public function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browsers_map = [
            'Opera' => config('constants.browser.OPERA'),
            'OPR/' => config('constants.browser.OPERA'),
            'Edge' => config('constants.browser.EDGE'),
            'Chrome' => config('constants.browser.CHROME'),
            'Safari' => config('constants.browser.SAFARI'),
            'Firefox' => config('constants.browser..FIREFOX'),
            'MSIE' => config('constants.browser.IE'),
            'Trident/7' => config('constants.browser.IE'),
        ];

        foreach ($browsers_map as $user_agent_part => $browser) {
            if (strpos($user_agent, $user_agent_part)) return $browser;
        }

        return OTHERS;
    }


    /**
     * Update Url_info when click shorten link
     * * @param Request $request
     */
    public function updateUrlInfo($url_id){
        $counted = 0;
        $browser = $this->getBrowser();
        $access = Access::where('url_id', $url_id)->where('browser', $browser)->first();
        $time = round(microtime(true) * 1000);
        if (is_null($access)) {
            $access = new Access();
            $access->saveData($url_id, $browser, $time);
        }
        else {
            $access->clicked_time = $access->clicked_time.' '.$time;
            $access->save();
        };
    }


    /**
     * @return View
     */
    public function pageNotFound(){
        return view('error.404');
    }


    /**
     * @param $url
     * @return Redirector
     */
    public function redirectUrl($url_shorten)
    {
        $url = new Url();
         //Redirect Statistics
        if ($url_shorten[count($url_shorten)] === '+'&& substr_count($url_shorten,'+') == 1)
        {
            $url_shorten = substr($url_shorten, 0, -1);
            return $url_shorten ?
                redirect()->action('ChartController@index', ['url_shorten' => $url_shorten]):redirect('/pagenotfound');
        }
        $url_original = $url->getAttributeRowData('url_shorten', $url_shorten, 'url_original');
        if($url_original != null) {
            $url_id = $url->getAttributeRowData('url_shorten', $url_shorten, 'id');
            $this->updateUrlInfo($url_id);
            return  redirect($url_original);
        }
        return redirect('/pagenotfound');
    }

}
