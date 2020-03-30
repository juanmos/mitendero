<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class CompanyLocation extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'company_id',
        'address',
        'phone',
        'lat',
        'lng'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
