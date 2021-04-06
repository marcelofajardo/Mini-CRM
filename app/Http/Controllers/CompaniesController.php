<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Mail\CompanyCreatedEmail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $companies = Company::latest()->paginate(10);
            return view('companies', compact('companies'));
        } catch (Throwable $e) {
            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Company::class);

        try {
            return view('companies-create');
        } catch (Throwable $e) {
            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        DB::beginTransaction();
        try {
            $company = Company::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'logo' => $request->file('logo')->store('upload', 'public'),
                'website' => $request->input('website')
            ]);
            DB::commit();
    
            Mail::to(auth()->user()->email)->send(new CompanyCreatedEmail(auth()->user(), $company));
            
            return redirect()->route('companies.index')->with('status', 'createSuccess');
        } catch (Throwable $e) {
            DB::rollBack();
            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        try {
            return view('companies-show', compact('company'));
        } catch (Throwable $e) {
            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);
        try {
            return view('companies-edit', compact('company'));
        } catch (Throwable $e) {
            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
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
        DB::beginTransaction();
        try {
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
            DB::commit();
    
            return redirect()->route('companies.index')->with('status', 'updateSuccess');;
        } catch (Throwable $e) {
            DB::rollBack();

            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        
        DB::beginTransaction();
        try {
            Company::whereId($company->id)->delete();
            DB::commit();
    
            return redirect()->route('companies.index')->with('status', 'deleteSuccess');;
        } catch (Throwable $e) {
            DB::rollBack();

            return view('errors.error', [
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function employeesJson (Company $company)
    {
        return DataTables::of($company->employees)->make(true);
    }
}
