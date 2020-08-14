<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PayRole extends Model
{
    use SoftDeletes;

    protected $table = 'pay_roles';
    public $timestamps = true;

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];   
    protected $fillable = [
        'date','variables'
    ];
}
