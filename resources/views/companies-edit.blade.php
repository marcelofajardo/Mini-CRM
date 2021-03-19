@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">Editing {{ $company->name }}'s details</h1>
@stop

@section('content')
  <form action="{{ route('companies.update', ['company' => $company->id ]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $company->name }}" required>  
    </div>
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $company->email }}" required>  
    </div>
    @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="logo">Logo</label>
      <img src="{{ asset('/storage/' . $company->logo ) }}" alt="Logo" width="200" height="200" class="d-block my-3">
      <input type="file" name="logo" id="logo" class="form-control-file @error('logo') is-invalid @enderror" value="{{ $company->logo }}">  
    </div>
    @error('logo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="website">Website</label>
      <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ $company->website }}" required>  
    </div>
    @error('website')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <a href="{{ route('companies.show', ['company' => $company->id ]) }}" class="btn btn-info">Back</a>
    <button type="submit" class="btn btn-warning">Update</button>
  </form>
@stop
