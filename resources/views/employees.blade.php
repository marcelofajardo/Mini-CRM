@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('employees.title') }}</h1>
@stop

@section('content')
  @if (session('status'))
  <div class="form-group">
    <div class="alert alert-info">
      <i class="fas fa-info-circle mr-1"></i>
      <span>{{ __('employees.' . session('status')) }}</span>
    </div>
  </div>
  @endif

  <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i>
    <span>{{ __('employees.create') }}</span>
  </a>

  @foreach ($employees as $employee)
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <a href="{{ route('employees.show', ['employee' => $employee->id ]) }}" class="mb-0">{{ $employee->first_name . ' ' . $employee->last_name }}</a>
              </div>
          </div>
      </div>
    </div>
  @endforeach

  {{ $employees->links() }}
@stop
