<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Access;
use App\Url;

class ChartController extends Controller
{
    //
    public function index()
    {
        var_dump(11);
        $url_shorter = $request->url_shorten;
        //var_dump($url_shorter_plus);

        $url = Url::where('url_shorten', $url_shorter)->first();

        if(is_null($url))
            return view('error.404');
        $url_original_link = $url->url_original;
        $url_short_link = $url->url_shorten;
        $created_at = date_format(date_create($url->created_at), 'd-m-Y');
        $countClickedTime = 0;
        $access = Access::Where('id', $url->id)->get();
        if (!is_null($access)) {
            foreach ($access as $item) {
                $countClickedTime = $countClickedTime + substr_count($item->clicked_time, ' ') + 1;
            }
        }

        return view('chart', [
            'url_original_link' => $url_original_link,
            'url_short_link' => $url_short_link,
            'created_at' => $created_at,
            'countClickedTime' => $countClickedTime
        ]);

    }
}
