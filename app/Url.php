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

    function saveData($url_original, $url_shorten, $short_type) {
        $this->url_original = $url_original;
        $this->url_shorten = $url_shorten;
        $this->short_type = $short_type;
        $this->save();
    }

    function getMaxId() {
        return DB::table('url')->max('id');
    }

    function getRows($string1, $key1, $string2 = null, $key2 = null) {
        return  $this->where($string1, $key1)->where($string2, $key2)->get();
    }
}