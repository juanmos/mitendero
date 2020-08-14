<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Contract;
use Hash;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){            
        $contracts = Contract::paginate('50');                  
        return response()->json(compact('contracts'));
    }   
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {        
        $items = $request->validate([
            'name' => 'required|string|max:255', 
            'type_id' => 'required', 
            'text' => 'required|string', 
            'variables' => 'required',                            
        ]);                    
        $data = $request->all();                                              
        $contract = Contract::create($data);        
        return response()->json(compact('contract'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $contractId
     * @return \Illuminate\Http\Response
     */
    public function show($contractId) {
        $contract = Contract::find($contractId);        
        return response()->json(compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $contractId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contractId){
        $contract = Contract::find($contractId);                
        $items = $request->validate([
            'name' => 'required|string|max:255', 
            'type_id' => 'required', 
            'text' => 'required|string', 
            'variables' => 'required',                        
        ]);            
        
        $data = $request->all();          
        $data['user_id'] = 2; 

        if ($contract != null) {
            $contract->update($data);
        }        
        
        return response()->json(compact('contract'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contractId
     * @return \Illuminate\Http\Response
     */
    public function destroy($contractId){       
        $contract = Contract::find($contractId);
        if ($contract != null) {
            $contract->delete();
            return response()->json(['deleted'=>true]);
        }                
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contractId
     * @return \Illuminate\Http\Response
     */
    public function recover($contractId){ 
        $contract = Contract::withTrashed()->find($contractId); 
        if ($contract != null) {
            $contract->restore();
            return response()->json(['restored'=>true]);
        }        
    }

    
}
