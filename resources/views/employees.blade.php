@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">Employees</h1>
@stop

@section('content')
  @foreach ($employees as $employee)
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <p class="mb-0">{{ $employee->first_name . ' ' . $employee->last_name }}</p>
              </div>
          </div>
      </div>
    </div>
  @endforeach

  {{ $employees->links() }}
@stop
