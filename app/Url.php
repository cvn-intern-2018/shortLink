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
}