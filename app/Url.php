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

    function getDataRows($string1, $key1) {
        return $this->where($string1, $key1)->get();
    }

    function getAttributeRowData($string, $key, $value) {
        return $this->where($string, $key)->value($value);
    }

    public function isExistInDatabase($string, $key) {
        return count($this->where($string, $key)->get()) > 0 ? true : false;
    }

    public function isExistInDatabaseWith2Argument($string, $key, $string1, $key1) {
        return count($this->where($string, $key)->where($string1, $key1)->get()) > 0 ? true : false;
    }
}