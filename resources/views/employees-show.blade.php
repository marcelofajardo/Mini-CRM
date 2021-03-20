@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ $employee->first_name }}'s details</h1>
@stop

@section('content')
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" class="form-control-plaintext" readonly value="{{ $employee->first_name }}">  
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control-plaintext" readonly value="{{ $employee->last_name }}">  
  </div>
  <div class="form-group">
    <label for="company">Company</label>
    <input type="text" name="company" id="company" class="form-control-plaintext" readonly value="{{ $employee->companyRel->name }}">  
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control-plaintext" readonly value="{{ $employee->email }}">  
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone" class="form-control-plaintext" readonly value="{{ $employee->phone }}">  
  </div>
  @if (auth()->user()->isAdmin())
    <a href="{{ route('employees.edit', ['employee' => $employee->id ]) }}" class="btn btn-warning">Update </a>
    <form action="{{ route('employees.destroy', ['employee' => $employee->id ]) }}" class="d-inline-block" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this employee?')">Delete</button>
    </form>
  @endif
@stop
