<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    public function noti()
    {
        $count = DB::select("SELECT count(*) AS countNoti FROM new_supplier WHERE mark_as = 0 ");
        $new_supp=DB::select('SELECT * FROM new_supplier WHERE mark_as = 0');
        return view('layouts.nav',[
            'new_supplier'=>$new_supp,
            'count'=>$count[0]->countNoti
        ]);
    }
}
