<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';
    public $timestamps = false;

    function saveData($url_id, $browser, $click_time)
    {
        $this->url_id = $url_id;
        $this->browser = $browser;
        $this->clicked_time = $click_time;
        $this->save();
    }

    function scopeGetById($query, $url_id)
    {
        return $query->where('url_id', $url_id );
    }

    function scopeGetByBrowser($query, $browser)
    {
        return $query->where('browser', $browser);
    }
}
