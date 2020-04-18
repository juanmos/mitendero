<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySuggestion;

class CompanySuggestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_name'=>'required',
            'contact'=>'required',
            'company_type_id'=>'required'
        ]);

        $data = $request->all();
        $company=CompanySuggestion::create($data);
        return response()->json(compact('company'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanySuggestion  $companySuggestion
     * @return \Illuminate\Http\Response
     */
    public function show(CompanySuggestion $companySuggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanySuggestion  $companySuggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanySuggestion $companySuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanySuggestion  $companySuggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanySuggestion $companySuggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanySuggestion  $companySuggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanySuggestion $companySuggestion)
    {
        //
    }
}
