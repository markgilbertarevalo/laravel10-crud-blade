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
            $employee = $this->preparedData($request, 0);
            $employee->save();

            DB::commit();
        } catch (\Exception $e){
            dd($e);
            DB::rollback();
        }
    }

    private function preparedData($request, $id)
    {
        if($id === 0){
            $employee = new Employee;
        }
        else{
            $employee = Employee::find($id);
        }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->position = $request->position;

        return $employee;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try{
            $employee = $this->preparedData($request, $id);
            $employee->save();

            DB::commit();
        } catch (\Exception $e){
            dd($e);
            DB::rollback();
        }

    }
}
