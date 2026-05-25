<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'role'       => 'required|string',
            'department' => 'required|string',
            'email'      => 'required|email|unique:employees',
            'salary'     => 'required|numeric'
        ]);

        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'       => 'sometimes|string',
            'role'       => 'sometimes|string',
            'department' => 'sometimes|string',
            'email'      => 'sometimes|email|unique:employees,email,' . $employee->id,
            'salary'     => 'sometimes|numeric'
        ]);

        $employee->update($request->all());
        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted']);
    }
}