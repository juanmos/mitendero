<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';
    public $timestamps = true;

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];   
    protected $fillable = [
        'first_name','last_name','email','phone','mobile','user_id','photo','address','city','identification'        
    ];
}
