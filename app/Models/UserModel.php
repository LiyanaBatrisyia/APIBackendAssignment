<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{

    const RULES = [
        'name'      => 'required|string|min:3',
        'gender'    => 'string|min:4',
        'email'     => 'required|email|min:10',
        'password'  => 'required|integer|min:4',
    ];

    use SoftDeletes;
    protected $table = "users";
    public $timestamps = false;

    protected $fillable =[
        'name',
        'gender',
        'email',
        'password',
    ];
}
