<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CompanyLocation;
use App\Models\CompanyStatus;
use App\Models\CompanyType;
use App\Models\Configuration;
use App\Models\User;

class Company extends Model
{
    use softDeletes;
    
    protected $fillable=[
        'company_name',
        'company_alias',
        'ruc',
        'company_type_id',
        'status_id'
    ];
    protected $with=['configuration','companyType','locations'];

    
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id');
    }

    public function companyStatus()
    {
        return $this->belongsTo(CompanyStatus::class, 'company_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function locations()
    {
        return $this->hasMany(CompanyLocation::class, 'company_id');
    }
    
    public function configuration()
    {
        return $this->hasOne(Configuration::class, 'company_id');
    }
}
