<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required|max:50|ngword',
        'hobby' => 'max:200|ngword',
        'introduction' => 'max:400|ngword',

    );
    public function user_histories()
    {
        return $this->hasMany('App\UserHistory');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
