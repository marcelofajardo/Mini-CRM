@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">Editing {{ $employee->first_name }}'s details</h1>
@stop

@section('content')
  <form action="{{ route('employees.update', ['employee' => $employee->id ]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $employee->first_name }}" required>  
    </div>
    @error('first_name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $employee->last_name }}" required>  
    </div>
    @error('last_name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="company">Company</label>
      <select class="form-control @error('company') is-invalid @enderror" id="company" name="company" required>
        <option value="">Choose one...</option>
        @foreach ($companies as $company)
          <option value="{{ $company->id }}" {{ $employee->company == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
        @endforeach
      </select>
    </div>
    @error('company')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $employee->email }}" required>  
    </div>
    @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $employee->phone }}" required minlength="11" maxlength="15">  
    </div>
    @error('phone')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <button type="submit" class="btn btn-warning">Update</button>
    </div>
  </form>
@stop
