@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">Companies</h1>
@stop

@section('content')
  @if (session('status'))
    <div class="form-group">
      <div class="alert alert-info">
        <i class="fas fa-info-circle mr-1"></i>
        <span>{{ session('status') }}</span>
      </div>
    </div>
  @endif
  
  <a href="{{ route('companies.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i>
    <span>Create</span>
  </a>
  @foreach ($companies as $company)
    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <a href="{{ route('companies.show', ['company' => $company->id ]) }}" class="mb-0">{{ $company->name }}</a>
              </div>
          </div>
      </div>
    </div>
  @endforeach

  {{ $companies->links() }}
@stop
