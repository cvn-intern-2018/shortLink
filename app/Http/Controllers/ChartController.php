<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Access;
use App\Url;

class ChartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr_data_browser = $this->createArrTemplateOfBrowser();
        $url_shorter = $request->url_shorten;
        $record_url = Url::GetByUrlShorten($url_shorter)->first();
        if (is_null($record_url))
            return view('error.404');

        $clicked_time_total = 0;
        $record_access = Access::GetById($record_url->id)->get();
        foreach ($record_access as $item) {
            $arr_clicked_time = explode(' ',$item->clicked_time);
            $clicked_time_total += count($arr_clicked_time);
            $arr_data_browser[$item->browser]->total_click = count($arr_clicked_time);
            $arr_data_browser[$item->browser]->arr_click_time = $arr_clicked_time;
        }
        $obj_info_url_shortener = (object)[
            'url_original'  => $record_url->url_original,
            'url_short'     =>  $record_url->url_shorten,
            'created_at'    => date_format(date_create($record_url->created_at), 'd-m-Y'),
            'count_clicked_time' => $clicked_time_total,
        ];        
        return view('chart')->with(compact('obj_info_url_shortener','arr_data_browser'));
    }

    /**
     * @return array
     */
    public function createArrTemplateOfBrowser()
    {
        $arr_data_browser = [];
        $browser = config('constants.browser');
        foreach ($browser as $key => $value) {
            $obj_browser = (object)[
                'browser_name' => $key,
                'total_click' => 0,
                'arr_click_time' => ''
            ];
            array_push($arr_data_browser, $obj_browser);
        }
        return $arr_data_browser;
    }
}
