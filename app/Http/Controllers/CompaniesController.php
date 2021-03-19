<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('employeesJson');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'logo' => $request->file('logo')->store('upload', 'public'),
            'website' => $request->input('website')
        ]);

        return redirect()->route('companies.index')->with('status', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies-show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies-edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($request->file('logo') !== null) {
            Company::whereId($company->id)
              ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'logo' => $request->file('logo')->store('upload', 'public'),
                'website' => $request->input('website'),
              ]);
        } else {
            Company::whereId($company->id)
              ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'website' => $request->input('website'),
              ]);
        }

        return redirect()->route('companies.index')->with('status', 'Company updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Company::whereId($company->id)->delete();

        return redirect()->route('companies.index')->with('status', 'Company deleted successfully.');;
    }

    public function employeesJson (Company $company)
    {
        return DataTables::of($company->employees)->make(true);
    }
}
