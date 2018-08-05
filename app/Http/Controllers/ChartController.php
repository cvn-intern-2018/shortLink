<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Access;
use App\Url;

class ChartController extends Controller
{
    //
    public function index(Request $request)
    {             
        $arr_data_browser = $this->createArrTemplateOfBrowser();         
        $url_shorter = $request->url_shorten;
        $record_url = Url::GetByUrlShorten( $url_shorter)->first();
        if (is_null($record_url))
            return view('error.404');        

        $count_clicked_time = 0;
        $record_access = Access::GetById($record_url->id)->get();  
        if (!is_null($record_access)) {            
            foreach ($record_access as $item) { 
                $arr_clicked_time = explode(' ',$item->clicked_time);                
                $count_clicked_time += count($arr_clicked_time);
                $arr_data_browser[$item->browser]->total_click = count($arr_clicked_time);
                $arr_data_browser[$item->browser]->arr_click_time = $arr_clicked_time;
            }
        }    
        $obj_info_url_shortener = (object)[
            'url_original'  => $record_url->url_original,
            'url_short'     =>  $record_url->url_shorten,
            'created_at'    => date_format(date_create($record_url->created_at), 'd-m-Y'),
            'count_clicked_time' => $count_clicked_time,
        ];        
        return view('chart')->with(compact('obj_info_url_shortener','arr_data_browser'));
    }   
    public function createArrTemplateOfBrowser(){
        $arr_data_browser = [];   
        $browser = config('constants.browser');
        foreach($browser as $key=>$value)
        {
            $obj_browser = (object)[
                'browser_name'    => $key,
                'total_click'     => 0,
                'arr_click_time'  =>''
            ]; 
            array_push($arr_data_browser,$obj_browser);
        }
        return $arr_data_browser;
    }
    public function getDataStatistics(Request $request){
        $time = date('YmdHis');      
        $time_line = $time - $request->time_select*config('constants.hours_to_milliseconds');
        $arr_data_browser = $request->arr_data_browser;
        foreach($arr_data_browser as $value)
        {         
            return response()->json(['data' => $value]);           
            if($value->total_click > 0 ){                  
                $arr_temp = [];
                foreach($value->arr_click_time as $time)
                {
                    if ($time >= $time_line )
                    {            
                        array_push($arr_temp,date("d/m/Y H:i:s", $time));
                    }
                }
                $value->arr_click_time = $arr_temp;
                $value->total_click = count($arr_temp);
            }          
        }

        return response()->json(['data' => $arr_data_browser]);
    }
}
