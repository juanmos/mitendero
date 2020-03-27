<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class CompanyLocation extends Model
{
    protected $fillable=[
        'company_id',
        'address',
        'phone',
        'location'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
