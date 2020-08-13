<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsContract extends Model
{
    use SoftDeletes;

    protected $table = 'details_contracts';
    public $timestamps = true;

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];   
    protected $fillable = [
        'employee_id','user_id','contract_link'        
    ];
}
