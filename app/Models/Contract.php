<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use SoftDeletes;

    protected $table = 'contracts';
    public $timestamps = true;

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];   
    protected $fillable = [
        'name','type_id','text','variables'        
    ];
}
