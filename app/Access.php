<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';
    public $timestamps = false;

    /**
     * @param $url_id
     * @param $browser
     * @param $click_time
     */
    function saveData($url_id, $browser, $click_time)
    {
        $this->url_id = $url_id;
        $this->browser = $browser;
        $this->clicked_time = $click_time;
        $this->save();
    }

    /**
     * @param $query
     * @param $url_id
     * @return mixed
     */
    function scopeGetById($query, $url_id)
    {
        return $query->where('url_id', $url_id );
    }

    /**
     * @param $query
     * @param $browser
     * @return mixed
     */
    function scopeGetByBrowser($query, $browser)
    {
        return $query->where('browser', $browser);
    }

    /**
     * @param $query
     * @param $url_id
     * @return int
     */
    function scopeGetTotalClickUrlShort($query, $url_id){
        $clicked_time_total = 0;
        $records = $query->where('url_id', $url_id )->get();
        foreach ($records as $item) {
            $arr_clicked_time = explode(' ',$item->clicked_time);
            $clicked_time_total += count($arr_clicked_time);
        }
        return $clicked_time_total;
    }

    /**
     * @param $query
     * @param $url_id
     * @return array
     */
    function scopeGetArrTimerUrlShort($query, $url_id){
        $arr_data_browser =[];
        $browser = config('constants.browser');
        foreach ($browser as $key => $value) {
            $obj_browser = (object)[
                'browser_name' => $key,
                'arr_click_time' => []
            ];
            array_push($arr_data_browser, $obj_browser);
        }
        $record_access = $query->where('url_id', $url_id )->get();
        foreach ($record_access as $item) {
            $arr_clicked_time = explode(' ',$item->clicked_time);
            $arr_data_browser[$item->browser]->arr_click_time = $arr_clicked_time;
        }
        return $arr_data_browser;
    }
}
