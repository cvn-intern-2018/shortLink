<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Url extends Model
{
    protected $table = 'url';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'url_original',
        'url_shorten',
        'created_At',
    ];

    function saveData($url_original, $url_shorten, $short_type)
    {
        $this->url_original = $url_original;
        $this->url_shorten = $url_shorten;
        $this->short_type = $short_type;
        $this->save();
    }

    function getMaxId()
    {
        return DB::table('url')->max('id');
    }

    function getDataRows($string1, $key1)
    {
        return $this->where($string1, $key1)->get();
    }

    function getAttributeRowData($string, $key, $value)
    {
        return $this->where($string, $key)->value($value);
    }

    public function isExistInDatabase($string, $key, $string1 = "", $key1 = "")
    {
        $query = $this->where($string, $key);

        if ($string1 && $key1) {
            $query->where($string1, $key1);
        }

        return count($query->get()) > 0 ? true : false;
    }

    function scopeGetByUrlShorten($query, $url_shorten)
    {
        return $query->where('url_shorten', $url_shorten);
    }
    function scopeGetIDByUrlShorten($query, $url_shorten)
    {
        return $query->where('url_shorten', $url_shorten)->pluck('id');
    }

}