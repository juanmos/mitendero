<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractsType extends Model
{
    use SoftDeletes;

    protected $table = 'contracts_types';
    public $timestamps = true;

    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];   
    protected $fillable = [
        'name'
    ];
}
