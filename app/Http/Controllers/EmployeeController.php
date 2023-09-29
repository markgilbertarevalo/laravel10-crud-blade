<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['employees'] = Employee::orderBy('id','desc')->paginate(5);
     
        return view('employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, EmployeeService $employeeService)
    {   
        try {

            $employeeService->store($request);
            return redirect()->route('employee.index')
                        ->with('success','Employee has been created successfully.');

        } catch (\Exception $e) {
            dd($e);
        }
        
 
      
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */     
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, $id, EmployeeService $employeeService)
    {   
        try{
            $employeeService->update($request, $id);
        
            return redirect()->route('employee.index')
                            ->with('success','Employee has been updated successfully.');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try{
            $employee->delete();
        
            return redirect()->route('employee.index')
                            ->with('success','Employee has been deleted successfully.');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
