<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Employee::class);

        $companies = Company::all();
        return view('employees-create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')->with('status', 'createSuccess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees-show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);

        $companies = Company::all();

        return view('employees-edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        Employee::whereId($employee->id)->update($request->validated());

        return redirect()->route('employees.index')->with('status', 'updateSuccess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        Employee::whereId($employee->id)->delete();

        return redirect()->route('employees.index')->with('status', 'deleteSuccess');
    }
}
