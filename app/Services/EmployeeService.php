<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class EmployeeService
{
    public function store($request)
    {
        DB::beginTransaction();
        try{
            $employee = new Employee;
     
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->position = $request->position;
    
            $employee->save();

            DB::commit();
        } catch (\Exception $e){
            dd($e);
            DB::rollback();
        }
    }
}
