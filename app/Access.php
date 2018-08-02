<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';
    public $timestamps = false;

    function saveData($id, $browser, $click_time) {
        $this->id = $id;
        $this->browser = $browser;
        $this->clicked_time = $click_time;
        $this->save();
    }
}
