<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Employee;
use Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){            
        $employees = Employee::paginate('50');                  
        return response()->json(compact('employees'));
    }   
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {        
        $items = $request->validate([
            'first_name' => 'required|string|max:255', 
            'last_name' => 'required|string|max:255', 
            'email' => 'required|email|max:255', 
            'phone' => 'required|string|max:255', 
            'mobile' => 'required|string|max:255', 
            'photo' => 'required|string|max:255', 
            'address' => 'required|string|max:255',             
            'identification' => 'required|string|max:255',                         
        ]);            
        
        $data = $request->all();          
        $data['user_id'] = 1;                                
        $employee = Employee::create($data);        
        return response()->json(compact('employee'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $employeeId
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId) {
        $employee = Employee::find($employeeId);        
        return response()->json(compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $employeeId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeId){
        $employee = Employee::find($employeeId);                
        $items = $request->validate([
            'first_name' => 'required|string|max:255', 
            'last_name' => 'required|string|max:255', 
            'email' => 'required|email|max:255', 
            'phone' => 'required|string|max:255', 
            'mobile' => 'required|string|max:255', 
            'photo' => 'required|string|max:255', 
            'address' => 'required|string|max:255',             
            'identification' => 'required|string|max:255',                         
        ]);            
        
        $data = $request->all();          
        $data['user_id'] = 2; 

        if ($employee != null) {
            $employee->update($data);
        }        
        
        return response()->json(compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employeeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId){       
        $employee = Employee::find($employeeId);
        if ($employee != null) {
            $employee->delete();
            return response()->json(['deleted'=>true]);
        }                
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employeeId
     * @return \Illuminate\Http\Response
     */
    public function recover($employeeId){ 
        $employee = Employee::withTrashed()->find($employeeId); 
        if ($employee != null) {
            $employee->restore();
            return response()->json(['restored'=>true]);
        }        
    }

    
}
