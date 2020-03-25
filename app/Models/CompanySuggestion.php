<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyType;

class CompanySuggestion extends Model
{
    protected $fillable=[
        'company_name',
        'contact',
        'address',
        'email',
        'phone',
        'location',
        'company_type_id',
        'status',
        'company_type_id'
    ];

    protected $with=['companyType'];

    
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id');
    }
}
