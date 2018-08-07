<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Access;
use App\Url;

class ChartController extends Controller
{
    /**
     * Return view chart and data : info of url shortener and array statistics
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $url_shorter = $request->url_shorten;
        $record_url = Url::GetByUrlShorten($url_shorter)->first();
        if (is_null($record_url))
            return view('error.404');
        $obj_info_url_shortener = (object)[
            'url_original'  => $record_url->url_original,
            'url_short'     =>  $record_url->url_shorten,
            'created_at'    => date_format(date_create(), 'd-m-Y'),
            'clicked_time_total' => Access::GetTotalClickUrlShort($record_url->id) ? Access::GetTotalClickUrlShort($record_url->id) : 0,
        ];
        $arr_data_browser = $this->convertArrToStatistics(Access::GetArrTimerUrlShort($record_url->id));
        return view('chart')->with(compact('obj_info_url_shortener','arr_data_browser'));
    }

    /**
     * Sort time flow timer selected
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortTimeToStatistics(Request $request){
        $id = Url::GetIDByUrlShorten($request->url_shortener)->first();
        $arr_data_browser = Access::GetArrTimerUrlShort($id);
        $data = $this->sortTimeByHours($arr_data_browser, $request->time_select);
        return response()->json(['data' =>  $data]);
    }

    /**
     * Sort element of array_click_time in array flow time line.
     * @param $arr_data
     * @param $timer_selected
     * @return array
     */
    public function sortTimeByHours($arr_data, $timer_selected){
        $time_now = round(microtime(true) * 1000);
        $time_line = $time_now - $timer_selected * config('constants.hours_to_milliseconds');
         if ($timer_selected == 0) {
             $time_line = 0;
         }
        foreach ($arr_data as $item) {
            $arr_temp = [];
            foreach ($item->arr_click_time as $value){

                if ($value > $time_line)
                {
                    array_push($arr_temp,$value);
                }
            }
            $item->arr_click_time = $arr_temp;
        }

         return $this->convertArrToStatistics($arr_data);
    }
    /**
     * Convert element have array clicked to total clicked
     * @param $arr
     * @return array
     */
    public function convertArrToStatistics($arr){
        $result = [];
        foreach ($arr as $item){
            $obj_element = (object)[
                'browser_name' => $item->browser_name,
                'clicked' => count($item->arr_click_time)
            ];
            array_push($result,$obj_element);
        }
        return $result;
    }
}
