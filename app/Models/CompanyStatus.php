<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class CompanyStatus extends Model
{
    protected $fillable =['status'];
    public $timestamps =false;
    
    public function company()
    {
        return $this->hasMany(Company::class, 'company_id');
    }
}
