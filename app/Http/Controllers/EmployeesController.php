<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $employees = Employee::latest()->paginate(10);
            return view('employees', compact('employees'));
        } catch (Throwable $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Employee::class);
        
        try {
            $companies = Company::all();
            return view('employees-create', compact('companies'));
        } catch (Throwable $e) {
            return redirect()->route('employees.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            Employee::create($request->validated());
            DB::commit();
            
            return redirect()->route('employees.index')->with('status', 'createSuccess');
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()->route('employees.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        try {
            return view('employees-show', compact('employee'));
        } catch (Throwable $e) {
            return redirect()->route('employees.index');
        }
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

        try {
            $companies = Company::all();
    
            return view('employees-edit', compact('employee', 'companies'));
        } catch (Throwable $e) {
            return redirect()->route('employees.show', compact('employee'));
        }
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
        DB::beginTransaction();
        try {
            Employee::whereId($employee->id)->update($request->validated());
            DB::commit();

            return redirect()->route('employees.index')->with('status', 'updateSuccess');
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()->route('employees.edit', compact('employee'));
        }
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

        DB::beginTransaction();
        try {
            Employee::whereId($employee->id)->delete();
            DB::commit();

            return redirect()->route('employees.index')->with('status', 'deleteSuccess');
        } catch (Throwable $e) {
            DB::rollback();
            
            return redirect()->route('employees.show', compact('employee'));
        }
    }
}
