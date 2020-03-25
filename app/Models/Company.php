<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyContact;
use App\Models\CompanyType;
use App\Models\Configuration;
use App\Models\User;

class Company extends Model
{
    protected $fillable=[
        'company_name',
        'company_alias',
        'ruc',
        'address',
        'phone',
        'location',
        'company_type_id',
        'status'
    ];
    protected $with=['configuration','companyType'];

    
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function contacts()
    {
        return $this->hasMany(CompanyContact::class, 'company_id');
    }
    
    public function configuration()
    {
        return $this->hasOne(Configuration::class, 'company_id');
    }
}
