<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesApiController extends Controller
{
    public function getAllEmployees()
    {
        $employees = Employee::get()->toJson(JSON_PRETTY_PRINT);
        return response($employees, 200);
    }

    public function createEmployee(Request $request)
    {
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'job_role' => 'required',
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->errors();
            $response['success'] = false;
        } else {
            $employee = new Employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->job_role = $request->job_role;
            $employee->save();
            $response['message'] = "Employee record been created!";
            $response['success'] = true;
        }
        return response()->json($response, 201);
    }

    public function getEmployee($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($employee, 200);
        } else {
            return response()->json([
                "message" => "Employee not found"
            ], 404);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'job_role' => 'required',
        ]);

        if (Employee::where('id', $id)->exists()) {
            if ($validator->fails()) {
                $response['response'] = $validator->errors();
                $response['success'] = false;
            } else {
                $employee = Employee::find($id);
                $employee->first_name = !is_null($request->first_name) ? $request->first_name : $employee->first_name;
                $employee->last_name = !is_null($request->last_name) ? $request->last_name : $employee->last_name;
                $employee->email = !is_null($request->email) ? $request->email : $employee->email;
                $employee->job_role = !is_null($request->job_role) ? $request->job_role : $employee->job_role;
                $employee->save();
                $response['message'] = "Employee record updated successfully";
                $response['success'] = true;
            }
        } else {
            return response()->json([
                "message" => "Employee not found"
            ], 404);
        }

        return response()->json($response, 201);

    }

    public function deleteEmployee($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();

            return response()->json([
                "message" => "Employee record deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Employee not found"
            ], 404);
        }
    }
}
