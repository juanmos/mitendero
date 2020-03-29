<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $request->validate([
            'lat'=>'required|numeric',
            'lng'=>'required|numeric',
            'address'=>'required',
            'phone'=>'required',
        ]);
        $company->locations()->create($request->all());
        $company->fresh();
        return response()->json(['created'=>true,'company'=>$company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyLocation $companyLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyLocation  $companyLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyLocation $companyLocation)
    {
        //
    }
}
