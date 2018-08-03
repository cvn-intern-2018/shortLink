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

define('GENERATE', 0);
define('CUSTOMIZE', 1);

define('ERROR_EXIST',"This link already existed. Please choose another short link");
define('INVALID_URL',"Invalid URL");


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
        $regular = '/^(https?:\/\/)?([\da-zA-Z\.-]+)\.([a-zA-Z\.]{2,6})(\S)*$/';

        return (strlen($url) < 2048 && $check = preg_match($regular, $url)) ;
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
            if($url->isExistInDatabaseWith2Argument('url_original', $req->org_url, 'short_type', GENERATE))
            {
                $row_data = $url->getDataRows('url_original', $req->org_url);
                $isError = false;
                return response()->json(['data' =>  $row_data ,'isError' =>  $isError, 'domain'=> $this->getDomain()]);
            } 
            else {
                $short_url = $this->encode($old_id + 1);
                while($url->isExistInDatabase('url_shorten', $short_url))
                    $short_url = $this->encode($old_id + 1);
                $url->saveData($req->org_url, $short_url, GENERATE);
            }
        } 
        else { 
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
    public function updateUrlInfo($id){
        $browser = $this->getBrowser();
        $access = Access::where('id', $id)->where('browser', $browser)->first();
        $time = date('YmdHis');
        if (is_null($access)) {
            $access = new Access();
            $access->saveData($id, $browser, $time);
        } 
        else {
            $access->clicked_time =  $access->clicked_time.' '.$time;
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
        var_dump($url_shorten);
        $url = new Url();
         //Redirect Statistics
        if (substr($url_shorten, -1) === '+')
        {
            $url_shorten = rtrim($url_shorten, "+");
            return $url_shorten ?
                redirect()->action('ChartController@index', ['url_shorten' => $url_shorten]):redirect('/pagenotfound');

        }
        $url_original = $url->getAttributeRowData('url_shorten', $url_shorten, 'url_original');

        if(!is_null($url_original)) {
            $id = $url->getAttributeRowData('url_shorten', $url_shorten, 'id');
            $this->updateUrlInfo($id);
            return  redirect($url_original);
        }

        return redirect('/pagenotfound');
    }

}
